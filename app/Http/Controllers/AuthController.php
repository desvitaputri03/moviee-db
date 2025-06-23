<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function formLogin(){
        return view('login');
    }

    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'

        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'email tidak terdaftar'
        ])->onlyInput('email');

    }

}