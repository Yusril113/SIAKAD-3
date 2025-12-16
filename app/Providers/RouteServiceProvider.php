<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Default path to redirect after login.
     */
    public const HOME = '/dashboard';

    /**
     * Redirect user based on their role.
     */
    public static function redirectBasedOnRole(): string
    {
        $role = Auth::user()->role->name ?? null;

        return match ($role) {
            'admin' => '/admin/dashboard',
            'lecturer' => '/lecturer/dashboard',
            'student' => '/student/dashboard',
            default => self::HOME,
        };
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}