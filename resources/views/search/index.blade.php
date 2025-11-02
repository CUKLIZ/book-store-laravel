@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Compact Header --}}
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center justify-center p-2.5 bg-gray-800/80 backdrop-blur-sm text-gray-300 rounded-xl hover:bg-gray-700 hover:text-white transition-all duration-300 border border-gray-700/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>

                        @if ($query)
                            <div>
                                <h1 class="text-2xl font-bold text-white flex items-center gap-2">
                                    Hasil untuk
                                    <span class="text-emerald-400">"{{ $query }}"</span>
                                </h1>
                                <p class="text-sm text-gray-400 mt-1">{{ $total }} buku ditemukan</p>
                            </div>
                        @else
                            <h1 class="text-2xl font-bold text-white">Hasil Pencarian</h1>
                        @endif
                    </div>
                </div>
            </div>

            @if ($products->count() > 0)
                {{-- Modern Filter Section with Auto-Apply --}}
                <div class="mb-8">
                    <div class="bg-gray-800/40 backdrop-blur-sm rounded-2xl border border-gray-700/40 overflow-hidden">
                        <div class="p-6">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                                {{-- Stock Filter with Single Toggle Switch --}}
                                <div class="lg:col-span-3">
                                    <label class="block text-xs font-semibold text-gray-300 mb-3 uppercase tracking-wider">
                                        Ketersediaan Stok
                                    </label>
                                    <div>
                                        <label
                                            class="flex items-center justify-between cursor-pointer group bg-gray-700/30 rounded-xl px-4 py-3 hover:bg-gray-700/50 transition-all">
                                            <span
                                                class="text-base text-gray-300 group-hover:text-white transition-colors">Hanya
                                                yang tersedia</span>
                                            <label class="toggle-switch">
                                                <input type="checkbox" id="stock-available"
                                                    {{ request('stock') != 'all' ? 'checked' : '' }}
                                                    onchange="applyFilters()">
                                                <span class="toggle-slider"></span>
                                            </label>
                                        </label>
                                    </div>
                                </div>

                                {{-- Divider --}}
                                <div class="hidden lg:block lg:col-span-1">
                                    <div
                                        class="h-full w-px bg-gradient-to-b from-transparent via-gray-700/50 to-transparent">
                                    </div>
                                </div>

                                {{-- Sort By --}}
                                <div class="lg:col-span-4">
                                    <label class="block text-xs font-semibold text-gray-300 mb-3 uppercase tracking-wider">
                                        Urutkan Berdasarkan
                                    </label>
                                    <select id="sort-select" onchange="applyFilters()"
                                        class="w-full bg-gray-700/50 border border-gray-600/50 text-base text-white rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all cursor-pointer">
                                        <option value="">Paling Relevan</option>
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru
                                        </option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama
                                        </option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama
                                            (A-Z)</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                            Nama (Z-A)</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                            Harga Terendah</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                            Harga Tertinggi</option>
                                    </select>
                                </div>

                                {{-- Active Filters & Reset --}}
                                <div class="lg:col-span-4 flex items-end">
                                    <div class="w-full space-y-2">
                                        {{-- Active filters display - Always visible --}}
                                        <div class="flex flex-wrap items-center gap-2 min-h-[28px]">
                                            <span class="text-xs text-gray-500 font-medium">Filter aktif:</span>

                                            @if (request('stock') == 'all')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-500/10 text-gray-300 text-xs font-medium rounded-lg border border-gray-500/20">
                                                    Semua Produk
                                                </span>
                                            @elseif(request('stock') || request('sort'))
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-500/10 text-emerald-300 text-xs font-medium rounded-lg border border-emerald-500/20">
                                                    Stok Tersedia
                                                </span>
                                            @endif

                                            @if (request('sort'))
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-cyan-500/10 text-cyan-300 text-xs font-medium rounded-lg border border-cyan-500/20">
                                                    @php
                                                        $sortLabels = [
                                                            'newest' => 'Terbaru',
                                                            'oldest' => 'Terlama',
                                                            'name_asc' => 'A-Z',
                                                            'name_desc' => 'Z-A',
                                                            'price_low' => 'Termurah',
                                                            'price_high' => 'Termahal',
                                                        ];
                                                    @endphp
                                                    {{ $sortLabels[request('sort')] ?? request('sort') }}
                                                </span>
                                            @endif
                                        </div>

                                        {{-- Reset button - Always visible but disabled when no filters --}}
                                        <button onclick="resetFilters()"
                                            {{ request('stock') || request('sort') ? '' : 'disabled' }}
                                            class="w-full px-4 py-3 text-white font-medium rounded-xl transition-all duration-300 border flex items-center justify-center gap-2 
                                            {{ request('stock') || request('sort') ? 'bg-gray-700/50 hover:bg-gray-600/50 border-gray-600/50 cursor-pointer' : 'bg-gray-800/30 border-gray-700/30 opacity-50 cursor-not-allowed' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Reset Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Products Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach ($products as $product)
                        <div
                            class="relative bg-gray-800/40 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/20 border border-gray-700/30 group">

                            <a href="{{ url('/products/' . $product->slug) }}" class="block">

                                {{-- Badges Container --}}
                                <div class="absolute top-3 left-3 right-3 flex items-start justify-between z-10">
                                    {{-- Discount Badge --}}
                                    @php
                                        // Calculate discount percentage if not in database
                                        $discountPercentage = 0;
                                        if (
                                            isset($product->original_price) &&
                                            $product->original_price > $product->price
                                        ) {
                                            $discountPercentage = round(
                                                (($product->original_price - $product->price) /
                                                    $product->original_price) *
                                                    100,
                                            );
                                        } elseif (isset($product->discount_percentage)) {
                                            $discountPercentage = $product->discount_percentage;
                                        }
                                    @endphp

                                    @if ($discountPercentage > 0)
                                        <span
                                            class="bg-red-500 text-white px-2.5 py-1 text-xs font-bold rounded-lg shadow-lg">
                                            -{{ $discountPercentage }}%
                                        </span>
                                    @else
                                        <span></span>
                                    @endif

                                    {{-- Stock Badge --}}
                                    @if ($product->stock > 0)
                                        <span
                                            class="inline-flex items-center px-2 py-1 bg-emerald-500/90 backdrop-blur-sm text-white text-xs font-semibold rounded-lg shadow-lg">
                                            <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
                                            Tersedia
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 bg-gray-600/90 backdrop-blur-sm text-gray-300 text-xs font-semibold rounded-lg shadow-lg">
                                            <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></span>
                                            Habis
                                        </span>
                                    @endif
                                </div>

                                {{-- Wishlist Button (Optional) --}}
                                <button type="button"
                                    onclick="event.preventDefault(); toggleWishlist({{ $product->id }})"
                                    class="absolute top-3 right-3 z-20 p-2 bg-gray-900/70 backdrop-blur-sm rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-gray-900/90 hover:scale-110"
                                    aria-label="Tambah ke wishlist">
                                    <svg class="w-4 h-4 text-gray-300 hover:text-red-400 transition-colors" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>

                                {{-- Image with Loading State --}}
                                <div class="relative overflow-hidden bg-gray-900/20">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/640x480/1f2937/9ca3af?text=No+Image' }}"
                                        alt="{{ $product->name }} - Buku oleh {{ $product->author ?? 'Penulis tidak diketahui' }}"
                                        loading="lazy"
                                        class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500"
                                        onerror="this.onerror=null; this.src='https://placehold.co/640x480/1f2937/9ca3af?text=No+Image';">

                                    {{-- Quick View Overlay --}}
                                    <div
                                        class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span class="text-white text-sm font-semibold flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Detail
                                        </span>
                                    </div>
                                </div>

                                <div class="p-5">
                                    {{-- Title with Fixed Height --}}
                                    <h3
                                        class="text-lg font-bold text-white mb-2 line-clamp-2 group-hover:text-emerald-400 transition-colors duration-300 h-[3.5rem] flex items-start">
                                        {{ $product->name }}
                                    </h3>

                                    {{-- Author --}}
                                    @if ($product->author)
                                        <p class="text-sm text-gray-400 mb-3 truncate flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            {{ $product->author }}
                                        </p>
                                    @endif

                                    {{-- Rating (Keep as is - temporary hardcoded) --}}
                                    <div class="flex items-center text-yellow-400 text-sm mb-3">
                                        <svg class="w-4 h-4 me-1" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.924 7.625Z" />
                                        </svg>
                                        <span class="font-semibold">4.5</span>
                                        <span class="text-gray-400 text-xs ml-1">(120)</span>
                                    </div>

                                    {{-- Price & Stock Info --}}
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <p class="text-emerald-400 font-bold text-xl">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                            {{-- Original Price if discount exists --}}
                                            @if ($discountPercentage > 0 && isset($product->original_price))
                                                <p class="text-xs text-gray-500 line-through">
                                                    Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                                </p>
                                            @endif
                                        </div>

                                        @if ($product->stock > 0)
                                            <p class="text-xs text-gray-400">
                                                <span class="font-semibold text-emerald-400">{{ $product->stock }}</span>
                                                stok
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Low Stock Warning --}}
                                    @if ($product->stock > 0 && $product->stock <= 5)
                                        <div
                                            class="mb-3 px-2 py-1 bg-orange-500/10 border border-orange-500/20 rounded-lg">
                                            <p class="text-xs text-orange-400 font-medium flex items-center">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Stok hampir habis!
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </a>

                            {{-- Add to Cart Button --}}
                            <div class="px-5 pb-5">
                                <button onclick="addToCart({{ $product->id }})"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}
                                    aria-label="{{ $product->stock > 0 ? 'Tambah ' . $product->name . ' ke keranjang' : 'Stok habis' }}"
                                    class="flex items-center justify-center gap-2 w-full bg-emerald-500 text-white text-sm font-semibold py-2.5 px-4 rounded-xl hover:bg-emerald-600 transition-all duration-300 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-emerald-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $product->stock > 0 ? 'Tambah ke Keranjang' : 'Stok Habis' }}
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($products->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-20">
                    <div class="relative mb-8">
                        <div
                            class="w-32 h-32 bg-gray-800/50 rounded-full flex items-center justify-center border-4 border-gray-700/50">
                            <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center border-2 border-red-500/50">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-3xl font-bold text-white mb-3">
                        Tidak Ada Hasil
                    </h3>

                    @if ($query)
                        <p class="text-gray-400 text-center mb-8 max-w-md text-lg">
                            Tidak ditemukan buku dengan kata kunci
                            <span class="text-emerald-400 font-semibold">"{{ $query }}"</span>
                            @if (request('stock') || request('sort'))
                                <span class="block mt-2 text-sm text-gray-500">dengan filter yang dipilih</span>
                            @endif
                        </p>
                    @else
                        <p class="text-gray-400 text-center mb-8 max-w-md text-lg">
                            Silakan masukkan kata kunci pencarian
                        </p>
                    @endif

                    {{-- Tips --}}
                    <div class="bg-gray-800/30 backdrop-blur-sm rounded-2xl p-6 border border-gray-700/30 max-w-md mb-8">
                        <h4 class="text-white font-semibold mb-3 flex items-center text-sm">
                            <svg class="w-5 h-5 text-emerald-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Tips Pencarian
                        </h4>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Coba cari berdasarkan judul buku
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Gunakan nama penulis yang lengkap
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Coba hapus filter yang aktif
                            </li>
                        </ul>
                    </div>

                    <div class="flex gap-3">
                        @if (request('stock') || request('sort'))
                            <button onclick="resetFilters()"
                                class="inline-flex items-center px-6 py-3 bg-gray-700/50 hover:bg-gray-600/50 text-white font-semibold rounded-xl transition-all duration-300 border border-gray-600/50">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Hapus Filter
                            </button>
                        @endif

                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-xl hover:shadow-emerald-500/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
