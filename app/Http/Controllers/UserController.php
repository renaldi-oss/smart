<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('beranda')->with('status', 'success')->with('pesan', 'Berhasil Masuk');
        } else {
            return redirect()->route('login')->with('status', 'danger')->with('pesan', 'Email atau password tidak dikenali');
        }
    }

    public function register(Request $request)
    {
        $newUser = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        $newUser['password'] = \Illuminate\Support\Facades\Hash::make($newUser['password']);
        User::create($newUser);

        return redirect('login')->with('status', 'success')->with(['pesan' => 'Berhasil membuat akun, silakan login untuk masuk kehalaman website.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('status', 'success')->with('pesan', 'Berhasil Keluar');
    }
}
