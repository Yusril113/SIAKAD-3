<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class KhsController extends Controller
{
    public function index(Request $request) {
    $student = Auth::user()->student;
    $semesterId = $request->get('semester_id');
    $enrollments = Enrollment::with(['classOffering.course','grade','classOffering.semester'])
      ->where('student_id',$student->id)
      ->when($semesterId, fn($q)=>$q->whereHas('classOffering', fn($q2)=>$q2->where('semester_id',$semesterId)))
      ->get();

    return view('student.khs.index', compact('enrollments','semesterId'));
  }
}

