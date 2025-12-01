<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassOffering;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecturer;


class AttendanceController extends Controller
{
    public function open($id){
    $class = ClassOffering::findOrFail($id);
    $this->authorizeClass($class);
    $class->update(['attendance_open' => true]);
    return back()->with('success','Presensi dibuka.');
  }
  public function close($id){
    $class = ClassOffering::findOrFail($id);
    $this->authorizeClass($class);
    $class->update(['attendance_open' => false]);
    return back()->with('success','Presensi ditutup.');
  }
  private function authorizeClass(ClassOffering $class){
    $lecturer = Auth::user()->lecturer;
    if($class->lecturer_id !== $lecturer->id) abort(403);
  }

}
