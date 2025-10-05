@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')

    {{-- Carousel --}}
    <x-carousel />

    {{-- Category --}}
    <section id="category-id" class="py-12">
        <x-category :categories="$categories" />
    </section>

    {{-- Product --}}
    <div id="products-section">
        @include('components.product', ['products' => $products])
    </div>

    {{-- Spinner Loading (Tailwind) --}}
    <div id="loading-spinner" class="hidden fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm z-50">
        <div class="w-12 h-12 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
    </div>


@endsection
