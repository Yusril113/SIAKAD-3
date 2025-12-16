{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $role = Auth::user()->role;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    {{-- Include dashboard content based on role --}}
    @if ($role === 'admin')
        @include('dashboard.admin')
    @elseif ($role === 'lecturer')
        @include('dashboard.lecturer')
    @elseif ($role === 'student')
        @include('dashboard.student')
    @else
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-red-100 text-red-800 p-4 rounded">
                Role tidak dikenali.
            </div>
        </div>
    @endif
</x-app-layout>