<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function login(){
        return view('admin.signin');
    }

    public function doLogin(LoginRequest $request){
        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('admin.index'));
        };

        return to_route('auth.login')->withErrors([
            'email' => " Votre email ou votre mot de passe est incorect",
        ])->onlyInput(['email']);
    }

    public function logout(){
        Auth::logout();
        return view("admin.signin");
    }
}
