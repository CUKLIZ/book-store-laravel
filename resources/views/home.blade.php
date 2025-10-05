@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')

    {{-- Carousel --}}
    <section class="mb-12">
        <div id="default-carousel" class="relative w-full overflow-hidden rounded-lg shadow-xl" data-carousel="slide" data-carousel-interval="5000">
            {{-- Carousel wrapper (container untuk semua slide) --}}
            <div class="relative h-72 sm:h-80 md:h-96 lg:h-[450px] overflow-hidden"> {{-- Tinggi carousel yang lebih proporsional dan responsif --}}
                {{-- Item 1 --}}
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://picsum.photos/1920/800?random=1" {{-- Ubah rasio gambar agar tidak terlalu tinggi --}}
                        class="absolute block w-full h-full object-cover top-0 left-0" alt="Banner 1"> {{-- Positioning yang lebih sederhana --}}
                    <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4">
                        <div class="text-center max-w-2xl mx-auto"> {{-- Batasi lebar teks untuk keterbacaan --}}
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">Temukan Produk Terbaikmu di Sini!</h1>
                            <p class="text-lg sm:text-xl text-gray-200 hidden md:block">Pilihan terlengkap dengan harga bersaing, siap memenuhi kebutuhanmu.</p> {{-- Tambahkan deskripsi --}}
                            <a href="#products-section" class="mt-6 inline-block bg-emerald-500 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-emerald-600 transition duration-300">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                {{-- Item 2 --}}
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://picsum.photos/1920/800?random=2"
                        class="absolute block w-full h-full object-cover top-0 left-0" alt="Banner 2">
                    <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4">
                        <div class="text-center max-w-2xl mx-auto">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">Diskon Spesial Minggu Ini!</h1>
                            <p class="text-lg sm:text-xl text-gray-200 hidden md:block">Jangan lewatkan penawaran terbatas untuk produk pilihan favoritmu.</p>
                            <a href="#products-section" class="mt-6 inline-block bg-indigo-500 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-indigo-600 transition duration-300">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
                {{-- Item 3 --}}
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://picsum.photos/1920/800?random=3"
                        class="absolute block w-full h-full object-cover top-0 left-0" alt="Banner 3">
                    <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4">
                        <div class="text-center max-w-2xl mx-auto">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">Gratis Ongkir untuk Setiap Pembelian</h1>
                            <p class="text-lg sm:text-xl text-gray-200 hidden md:block">Nikmati kemudahan berbelanja tanpa biaya pengiriman tambahan.</p>
                            <a href="#products-section" class="mt-6 inline-block bg-purple-500 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-purple-600 transition duration-300">Klaim Promo</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Slider indicators --}}
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white dark:bg-gray-800/50 dark:hover:bg-gray-800" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white dark:bg-gray-800/50 dark:hover:bg-gray-800" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white dark:bg-gray-800/50 dark:hover:bg-gray-800" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
            </div>
            {{-- Slider controls --}}
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 focus:ring-4 focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:focus:ring-gray-800/70">
                    <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 focus:ring-4 focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:focus:ring-gray-800/70">
                    <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </section>

    {{-- Bagian Kategori (dengan scroll horizontal) --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-white mb-8 text-center">Telusuri Kategori Pilihan</h2>
        {{-- Menggunakan flexbox untuk scroll horizontal --}}
        <div class="flex overflow-x-auto space-x-6 pb-4 scroll-smooth hide-scrollbar">
            @foreach ($categories as $category)
                <div
                    class="flex-shrink-0 w-40 sm:w-48 bg-gray-800 p-4 rounded-lg shadow-md text-center hover:shadow-lg transition duration-300">
                    <img src="https://picsum.photos/100/100?random={{ $category->id }}" alt="{{ $category->name }}"
                        class="w-24 h-24 mx-auto mb-4 rounded-full object-cover border-2 border-emerald-500">
                    <a href="#"
                        class="text-lg font-medium text-gray-300 hover:text-emerald-400">{{ $category->name ?? 'Nama Kategori' }}</a>
                </div>
            @endforeach
        </div>
        {{-- Tombol "Lihat Semua" --}}
        <div class="text-center mt-6">
            <a href="#"
                class="inline-block bg-emerald-600 text-white py-2 px-6 rounded-full hover:bg-emerald-700 transition duration-300">Lihat
                Semua Kategori</a>
        </div>
    </section>

    {{-- Bagian Produk Unggulan --}}
    <section id="products-section"
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-800 rounded-lg shadow-lg mb-12">
        <h2 class="text-3xl font-bold text-white mb-8 text-center">Produk Unggulan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div
                    class="relative bg-gray-700 rounded-lg shadow-xl overflow-hidden transform hover:scale-105 transition duration-300">
                    {{-- Badge Diskon (jika ada) --}}
                    @if (isset($product->discount_percentage) && $product->discount_percentage > 0)
                        <span
                            class="absolute top-2 left-2 bg-red-600 text-white px-3 py-1 text-sm font-bold rounded-br-lg z-10">{{ $product->discount_percentage }}%
                            OFF</span>
                    @endif
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/640x480?text=No+Image' }}"
                        alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-2 truncate">{{ $product->name }}</h3>
                        {{-- Contoh Rating (bisa tambahkan jika ada data rating) --}}
                        <div class="flex items-center text-yellow-400 text-sm mb-2">
                            <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.924 7.625Z"/>
                            </svg>
                            <span>4.5</span>
                            <span class="text-gray-400 text-xs ml-1">(120 Reviews)</span>
                        </div>
                        <p class="text-emerald-400 font-bold text-2xl mb-4">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="#"
                            class="block w-full bg-emerald-500 text-white text-center py-2 px-4 rounded-md hover:bg-emerald-600 transition duration-300">Tambah
                            ke Keranjang</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="#"
                class="inline-block bg-emerald-600 text-white py-3 px-8 rounded-full hover:bg-emerald-700 transition duration-300">Lihat
                Semua Produk</a>
        </div>
    </section>

@endsection

<style>
/* Custom CSS untuk menyembunyikan scrollbar tapi tetap bisa discroll */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Untuk Firefox */
.hide-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>