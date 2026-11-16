<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class DemoAuthController extends Controller
{
    public function splash()
    {
        return view('welcome');
    }

    public function loginForm()
    {
        if (session('demo_authenticated')) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'max:100'],
        ]);

        $key = 'demo-login:'.Str::lower($validated['username']).'|'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['username' => 'Too many attempts. Please try again in a minute.'])->onlyInput('username');
        }

        if (!hash_equals('admin', $validated['username']) || !hash_equals('pass123', $validated['password'])) {
            RateLimiter::hit($key, 60);
            return back()->withErrors(['username' => 'Those credentials do not match. Please try again.'])->onlyInput('username');
        }

        RateLimiter::clear($key);
        $request->session()->regenerate();
        $request->session()->put('demo_authenticated', true);
        $request->session()->put('demo_user', ['name' => 'Admin User', 'role' => 'System Administrator']);

        return redirect()->intended(route('dashboard.index'));
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('splash');
    }
}
