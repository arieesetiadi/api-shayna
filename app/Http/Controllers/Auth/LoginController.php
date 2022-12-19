<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rememberMe = $request->rememberMe == true;
        $isAuth = auth()->attempt($request->only('username', 'password'), $rememberMe);
        if (!$isAuth) {
            return back()->with('message', [
                'status' => 'danger',
                'body' => 'Username / password anda tidak valid.'
            ]);
        }

        return redirect()->route('dashboard')->with('message', [
            'status' => 'success',
            'body' => 'Selamat datang, ' . auth()->user()->name . ' 😍'
        ]);
    }
}
