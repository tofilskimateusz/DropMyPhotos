<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Social\FacebookController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form(){
        $fb = new FacebookController();

        $data = array(
            'fbLogin' => $fb->Login()
        );
        return view('auth/login', $data);
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
