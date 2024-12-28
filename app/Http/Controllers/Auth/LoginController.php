<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{

public function showLoginForm()
{
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        } else {
            return redirect()->route('user.dashboard'); // Redirect to user dashboard
        }
    }
    return view('auth.login');
}


    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Cek role setelah login
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard'); // Arahkan ke dashboard admin
            } elseif ($role === 'user') {
                return redirect()->route('user.dashboard'); // Arahkan ke dashboard user
            }

            // Logout jika role tidak dikenal (opsional)
            Auth::logout();
            return back()->withErrors(['email' => 'Role tidak valid.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Alert::success('Logged Out', 'You have successfully logged out.');
        return redirect()->route('login');
    }
}
