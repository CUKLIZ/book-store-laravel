@extends('layouts.app')

@section('title', 'Genre - ' . $category->name)

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Genre di {{ $category->name }}</h1>
        <p class="text-lg text-gray-400">Pilih genre untuk melihat produk.</p>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500 mx-auto rounded-full mt-4"></div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @foreach ($genres as $genre)
            <a href="{{ route('genre.products', [$category->slug, $genre->slug]) }}"
                class="block bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-emerald-500/30 transition-all duration-300 hover:-translate-y-2 border border-gray-700 text-center">
                <h3 class="text-lg font-semibold text-white group-hover:text-emerald-400 transition-colors duration-300">
                    {{ $genre->name }}
                </h3>
            </a>
        @endforeach
    </div>
</section>
@endsection
