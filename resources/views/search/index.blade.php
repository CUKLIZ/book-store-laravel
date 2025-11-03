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
                        <x-product-card :product="$product" />
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
