<x-guest-layout>
    {{-- Menggunakan x-data AlpineJS untuk melacak peran yang dipilih --}}
    <form method="POST" action="{{ route('register') }}" x-data="{ selectedRole: '{{ old('role', '') }}' }">
        @csrf

        {{-- 1. PILIHAN ROLE (DISINKRONKAN DENGAN WEB.PHP) --}}
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" x-model="selectedRole" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Pilih Role</option>
                {{-- Value diubah agar sesuai dengan middleware di web.php --}}
                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        {{-- 2. BIDANG UMUM (USERNAME) --}}
        <div class="mt-4">
            <x-input-label for="name" :value="__('Username')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- 3. BIDANG KHUSUS MAHASISWA (NIM) --}}
        {{-- Menggunakan 'mahasiswa' sesuai value select di atas --}}
        <div class="mt-4" x-show="selectedRole === 'mahasiswa'" x-transition>
            <x-input-label for="nim">NIM (Nomor Induk Mahasiswa)</x-input-label>
            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
        </div>

        {{-- 4. BIDANG KHUSUS DOSEN (NIDN) --}}
        {{-- Menggunakan 'dosen' sesuai value select di atas --}}
        <div class="mt-4" x-show="selectedRole === 'dosen'" x-transition>
            <x-input-label for="nidn">NIDN (Nomor Induk Dosen Nasional)</x-input-label>
            <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn" :value="old('nidn')" />
            <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
        </div>

        {{-- 5. BIDANG UMUM (EMAIL) --}}
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- 6. BIDANG UMUM (PASSWORD) --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- 7. BIDANG UMUM (KONFIRMASI PASSWORD) --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah terdaftar?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>