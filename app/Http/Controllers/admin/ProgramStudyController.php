<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudy;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProgramStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $programStudies = ProgramStudy::latest()->paginate(10);
        return view('admin.program-studies.index', compact('programStudies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.program-studies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:program_studies,name',
            'code' => 'required|string|max:10|unique:program_studies,code',
            'description' => 'nullable|string',
        ]);

        ProgramStudy::create($validated);

        return redirect()->route('admin.program-studies.index')
                         ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudy $programStudy): View
    {
        return view('admin.program-studies.edit', compact('programStudy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramStudy $programStudy): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:program_studies,name,' . $programStudy->id,
            'code' => 'required|string|max:10|unique:program_studies,code,' . $programStudy->id,
            'description' => 'nullable|string',
        ]);

        $programStudy->update($validated);

        return redirect()->route('admin.program-studies.index')
                         ->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudy $programStudy): RedirectResponse
    {
        // PENCEGAHAN: Cek jika ada Course atau Student yang masih terikat
        if ($programStudy->courses()->exists() || $programStudy->students()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus Program Studi karena masih memiliki Mata Kuliah atau Mahasiswa terikat.');
        }

        $programStudy->delete();

        return redirect()->route('admin.program-studies.index')
                         ->with('success', 'Program Studi berhasil dihapus.');
    }
}