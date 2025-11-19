<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show admin login form
    public function showLoginForm()
    {
        return view('admin.auth.login'); // resources/views/admin/login.blade.php
    }

    // Handle login
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            // Login successful
            return redirect()->intended('/admin/dashboard');
        }



        return back()->withInput($request->only('email', 'remember'))
                     ->withErrors(['email' => 'Email or password is incorrect']);
    }

    // Admin logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
