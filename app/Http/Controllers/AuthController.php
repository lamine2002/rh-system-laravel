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
            // voir si l'utilisateur est un admin ou un manager
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }elseif (Auth::user()->role === 'manager') {
                return redirect()->intended(route('dashboard'));
            }
            return redirect()->intended(route('welcome'));
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
