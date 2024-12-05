<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($request->only('name', 'email') + [
            'password' => bcrypt($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
