<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login-page');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
 
            return to_route('barang.index');
        }
 
        return back()->with(['status' => "failed", "message" => "Email Atau Password Salah"]);
    }
       
    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return to_route('auth.login-page');
    }

    public function forgotPasswordPage(){
        return view('auth.forgot-password-page');
    }
}
