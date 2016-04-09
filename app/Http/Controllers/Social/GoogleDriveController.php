<?php

namespace App\Http\Controllers\Social;

use Google_Client;
use Google_Service_Drive;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller;


class GoogleDriveController extends Controller
{
    //554300127959-3ubbpip906ovml9tn990qr6b7b9a1dmu.apps.googleusercontent.com
    //https://www.googleapis.com/drive/v3/files?corpus=user&orderBy=folder+desc&q=mimeType+%3D+'application%2Fvnd.google-apps.folder'+AND+trashed+%3D+false&spaces=drive&fields=files(id%2Cname%2CownedByMe%2Cparents)&key={YOUR_API_KEY}

    private $application_name;
    private $secret_path;
    private $scopes;
    protected $req;

    public function __construct(Request $req)
    {
        $this->req = $req;
        $this->application_name = env('GD_APP_NAME');
        $this->secret_path = base_path('client_secret.json');
        $this->scopes = implode(' ', array('https://www.googleapis.com/auth/drive'));
    }

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    protected function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName(env('GD_APP_NAME'));
        //$client->setDeveloperKey("AIzaSyBK2Kri12ZTeuCO97a3xjbTy9ICKbgfwaY");
        $client->setAuthConfigFile($this->secret_path);
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

        return $client;
    }

    public function login(Request $request){
        session_start();
        $client = $this->getClient();

        if ($this->checkSession() && ! $client->isAccessTokenExpired()){
            $client->setAccessToken($this->getSessionAccessToken());
            return redirect('/social/integrate/googledrive/');
        } else {
            $redirect_uri = $client->createAuthUrl();
            return redirect()->away($redirect_uri);
        }


    }
    public function loginCallback(Request $request){
        $client = $this->getClient();

        if (! isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            return redirect()->away($auth_url);
        } else {
            $client->authenticate($_GET['code']);

            $request->session()->put('gd_access_token', $client->getAccessToken());

            return redirect('/');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('gd_access_token');
        return redirect('/');
    }

    public function getUserProfile($serviceType, $optParams){
        // Get the API client and construct the service object.
        $client = $this->getClient();
        if ($this->checkSession()) {
            $client->setAccessToken($this->getSessionAccessToken());
            $drive_service = new Google_Service_Drive($client);
            $response = $drive_service->files->listFiles($optParams);
            return $response;
        } else {
            $auth_url = $client->createAuthUrl();
            redirect()->away($auth_url);
        }
        
    }

    protected function checkSession(){
        return $this->req->session()->has('gd_access_token');
    }
    protected function getSessionAccessToken(){
        return $this->req->session()->get('gd_access_token');
    }

}
