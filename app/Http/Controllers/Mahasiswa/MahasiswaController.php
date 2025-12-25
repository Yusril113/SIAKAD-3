<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan halaman dashboard Mahasiswa.
     */
    public function dashboard()
    {
        // Perbaikan: Memanggil view yang benar: 
        // 'mahasiswa.dashboard' merujuk ke resources/views/mahasiswa/dashboard.blade.php
        return view('mahasiswa.dashboard');
    }
    public function schedule()
    {
        return view('mahasiswa.schedule');
    }
}
