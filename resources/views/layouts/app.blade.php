
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title','SIAKAD')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow p-4">
        <a href="/">SIAKAD</a>
        @auth
        <span class="ml-4">{{ auth()->user()->name }} ({{ auth()->user()->role->name }})</span>
        <form class="inline ml-4" method="POST" action="{{ route('logout') }}">@csrf<button>Logout</button></form>
        @endauth
    </nav>
    <main class="p-6">@yield('content')</main>
</body>

</html>







<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->
<!-- <head>
        <meta charset="utf-8">
        <title>@yield('title', 'SIAKAD')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title> -->

<!-- Fonts -->
<!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        Scripts -->
<!-- @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation') -->

<!-- Page Heading -->
<!-- @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset -->

<!-- Page Content -->
<!-- <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> -->