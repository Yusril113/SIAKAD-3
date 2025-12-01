<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function store(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'status' => 'required|in:Hadir,Tidak Hadir,Izin',
            'date' => 'required|date',
            'note' => 'nullable|string'
        ]);

        // hanya jika window presensi buka
        if (!$enrollment->classOffering->attendance_open) {
            return back()->with('error', 'Presensi belum dibuka.');
        }

        // pastikan enrollment milik mahasiswa login
        $student = Auth::user()->student;
        if ($enrollment->student_id !== $student->id) {
            abort(403);
        }

        Attendance::updateOrCreate(
            ['enrollment_id' => $enrollment->id, 'date' => $request->date],
            ['status' => $request->status, 'note' => $request->note]
        );

        return back()->with('success', 'Presensi tersimpan.');
    }
}