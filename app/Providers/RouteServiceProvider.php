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
     *
     * @return string
     */
    public static function redirectBasedOnRole(): string
    {
        // Pastikan pengguna telah login sebelum mencoba mengakses data role.
        if (!Auth::check()) {
             return '/login'; // Jika belum login, kembalikan ke halaman login
        }
        
        // Menggunakan accessor 'role_name' yang sudah kita definisikan di Model User
        // atau fallback ke relasi jika accessor tidak didefinisikan.
        // Di sini kita menggunakan operator null-safe (?->) dan null coalescing (??) 
        // untuk mencegah error jika relasi 'role' belum dimuat atau null.
        $user = Auth::user();
        $roleName = $user->role_name ?? ($user->role->name ?? null);
        
        // Jika Anda telah mendefinisikan route name di web.php (e.g., admin.dashboard),
        // lebih baik menggunakan helper route() daripada path statis.
        return match ($roleName) {
            'admin' => route('admin.dashboard'),
            'lecturer' => route('lecturer.dashboard'),
            'student' => route('student.dashboard'),
            default => self::HOME,
        };
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        // Pastikan route service provider dapat menggunakan fungsi route()
        // dengan memanggil parent::boot() sebelum mendefinisikan routes kustom.
        parent::boot(); 

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}