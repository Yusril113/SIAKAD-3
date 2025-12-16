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
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   * @param  mixed ...$roles
   */
  public function handle(Request $request, Closure $next, ...$roles): Response
  {
    $user = Auth::user();

    if (!$user || !$user->is_active) {
      abort(403, 'Akses ditolak: pengguna tidak aktif.');
    }

    // Jika role disimpan sebagai string langsung
    if (!in_array($user->role, $roles)) {
      abort(403, 'Akses ditolak: role tidak sesuai.');
    }

    return $next($request);
  }
}
