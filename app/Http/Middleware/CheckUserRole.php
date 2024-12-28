<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Arahkan ke halaman login jika pengguna belum login
        }

        $user = Auth::user();

        // Cek apakah peran pengguna sesuai
        if ($role === 'admin' && $user->role !== 'admin') {
            return redirect()->route('user.dashboard'); // Pengguna bukan admin, alihkan ke user dashboard
        }

        if ($role === 'user' && $user->role !== 'user') {
            return redirect()->route('admin.dashboard'); // Pengguna bukan user, alihkan ke admin dashboard
        }

        // Jika role sesuai, lanjutkan ke request berikutnya
        return $next($request);
    }
}
