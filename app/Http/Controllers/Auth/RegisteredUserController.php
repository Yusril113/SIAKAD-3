<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'role' => ['required', 'in:student,lecturer,admin'],
            'nim' => ['required', 'string', 'max:20'],
            'program_studi' => ['required', 'string'],
            'angkatan' => ['required', 'numeric'],

        ]);

        $role = Role::where('name', $request->role)->first();
        if (!$role) {
            return back()->withErrors(['role' => 'Role tidak valid atau belum tersedia.']);
        }
        $role_id = $role->id;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role_id,
            'active' => true, // kalau kamu pakai kolom active
        ]);

        match ($request->role) {
            'student' => Student::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'program_studi' => $request->program_studi,
                'angkatan' => $request->angkatan,
            ]),
            'lecturer' => Lecturer::create([
                'user_id' => $user->id,
                'nidn' => $request->nidn,
            ]),
            default => null,
        };

        event(new Registered($user));
        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::redirectBasedOnRole());
    }
}
