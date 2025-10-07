{{-- Menampilkan Semua Category --}}
@extends('layouts.app')

@section('title', 'Semua Kategori')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Semua Kategori Produk</h1>
        <p class="text-lg text-gray-400">Telusuri berbagai kategori produk pilihan kami.</p>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500 mx-auto rounded-full mt-4"></div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse ($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}"
                class="block bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-emerald-500/30 transition-all duration-300 hover:-translate-y-2 group border border-gray-700 text-center">
                <div class="mb-4">
                    <img src="https://picsum.photos/100/100?random={{ $category->id }}" alt="{{ $category->name }}"
                        class="w-24 h-24 mx-auto rounded-full object-cover border-2 border-emerald-500 group-hover:border-emerald-400 transition-all duration-300 group-hover:scale-105 transform">
                </div>
                <h3 class="text-lg font-semibold text-white group-hover:text-emerald-400 transition-colors duration-300">
                    {{ $category->name ?? 'Nama Kategori' }}
                </h3>
            </a>
        @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-400 text-xl">Belum ada kategori yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection