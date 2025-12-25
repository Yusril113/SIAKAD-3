{{-- HAPUS: @extends('layouts.app') --}}
{{-- HAPUS: @section('content') --}}
{{-- HAPUS: @endsection --}}

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-2xl font-bold mb-4">Dashboard Mahasiswa</h1>
        <p class="mb-4">Selamat datang, {{ Auth::user()->name }}! Anda login sebagai Mahasiswa.</p>
        
        <ul class="list-disc ml-6">
            {{-- Tambahkan link ke route yang sudah Anda definisikan --}}
            <li><a href="{{ route('student.krs.index') }}" class="text-indigo-600 hover:text-indigo-800">Isi KRS</a></li>
            <li><a href="{{ route('student.khs.index') }}" class="text-indigo-600 hover:text-indigo-800">Lihat KHS</a></li>
            <li><a href="{{ route('student.schedule') }}" class="text-indigo-600 hover:text-indigo-800">Lihat Jadwal Kuliah</a></li>
        </ul>
    </div>
</div>