<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {

        return view('login.login');
    }
    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('rh.home');
        }
        return back()->withErrors([
            'email' => 'Identifiants incorrect',

        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
