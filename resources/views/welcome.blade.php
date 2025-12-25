<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Login</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-gray-100">

    {{-- Container Utama untuk Pemusatan (Centering) --}}
    <div class="flex items-center justify-center min-h-screen p-4">
        
        {{-- Card/Kotak Form Login --}}
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-sm">
            
            {{-- Konten Form Anda (Disesuaikan dengan Gambar) --}}
            <div class="text-center mb-6">
                <h1 class="text-3xl font-extrabold text-gray-800">SIAKAD</h1>
                <p class="text-gray-500">Masuk untuk mengakses sistem akademik Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                {{-- Email / Username --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 sr-only">Email / Username</label>
                    <input type="text" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Email / Username" required>
                </div>
                
                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 sr-only">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Password" required>
                        {{-- Icon centang (simulasi dari gambar) --}}
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-green-500">✅</span>
                        </div>
                    </div>
                </div>

                {{-- Ingat Saya & Lupa Password --}}
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center text-gray-700">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2">Ingat Saya</span>
                    </label>
                    <a href="dashboard" class="font-medium text-indigo-600 hover:text-indigo-500">Lupa Password?</a>
                </div>

                {{-- Tombol Login --}}
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                    Masuk
                </button>
            </form>
            
            {{-- Link Daftar Sekarang --}}
            <div class="mt-6 text-center text-sm">
                <p class="text-gray-600">Belum punya akun? 
                    <a href="/register" class="font-medium text-indigo-600 hover:underline">Daftar Sekarang</a>
                </p>
            </div>
            
        </div>
        
    </div>
</body>
</html>