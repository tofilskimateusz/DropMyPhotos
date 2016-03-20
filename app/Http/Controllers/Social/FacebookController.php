<?php

namespace App\Http\Controllers\Social;

use App\User;
use App\User_grants;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Facebook\Facebook;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    private $app_id;
    private $fb_config;

    public function __construct(){
        $this->app_id = '1715799618442385';
        $this->fb_config = array(
            'app_id' => $this->app_id,
            'app_secret' => 'ae8f6f94b072d382c3da6c918cfd446c',
            'default_graph_version' => 'v2.5',
        );
        session_start();
    }

    public function Login(){
        $fb = new Facebook($this->fb_config);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl(url('/login/fb-callback'), $permissions);

        return $loginUrl;

    }

    public function LoginCallback(){
        $fb = new Facebook($this->fb_config);
        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // Logged in
                echo '<h3>Access Token</h3>';
                var_dump($accessToken->getValue());

        // The OAuth 2.0 client handler helps us manage access tokens
                $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
                $tokenMetadata = $oAuth2Client->debugToken($accessToken);
                echo '<h3>Metadata</h3>';
                //var_dump($tokenMetadata);

        // Validation (these will throw FacebookSDKException's when they fail)
                $tokenMetadata->validateAppId($this->app_id); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.



        $fbId = $this->isFbIdExists($tokenMetadata->getUserId());
        $this->createFbUser($fbId);

        return redirect('/');
    }

    private function isFbIdExists($fbId){
        $User_grants = User_grants::where('facebook_id', $fbId)->first();
        if($User_grants) {
            Auth::loginUsingId($User_grants->user_id);
            return true;
        }
        else
            return false;
    }

    /**
     * @param $fb_id
     * @return bool|static
     */
    private function createFbUser($fb_id){
        if( $fb_id )
            return false;

        $fb_user = $this->getUserProfile(['id', 'first_name', 'last_name', 'email']);
        $newUser = User::create([
            'name' => $fb_user->getFirstName(),
            'surname' => $fb_user->getLastName(),
            'password' => $_SESSION['fb_access_token'],
            'email' => $fb_user->getEmail(),
            'permission' => 0
        ]);
        var_dump($newUser->getAttribute('id'));

        return User_grants::create([
            'user_id' => $newUser->getAttribute('id'),
            'facebook_id' => $fb_user->getId()
        ]);
    }

    protected function getUserProfile($fields){
        $fb = new Facebook($this->fb_config);
        $fields = implode(',', $fields);
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields='.$fields, $_SESSION['fb_access_token']);
        } catch(FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();

        return $user;
    }
}
