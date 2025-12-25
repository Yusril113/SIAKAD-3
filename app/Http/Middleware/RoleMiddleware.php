<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Sesuaikan kolom 'active' (bukan is_active) sesuai RegisteredUserController
        // Berdasarkan kode pendaftaranmu, kolomnya bernama 'active'
        if (!$user->active) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda belum aktif atau dinonaktifkan.');
        }

        // 3. Pengecekan Role
        // Memastikan role user (misal: 'mahasiswa') ada dalam daftar rute
        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak: Anda login sebagai ' . $user->role . ', role ini tidak diizinkan.');
        }

        return $next($request);
    }
}