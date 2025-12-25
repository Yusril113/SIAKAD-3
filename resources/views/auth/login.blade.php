<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Login</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen p-4">
        
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-sm">
            
            <div class="text-center mb-6">
                <h1 class="text-3xl font-extrabold text-gray-800">SIAKAD</h1>
                <p class="text-gray-500">Masuk untuk mengakses sistem akademik Anda</p>
            </div>

            {{-- 1. Menampilkan Pesan Error jika Login Gagal --}}
            @if ($errors->any())
                <div class="mb-4 p-2 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                
                {{-- Email / Username --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 sr-only">Email</label>
                    {{-- 2. Tambahkan value="{{ old('email') }}" agar email tidak hilang saat gagal --}}
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                        placeholder="Alamat Email" required autofocus>
                </div>
                
                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 sr-only">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                            placeholder="Password" required>
                    </div>
                </div>

                {{-- Ingat Saya & Lupa Password --}}
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center text-gray-700">
                        {{-- 3. Pastikan name="remember" sesuai standar Laravel --}}
                        <input id="remember_me" name="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Lupa Password?</a>
                    @endif
                </div>

                {{-- Tombol Login --}}
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                    Masuk
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm">
                <p class="text-gray-600">Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:underline">Daftar Sekarang</a>
                </p>
            </div>
            
        </div>
        
    </div>
</body>
</html>