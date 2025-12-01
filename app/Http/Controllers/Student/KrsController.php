<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Models\ClassOffering;

class Enrollments extends Controller
{
    public function index() {
    $student = Auth::user()->student;
    $currentSemester = Semester::whereDate('start_date','<=', now())
      ->whereDate('end_date','>=', now())->first();
    $offerings = ClassOffering::with('course','lecturer.user')
      ->where('semester_id', optional($currentSemester)->id)->get();
    $myEnrolls = Enrollment::with('classOffering.course')->where('student_id',$student->id)->get();

    return view('student.krs.index', compact('offerings','myEnrolls','currentSemester'));
  }

  public function store(Request $request) {
    $request->validate(['class_offering_id' => 'required|exists:class_offerings,id']);
    $student = Auth::user()->student;
    Enrollment::firstOrCreate([
      'student_id' => $student->id,
      'class_offering_id' => $request->class_offering_id
    ]);
    return back()->with('success','KRS ditambahkan.');
  }

}
