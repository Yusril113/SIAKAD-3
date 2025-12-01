<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Course;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $students = Student::count();
        $lecturers = Lecturer::count();
        $courses = Course::count();
        $users = User::count();

        return view('admin.dashboard', compact('students', 'lecturers', 'courses', 'users'));
    }
}
