<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission;
use App\Models\Assignment;
use App\Models\ClassOffering;
use App\Models\Enrollment;

class AssignmentController extends Controller
{
    public function index()
    {
        // Dosen melihat assignment per kelas yang dia ajar
        $lecturer = Auth::user()->lecturer;
        $assignments = Assignment::with('classOffering.course')
            ->whereHas('classOffering', fn($q) => $q->where('lecturer_id', $lecturer->id))->get();
        return view('lecturer.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $classes = ClassOffering::where('lecturer_id', Auth::user()->lecturer->id)->get();
        return view('lecturer.assignments.create', compact('classes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_offering_id' => 'required|exists:class_offerings,id',
            'title' => 'required|string',
            'due_at' => 'nullable|date'
        ]);
        $class = ClassOffering::findOrFail($request->class_offering_id);
        if ($class->lecturer_id !== Auth::user()->lecturer->id) abort(403);

        Assignment::create($request->only('class_offering_id', 'title', 'description', 'due_at'));
        return redirect()->route('assignments.index')->with('success', 'Tugas dibuat.');
    }

    public function submit(Request $request, Assignment $assignment, Enrollment $enrollment)
    {
        // mahasiswa upload tugas
        if ($enrollment->student_id !== Auth::user()->student->id) abort(403);
        $request->validate(['file' => 'required|file|max:10240']);
        $path = $request->file('file')->store('submissions', 'public');

        Submission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'enrollment_id' => $enrollment->id],
            ['file_path' => $path, 'submitted_at' => now()]
        );
        return back()->with('success', 'Tugas dikumpulkan.');
    }
}
