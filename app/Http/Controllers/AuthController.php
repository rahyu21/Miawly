<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticateUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use\App\Model\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{    
    public function index()
    {
        return view ('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email' , 'password');

    //     if (Auth::attempt($credentials))
    //     {
    //         return redirect()->intended('/home')->with('success', 'Login Berhasil');
    //     }
    //     else 
    //     {
    //        return redirect()->back()->withInput($request->only('email'))->with('error', 'Email Dan Password Salah');
    //     }
    // }

    // public function logout()
    // {
    //     Auth::logout();
        
    //     return redirect()->route('login');
    // }

    public function cek_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home')->with('success', 'Login Berhasil');
        }

        return back()->with('error', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'))->with('status', 'Anda telah berhasil logout');
    }
}
