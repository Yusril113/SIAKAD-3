 <?php

// routes/web.php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Lecturer\LecturerController;
use App\Http\Controllers\Student\KrsController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Lecturer\AttendanceController as LecturerAttendanceController;
use App\Http\Controllers\Lecturer\GradeController;
use App\Http\Controllers\Student\KhsController;
use App\Http\Controllers\AssignmentController;

Route::get('/', fn() => view('welcome'));

// Auth routes dari Breeze (login, register)
require __DIR__.'/auth.php';

// Admin
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
  Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  Route::resource('/courses', \App\Http\Controllers\Admin\CourseController::class);
  Route::resource('/lecturers', \App\Http\Controllers\Admin\LecturerController::class);
  Route::resource('/students', \App\Http\Controllers\Admin\StudentController::class);
  Route::resource('/semesters', \App\Http\Controllers\Admin\SemesterController::class);
  Route::resource('/class-offerings', \App\Http\Controllers\Admin\ClassOfferingController::class);
  Route::resource('/schedules', \App\Http\Controllers\Admin\ScheduleController::class);
  Route::post('/users/{user}/activate', [AdminController::class, 'activate'])->name('admin.users.activate');
});

// Dosen
Route::middleware(['auth','role:lecturer'])->prefix('lecturer')->group(function(){
  Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('lecturer.dashboard');
  Route::post('/class-offerings/{id}/attendance/open', [LecturerAttendanceController::class, 'open'])->name('attendance.open');
  Route::post('/class-offerings/{id}/attendance/close', [LecturerAttendanceController::class, 'close'])->name('attendance.close');
  Route::post('/grades/{enrollment}', [GradeController::class, 'storeOrUpdate'])->name('grades.store');
  Route::resource('/assignments', AssignmentController::class)->only(['index','create','store','show','edit','update','destroy']);
});

// Mahasiswa
Route::middleware(['auth','role:student'])->prefix('student')->group(function(){
  Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
  Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
  Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
  Route::get('/khs', [KhsController::class, 'index'])->name('khs.index');
  Route::get('/schedule', [StudentController::class, 'schedule'])->name('student.schedule');
  Route::post('/attendance/{enrollment}', [StudentAttendanceController::class, 'store'])->name('attendance.store');
  Route::post('/assignments/{assignment}/submit/{enrollment}', [AssignmentController::class, 'submit'])->name('assignments.submit');
});
// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php'; 
