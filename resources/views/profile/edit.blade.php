@extends('layouts.app')

@section('title', 'Pengaturan Akun')

{{-- Header --}}
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Pengaturan Akun') }}
    </h2>

@endsection

@section('content')
    <div class="py-12" x-data="{ currentTab: 'info' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="lg:flex lg:space-x-8">

                {{-- dadada --}}
                {{-- KOLOM KIRI: SIDEBAR AKUN (Foto Profil & Navigasi) --}}
                <div class="lg:w-1/4 mb-6 lg:mb-0">
                    <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg border border-gray-700">

                        {{-- --- WARNING VERIFIKASI EMAIL (TAMBAHAN BARU) --- --}}
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-yellow-900 dark:text-yellow-300 border-l-4 border-yellow-500"
                                role="alert">
                                <p class="font-bold mb-1">Penting: Akun Belum Terverifikasi!</p>
                                <p>Silakan periksa email Anda untuk memverifikasi akun. Anda **tidak dapat** melakukan
                                    *checkout* sebelum diverifikasi.</p>

                                {{-- Tombol Kirim Ulang Link Verifikasi --}}
                                <form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm font-semibold underline text-yellow-500 hover:text-yellow-600 focus:outline-none">
                                        Kirim Ulang Link Verifikasi
                                    </button>
                                </form>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        Link baru telah terkirim ke email Anda.
                                    </p>
                                @endif
                            </div>
                        @endif

                        {{-- Info Profil --}}
                        <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data"
                            x-data="{ photoName: null, photoPreview: null }" class="flex flex-col items-center pb-6 border-b border-gray-700/50">
                            @csrf

                            {{-- Input file tersembunyi --}}
                            <input type="file" name="profile_photo" id="photo" class="hidden" x-ref="photo"
                                @change="
                                       const file = $refs.photo.files[0];
                                       if (!file) return;

                                       photoName = file.name;
                                       const reader = new FileReader();
                                       reader.onload = (e) => {
                                           photoPreview = e.target.result;
                                       };
                                       reader.readAsDataURL(file);
                                   " />

                            {{-- Foto Profil Besar (Area Klik) --}}
                            <div class="relative group mb-3">
                                <img class="w-24 h-24 rounded-full object-cover border-4 border-emerald-500 cursor-pointer transition-opacity duration-300"
                                    :src="photoPreview ? photoPreview : '{{ $user->profile_photo_url }}'"
                                    alt="{{ $user->name }}" @click.prevent="$refs.photo.click()">

                                {{-- Overlay "Ganti" saat di-hover --}}
                                <div @click.prevent="$refs.photo.click()"
                                    class="absolute inset-0 w-24 h-24 rounded-full bg-black bg-opacity-50 flex items-center justify-center text-white text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                    Ganti
                                </div>
                            </div>

                            {{-- Info User --}}
                            <h5 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h5>


                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</span>

                                {{-- Logika ICON WARNING BELUM VERIFIKASI GMAIL --}}
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    {{-- Icon warning (Ganti dengan ikon Tailwind/Flowbite Anda, contoh menggunakan SVG sederhana) --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-4 h-4 text-yellow-500" title="Email belum terverifikasi">
                                        <path fill-rule="evenodd"
                                            d="M8.485 2.495c.791-1.35 2.723-1.35 3.514 0l7.004 12c.792 1.35-.192 3.005-1.757 3.005H3.238c-1.565 0-2.549-1.655-1.757-3.005l7.004-12zM10 13a1 1 0 100 2 1 1 0 000-2zm0-7a1 1 0 011 1v3a1 1 0 11-2 0V7a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>

                            {{-- Kriteria & Validasi --}}
                            <p class="text-xs text-center text-gray-400 mt-2">
                                Format: **JPG, JPEG, PNG**. Maks: **2MB**.
                            </p>

                            {{-- Tombol Simpan (Hanya Tampil setelah foto dipilih) --}}
                            <div class="mt-4 w-full text-center" x-show="photoPreview">
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
                                    Simpan Foto Baru
                                </button>
                            </div>

                            {{-- Menampilkan Error Validasi Foto --}}
                            @error('profile_photo', 'updateProfilePhoto')
                                <p class="mt-2 text-sm text-red-500 text-center">{{ $message }}</p>
                            @enderror

                            {{-- Menampilkan Pesan Sukses --}}
                            @if (session('status') === 'profile-photo-updated')
                                <p class="mt-2 text-sm text-green-500 text-center">Foto profil berhasil diperbarui! 🎉</p>
                            @endif

                        </form>

                        {{-- Navigasi Tab --}}
                        <ul class="mt-4 space-y-2">
                            <li>
                                <button @click="currentTab = 'info'"
                                    :class="{ 'bg-emerald-500 text-white hover:bg-emerald-600': currentTab === 'info', 'text-gray-300 hover:bg-gray-700': currentTab !== 'info' }"
                                    class="w-full text-left px-4 py-2 rounded-lg font-medium transition duration-150">
                                    Informasi Profil
                                </button>
                            </li>
                            <li>
                                <button @click="currentTab = 'password'"
                                    :class="{ 'bg-emerald-500 text-white hover:bg-emerald-600': currentTab === 'password', 'text-gray-300 hover:bg-gray-700': currentTab !== 'password' }"
                                    class="w-full text-left px-4 py-2 rounded-lg font-medium transition duration-150">
                                    Ubah Kata Sandi
                                </button>
                            </li>
                            <li>
                                <button @click="currentTab = 'delete'"
                                    :class="{ 'bg-red-600 text-white hover:bg-red-700': currentTab === 'delete', 'text-red-400 hover:bg-gray-700': currentTab !== 'delete' }"
                                    class="w-full text-left px-4 py-2 rounded-lg font-medium transition duration-150">
                                    Hapus Akun
                                </button>
                            </li>
                        </ul>

                    </div>
                </div>

                {{-- KOLOM KANAN: KONTEN FORMULIR (Tab Content) --}}
                <div class="lg:w-3/4 space-y-6">

                    {{-- 1. Tab: Informasi Profil --}}
                    <div x-show="currentTab === 'info'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg border border-gray-700">
                            <header class="mb-4">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Informasi Profil</h2>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Perbarui informasi dasar akun
                                    dan alamat email Anda.</p>
                            </header>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    {{-- 2. Tab: Ubah Kata Sandi --}}
                    <div x-show="currentTab === 'password'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg border border-gray-700">
                            <header class="mb-4">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Ubah Kata Sandi</h2>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pastikan akun Anda menggunakan
                                    kata sandi yang panjang dan acak untuk tetap aman.</p>
                            </header>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- 3. Tab: Hapus Akun --}}
                    <div x-show="currentTab === 'delete'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg border border-gray-700">
                            <header class="mb-4">
                                <h2 class="text-2xl font-bold text-red-600 dark:text-red-500">Hapus Akun</h2>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Setelah akun Anda dihapus,
                                    semua sumber daya dan data akan dihapus secara permanen.</p>
                            </header>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
