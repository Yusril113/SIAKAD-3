<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Dasar (Disinkronkan dengan value di View: mahasiswa, dosen, admin)
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:mahasiswa,dosen,admin'],
        ];

        // 2. Validasi Spesifik (Hanya NIM dan NIDN sesuai form terbaru)
        if ($request->role === 'mahasiswa') {
            $rules['nim'] = ['required', 'string', 'max:20', 'unique:mahasiswa,nim'];
        } elseif ($request->role === 'dosen') {
            $rules['nidn'] = ['required', 'string', 'max:20', 'unique:lecturers,nidn'];
        }

        $request->validate($rules);
        $roleName = strtolower($request->role);
        // 3. Cari Role ID berdasarkan nama (mahasiswa/dosen/admin)
        $role = Role::where('name', $request->role)->first();
        if (!$role) {
            return back()->withErrors(['role' => 'Role tidak ditemukan di database.'])->withInput();
        }

        // 4. Buat User Utama
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'role' => $request->role, // Menyimpan string role untuk Middleware CheckRole
            'active' => true,
        ]);

        // 5. Buat Data Relasi
        if ($request->role === 'mahasiswa') {
            \App\Models\Mahasiswa::create([ // Pastikan pakai model Mahasiswa
                'user_id' => $user->id,
                'nim' => $request->nim,
            ]);
        } elseif ($request->role === 'dosen') {
            Lecturer::create([
                'user_id' => $user->id,
                'nidn' => $request->nidn,
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        // Mengarahkan berdasarkan role menggunakan logic di RouteServiceProvider
        return redirect(RouteServiceProvider::HOME);
    }
}
