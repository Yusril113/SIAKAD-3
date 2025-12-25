{{-- resources/views/dashboard.blade.php (Main File) --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
            {{-- Perbaikan: Sesuaikan string role dengan data di database --}}
            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                @if (Auth::user()->role === 'admin') bg-red-600 text-white 
                @elseif (Auth::user()->role === 'dosen') bg-teal-600 text-white 
                @elseif (Auth::user()->role === 'mahasiswa') bg-indigo-600 text-white 
                @else bg-gray-500 text-white 
                @endif">
                {{ strtoupper(Auth::user()->role) }}
            </span>
        </div>
    </x-slot>

    @php
        $role = Auth::user()->role;
        $userName = Auth::user()->name;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Sambutan --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 mb-8 border-b-4 border-indigo-500">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Halo, {{ $userName }}!
                </h1>
                <p class="text-gray-600 mt-1">
                    Selamat datang di Sistem Informasi Akademik (SIAKAD)
                </p>
            </div>

            {{-- Perbaikan: Sesuaikan pemanggilan path folder view --}}
            @if ($role === 'admin')
                @include('admin.dashboard_content') {{-- Sesuaikan nama file di folder admin --}}
            @elseif ($role === 'dosen')
                @include('lecturer.dashboard_content') {{-- Folder lecturer sesuai struktur --}}
            @elseif ($role === 'mahasiswa')
                @include('mahasiswa.dashboard_content') {{-- Gunakan folder Mahasiswa --}}
            @else
                <div class="bg-red-100 text-red-800 p-4 rounded-lg shadow-md">
                    Role [{{ $role }}] tidak dikenali. Silakan hubungi administrator sistem.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>