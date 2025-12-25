<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard utama Admin dengan ringkasan statistik.
     */
    public function dashboard()
    {
        $students  = Student::count();
        $lecturers = Lecturer::count();
        $courses   = Course::count();
        $users     = User::count();

        return view('admin.dashboard', compact('students', 'lecturers', 'courses', 'users'));
    }

    /**
     * Mengaktifkan akun user.
     */
    public function activate(User $user)
    {
        $user->update(['active' => true]);

        return back()->with('success', 'Akun ' . $user->name . ' berhasil diaktifkan.');
    }
}