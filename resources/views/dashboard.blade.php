{{-- <x-app-layout> --}}
    {{-- <x-slot name="header"> --}}
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> --}}
            {{-- {{ __('Dashboard') }} --}}
        {{-- </h2> --}}
    {{-- </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
{{-- </x-app-layout> --}}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-carousel />

    <section id="category-id" class="py-12">
        <x-category :categories="$categories" />
    </section>

    <div id="products-section">
        @include('components.product', ['products' => $products])
    </div>
@endsection