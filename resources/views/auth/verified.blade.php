<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Berhasil</title>
    {{-- Asumsikan CSS Anda dimuat di sini, termasuk Tailwind --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-200">

    {{-- Container Utama (Memusatkan Kartu di Tengah Layar) --}}
    <div class="flex items-center justify-center min-h-screen p-4">

        {{-- Kartu Sukses - Disesuaikan untuk Dark Mode --}}
        <div
            class="bg-white dark:bg-gray-800 p-8 sm:p-10 rounded-xl shadow-2xl max-w-sm w-full text-center 
                    transform transition duration-500 hover:scale-[1.01] animate-fade-in-up">

            {{-- Ikon Sukses --}}
            <div class="mx-auto w-20 h-20 text-green-500 mb-4 
                        bg-green-100 dark:bg-green-800/20 rounded-full flex items-center justify-center 
                        animate-slide-in-up"
                style="animation-delay: 0s;">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100 mb-3 animate-fade-in-up"
                style="animation-delay: 0.1s;">
                Verifikasi Sukses!
            </h1>

            {{-- Deskripsi --}}
            <p class="text-gray-600 dark:text-gray-400 mb-6 text-base animate-fade-in-up"
                style="animation-delay: 0.2s;">
                Selamat! Email Anda **telah berhasil dikonfirmasi**. Akun Anda kini aktif sepenuhnya.
            </p>

            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                Anda dapat menutup tab ini.
            </p>
        </div>
        {{-- Akhir Kartu Sukses --}}

    </div>
</body>

</html>
