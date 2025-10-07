{{-- resources/views/categories/show.blade.php --}}
@extends('layouts.app')

@section('title', $category->name . ' Products')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="text-center mb-10">
                <h1 class="text-5xl font-extrabold text-white mb-3">
                    Produk Kategori: <span class="text-emerald-400">{{ $category->name }}</span>
                </h1>
                {{-- <p class="text-lg text-gray-400">Menampilkan semua item dalam kategori **{{ $category->slug }}**.</p> --}}
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500 mx-auto rounded-full mt-4"></div>
            </div>

            <section id="products-section" data-base-url="{{ url()->current() }}"
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-800 rounded-2xl shadow-2xl mb-12 relative">

                {{-- Loading Spinner --}}
                <div id="loading-spinner"
                    class="hidden absolute inset-0 bg-gray-900/80 backdrop-blur-sm rounded-2xl z-50 flex items-center justify-center">
                    <div class="flex flex-col items-center gap-4">
                        <div class="relative">
                            <div
                                class="w-16 h-16 border-4 border-emerald-500/30 border-t-emerald-500 rounded-full animate-spin">
                            </div>
                            <div
                                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-10 h-10 border-4 border-cyan-500/30 border-t-cyan-500 rounded-full animate-spin animation-delay-150">
                            </div>
                        </div>
                        <p class="text-white font-semibold text-lg">Loading...</p>
                    </div>
                </div>

                @if ($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach ($products as $product)
                            <div
                                class="relative bg-gray-700 rounded-xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/30 group">
                                {{-- Badge Diskon --}}
                                @if (isset($product->discount_percentage) && $product->discount_percentage > 0)
                                    <span
                                        class="absolute top-2 left-2 bg-red-600 text-white px-3 py-1 text-sm font-bold rounded-lg z-10 shadow-lg">
                                        {{ $product->discount_percentage }}% OFF
                                    </span>
                                @endif
                                <div class="relative overflow-hidden">
                                    <img src="{{ $product->image ?? 'https://via.placeholder.com/640x480?text=No+Image' }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-semibold text-white mb-2 truncate group-hover:text-emerald-400 transition-colors duration-300">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="flex items-center text-yellow-400 text-sm mb-2">
                                        <svg class="w-4 h-4 me-1" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.924 7.625Z" />
                                        </svg>
                                        <span class="font-semibold">4.5</span>
                                        <span class="text-gray-400 text-xs ml-1">(120 Reviews)</span>
                                    </div>
                                    <p class="text-emerald-400 font-bold text-2xl mb-4 drop-shadow-lg">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <a href="#"
                                        class="flex items-center justify-center gap-2 w-full bg-emerald-500 text-white text-center py-2 px-4 rounded-lg hover:bg-emerald-600 transition-all duration-300 hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Tambah ke Keranjang
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-400 text-xl">
                            Tidak ada produk yang tersedia untuk kategori **{{ $category->name }}** saat ini.
                        </p>
                    </div>
                @endif
            </section>
        </div>
    </div>

    <script>
        // Skrip AJAX untuk paginasi (diambil dari product.blade.php)
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('#products-section');
            const spinner = document.getElementById('loading-spinner');

            const baseUrl = container.dataset.baseUrl || '/';

            container.addEventListener('click', (e) => {
                const target = e.target.closest('a');

                if (target && target.href && target.closest('nav[aria-label="Pagination Navigation"]')) {
                    e.preventDefault();
                    const url = target.href;

                    const pageNumber = new URL(url).searchParams.get('page');

                    container.classList.add('fade-out');
                    spinner.classList.remove('hidden');

                    setTimeout(() => {
                        fetch(url, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(res => res.text())
                            .then(html => {
                                if (html.includes('grid-cols-4 gap-8')) {
                                    const tempDiv = document.createElement('div');
                                    tempDiv.innerHTML = html;
                                    const productGrid = tempDiv.querySelector(
                                        '.grid-cols-4.gap-8');

                                    if (productGrid && productGrid.children.length === 0) {
                                        showWarningMessage(pageNumber);
                                        window.history.pushState({}, '', url);
                                        return;
                                    }
                                }

                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = html;

                                // Ambil hanya konten di dalam <section> yang baru
                                const newContent = tempDiv.querySelector('#products-section')
                                    .innerHTML;
                                container.innerHTML = newContent;

                                window.history.pushState({}, '', url);

                                window.scrollTo({
                                    top: container.offsetTop - 50,
                                    behavior: 'smooth'
                                });

                                container.classList.remove('fade-out');
                                container.classList.add('fade-in');
                                setTimeout(() => container.classList.remove('fade-in'), 400);
                            })
                            .catch(err => {
                                console.error('Fetch error:', err);
                                alert('Terjadi kesalahan saat memuat halaman produk.');
                            })
                            .finally(() => {
                                spinner.classList.add('hidden');
                            });
                    }, 250);
                }
            });

            function showWarningMessage(page) {
                const warningHTML = `
            <div class="text-center py-16 px-6 bg-red-900/50 rounded-xl">
                <p class="text-4xl mb-4" role="img" aria-label="alert">⚠️</p>
                <h3 class="text-2xl font-bold text-white mb-2">Halaman Produk ${page} Tidak Ditemukan!</h3>
                <p class="text-gray-300 mb-6">Sepertinya halaman yang Anda cari tidak tersedia. Anda bisa kembali ke halaman awal.</p>
                <a href="${baseUrl}"
                    class="inline-flex items-center bg-cyan-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-cyan-600 transition-colors shadow-lg">
                    Kembali ke Halaman Pertama
                </a>
            </div>
        `;

                container.innerHTML = warningHTML;

                container.classList.remove('fade-out');
                container.classList.add('fade-in');
                setTimeout(() => container.classList.remove('fade-in'), 400);

                window.scrollTo({
                    top: container.offsetTop - 50,
                    behavior: 'smooth'
                });
            }
        });
    </script>

@endsection
