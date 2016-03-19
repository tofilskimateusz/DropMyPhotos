<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function authenticate(Request $request){

        if ( Auth::attempt(['Email' => $request->email, 'Password' => $request->password]) )
        {
            return back()
                ->withInput();
        }

        return redirect('/home');
    }

}
