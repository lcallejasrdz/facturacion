<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
    	return view('auth.login');
    }

    public function postLogin(Request $request)
    {
    	if (Auth::attempt(['username' => $request->user, 'password' => $request->password])) {
            return Redirect::to('dashboard');
        }
    	
    	return Redirect::back();
    }

    public function logout()
    {
    	Auth::logout();

    	return Redirect::to('/');
    }
}
