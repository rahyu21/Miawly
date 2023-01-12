<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        // if ($user = Auth::user()){
        //     if ($user->level == 'admin'){
        //         return redirect()->intended('/home');
        //     }elseif($user->level == 'gudang'){
        //         return redirect()->intended('/home');
        //     }
        // }
        return view ('index');
    }
    // public function cek_login (Request $request)
    // {
        // $request->validate(
        //     [
        //         'name' => 'required',
        //         'password' => 'required'
        //     ]
        // );
    // $kredensial = $request->only('email','password'){
    //     if (Auth::attempt($kredensial)) {
    //         $user = Auth::user()
    //     }else($user->level == 'gudang'){
    //         return redirect()->intended('/home');
    //     }

    //     return back()->withErrors([
    //         'name' => 'Username atau Password Salah'
    //     ])->onlyInput('name');
    // }
    public function cek_login(Request $request)
    {
        $password = $request->input('password');
        $email = $request->input('email');

            if (Auth::attempt(['email' => $email, 'password' => $password]))
            {
                return redirect()->intended('/home')->with('success', 'Login Berhasil');
            }
            else
            {
                return redirect()->intended('/')->with('error', 'Username atau Password Salah');
            }
    }
    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/');
    // }
}
