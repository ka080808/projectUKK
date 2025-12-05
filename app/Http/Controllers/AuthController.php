<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('warga.index');
        }
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Debug: Log attempt
        \Log::info('Login attempt', ['email' => $credentials['email']]);

        // Check if user exists
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            \Log::warning('User not found', ['email' => $credentials['email']]);
            return back()->withInput($request->only('email'))
                ->with('error', 'Email atau password salah ❌');
        }

        // Check password
        if (!\Hash::check($credentials['password'], $user->password)) {
            \Log::warning('Wrong password', ['email' => $credentials['email']]);
            return back()->withInput($request->only('email'))
                ->with('error', 'Email atau password salah ❌');
        }

        // Try Auth::attempt
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            \Log::info('Login success', ['email' => $credentials['email']]);
            
            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Berhasil login! 😊');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'Berhasil login! 😊');
            }
        }

        \Log::error('Auth attempt failed', ['email' => $credentials['email']]);
        return back()->withInput($request->only('email'))->with('error', 'Email atau password salah ❌');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout! 👋');
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('warga.index');
        }
        return view('auth.register');
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login. ✅');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
