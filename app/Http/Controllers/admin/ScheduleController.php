<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;   // pastikan model Schedule sudah dibuat
use App\Models\Course;
use App\Models\Lecturer;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['course','lecturer'])->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses   = Course::all();
        $lecturers = Lecturer::all();
        return view('admin.schedules.create', compact('courses','lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'day'         => 'required|string|max:20',
            'time'        => 'required|string|max:20',
            'room'        => 'required|string|max:50',
        ]);

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')
                         ->with('success','Schedule created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schedule = Schedule::with(['course','lecturer'])->findOrFail($id);
        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule  = Schedule::findOrFail($id);
        $courses   = Course::all();
        $lecturers = Lecturer::all();
        return view('admin.schedules.edit', compact('schedule','courses','lecturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'day'         => 'required|string|max:20',
            'time'        => 'required|string|max:20',
            'room'        => 'required|string|max:50',
        ]);

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')
                         ->with('success','Schedule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
                         ->with('success','Schedule deleted successfully!');
    }
}