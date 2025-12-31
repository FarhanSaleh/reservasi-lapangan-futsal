<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('dashboard'); // arahkan ke dashboard
        }
        return view('tes.auth.login'); // arahkan ke halaman login
    }
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('dashboard'); // arahkan ke dashboard
        }
        return view('tes.auth.register'); // arahkan ke halaman register
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil credentials
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Attempt login
        if (Auth::attempt($credentials, $remember)) {
            // Login berhasil
            $request->session()->regenerate();
            catat_log('login', 'Melakukan Login');
            return redirect('/dashboard'); // arahkan ke halaman dashboard
        }

        // Login gagal
        catat_log('login', 'Gagal Login');
        return redirect()->back()->with('error', 'Login gagal, coba lagi'); // arahkan ke kembali ke halaman login karena gagal
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat user baru dengan role user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3, // id role user
        ]);

        catat_log('register', 'Melakukan Register');
        return redirect('/login')->with('success', 'Register berhasil, silakan login');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        catat_log('logout', 'Melakukan Logout');
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // arahkan kehalaman login
    }
}
