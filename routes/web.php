<?php

// JANGAN gunakan namespace di sini! Langsung gunakan 'use' statements.
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini buat fix image_813ede
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Lecturer\LecturerController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ProfileController;

// Import Controller Mahasiswa (M Kapital sesuai folder)
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Mahasiswa\KhsController;
use App\Http\Controllers\Mahasiswa\AttendanceController as StudentAttendanceController;

// Import Controller Dosen
use App\Http\Controllers\Lecturer\AttendanceController as LecturerAttendanceController;
use App\Http\Controllers\Lecturer\GradeController;

// Halaman Utama
Route::get('/', fn() => view('welcome'));

// Auth rute (Login & Register)
require __DIR__.'/auth.php';

// =========================================================================
// FIX: DASHBOARD REDIRECTOR (Supaya gak 404 setelah login/regis)
// =========================================================================
Route::get('/dashboard', function () {
    $user = Auth::user(); // Pakai Facade Auth

    if (!$user) {
        return redirect()->route('login');
    }

    // Redirect otomatis ke rute yang ada prefix-nya sesuai role di database
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'dosen') {
        return redirect()->route('lecturer.dashboard');
    } elseif ($user->role === 'mahasiswa') {
        return redirect()->route('student.dashboard');
    }

    abort(403, 'Role [' . $user->role . '] tidak terdaftar di sistem.');
})->middleware(['auth'])->name('dashboard');


// =========================================================================
// 1. ROUTE PROFILE (Semua yang login)
// =========================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================================
// 2. ROUTE ADMIN (Middleware: role:admin)
// =========================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); 
    
    Route::resource('/courses', \App\Http\Controllers\Admin\CourseController::class);
    Route::resource('/program-studies', \App\Http\Controllers\Admin\ProgramStudyController::class);
    Route::resource('/lecturers', \App\Http\Controllers\Admin\LecturerController::class);
    Route::resource('/students', \App\Http\Controllers\Admin\StudentController::class);
    Route::resource('/semesters', \App\Http\Controllers\Admin\SemesterController::class);
    Route::resource('/class-offerings', \App\Http\Controllers\Admin\ClassOfferingController::class);
    Route::resource('/schedules', \App\Http\Controllers\Admin\ScheduleController::class);
    
    Route::post('/users/{user}/activate', [AdminController::class, 'activate'])->name('users.activate');
});

// =========================================================================
// 3. ROUTE DOSEN (Middleware: role:dosen)
// =========================================================================
Route::middleware(['auth', 'role:dosen'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('dashboard');
    
    Route::post('/class-offerings/{id}/attendance/open', [LecturerAttendanceController::class, 'open'])->name('attendance.open');
    Route::post('/class-offerings/{id}/attendance/close', [LecturerAttendanceController::class, 'close'])->name('attendance.close');
    
    Route::post('/grades/{enrollment}', [GradeController::class, 'storeOrUpdate'])->name('grades.store');
    Route::resource('/assignments', AssignmentController::class);
});

// =========================================================================
// 4. ROUTE MAHASISWA (Middleware: role:mahasiswa)
// =========================================================================
Route::middleware(['auth', 'role:mahasiswa'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
    Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
    Route::get('/khs', [KhsController::class, 'index'])->name('khs.index');
    Route::get('/schedule', [MahasiswaController::class, 'schedule'])->name('schedule');
    Route::post('/attendance/{enrollment}', [StudentAttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/assignments/{assignment}/submit/{enrollment}', [AssignmentController::class, 'submit'])->name('assignments.submit');
});

// Fallback 404 biar gak error image_7ff4a5
Route::fallback(function () {
    abort(404); 
});