<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Tampilkan halaman dashboard untuk lecturer.
     */
    public function dashboard()
    {
        // Bisa return view atau data sesuai kebutuhan
        return view('lecturer.dashboard');
    }
}