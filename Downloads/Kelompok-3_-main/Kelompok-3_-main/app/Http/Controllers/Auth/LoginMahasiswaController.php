<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMahasiswaController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_mahasiswa');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard/mahasiswa');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah!',
        ]);
    }
}
