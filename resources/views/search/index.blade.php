@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search Header --}}
            <div class="mb-8 animate-fade-in-up">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">
                            Hasil Pencarian
                        </h1>
                        @if ($query)
                            <p class="text-gray-400 text-lg">
                                Menampilkan hasil untuk:
                                <span class="text-emerald-400 font-semibold">"{{ $query }}"</span>
                            </p>
                            <p class="text-gray-500 text-sm mt-1">
                                {{ $total }} buku ditemukan
                            </p>
                        @endif
                    </div>

                    {{-- Back Button --}}
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-300 border border-gray-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>

                {{-- Divider --}}
                <div class="mt-6 h-px bg-gradient-to-r from-transparent via-gray-700 to-transparent"></div>
            </div>

            @if ($products->count() > 0)
                {{-- Products Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 animate-fade-in-up">
                    @foreach ($products as $product)
                        <div class="group">
                            <a href="{{ url('/search?q=' . urlencode($query)) }}">
                                class="block bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl hover:shadow-emerald-500/20 transition-all duration-300 transform hover:-translate-y-2 border border-gray-700 hover:border-emerald-500/50">

                                {{-- Book Cover --}}
                                <div class="relative aspect-[3/4] overflow-hidden bg-gray-700">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif

                                    {{-- Overlay on hover --}}
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>

                                {{-- Book Info --}}
                                <div class="p-4">
                                    {{-- Title --}}
                                    <h3
                                        class="font-semibold text-white text-sm mb-1 line-clamp-2 group-hover:text-emerald-400 transition-colors">
                                        {{ $product->name }}
                                    </h3>

                                    {{-- Author --}}
                                    <p class="text-xs text-gray-400 mb-2 line-clamp-1">
                                        {{ $product->author }}
                                    </p>

                                    {{-- Category Badge --}}
                                    @if ($product->category)
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-medium bg-gray-700 text-gray-300 rounded mb-2">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif

                                    {{-- Price --}}
                                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-700">
                                        <span class="text-emerald-400 font-bold text-lg">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>

                                        {{-- Stock Badge --}}
                                        @if ($product->stock > 0)
                                            <span class="text-xs text-green-400 font-medium">
                                                Stok: {{ $product->stock }}
                                            </span>
                                        @else
                                            <span class="text-xs text-red-400 font-medium">
                                                Habis
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-20 animate-fade-in-up">
                    <div class="w-32 h-32 mb-6 relative">
                        <svg class="w-full h-full text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-400 mb-2">
                        Tidak Ada Hasil
                    </h3>

                    @if ($query)
                        <p class="text-gray-500 text-center mb-6 max-w-md">
                            Maaf, kami tidak menemukan buku dengan kata kunci <span
                                class="text-emerald-400 font-semibold">"{{ $query }}"</span>
                        </p>
                    @else
                        <p class="text-gray-500 text-center mb-6 max-w-md">
                            Silakan masukkan kata kunci pencarian di atas
                        </p>
                    @endif

                    <div class="space-y-3 text-sm text-gray-500">
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Coba cari berdasarkan judul atau nama penulis
                        </p>
                    </div>

                    <a href="{{ route('home') }}"
                        class="mt-8 inline-flex items-center px-6 py-3 bg-emerald-500 text-white font-medium rounded-lg hover:bg-emerald-600 transition-all duration-300 shadow-lg hover:shadow-emerald-500/50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            @endif

        </div>
    </div>
    @endsection0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
    clip-rule="evenodd"/>
    </svg>
    Coba gunakan kata kunci yang lebih umum
    </p>
    <p class="flex items-center">
        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
        </svg>
        Periksa ejaan kata kunci
    </p>
    <p class="flex items-center">
        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1
