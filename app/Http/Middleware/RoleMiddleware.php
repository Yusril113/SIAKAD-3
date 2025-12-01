<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles) {
    $user = $request->user();
    if(!$user || !$user->is_active) abort(403);
    if(!in_array($user->role->name, $roles)) abort(403);
    return $next($request);
  }

}
