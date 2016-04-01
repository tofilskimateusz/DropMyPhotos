<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Social\GoogleDriveController;
use Closure;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Client;

class GoogleMiddleware extends GoogleDriveController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $client = $this->getClient();
        if ($request->session()->has('gd_access_token')) {
            $client->setAccessToken($request->session()->get('gd_access_token'));
            return $next($request);

        } else {
            return redirect('login/googledrive');
        }

    }
}
