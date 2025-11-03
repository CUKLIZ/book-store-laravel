@props(['product'])

@php
    // Calculate discount percentage
    $discountPercentage = 0;
    if (isset($product->original_price) && $product->original_price > $product->price) {
        $discountPercentage = round((($product->original_price - $product->price) / $product->original_price) * 100);
    } elseif (isset($product->discount_percentage)) {
        $discountPercentage = $product->discount_percentage;
    }
@endphp

<div
    class="relative bg-gray-800/40 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/20 border border-gray-700/30 group">

    <a href="{{ url('/products/' . $product->slug) }}" class="block">

        {{-- Badges Container --}}
        <div class="absolute top-3 left-3 right-3 flex items-start justify-between z-10">
            {{-- Discount Badge --}}
            @if ($discountPercentage > 0)
                <span class="bg-red-500 text-white px-2.5 py-1 text-xs font-bold rounded-lg shadow-lg">
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

        {{-- Wishlist Button --}}
        <button type="button" onclick="event.preventDefault(); toggleWishlist({{ $product->id }})"
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
                    <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ $product->author }}
                </p>
            @endif

            {{-- Rating --}}
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
                <div class="mb-3 px-2 py-1 bg-orange-500/10 border border-orange-500/20 rounded-lg">
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
        <button onclick="addToCart({{ $product->id }})" {{ $product->stock <= 0 ? 'disabled' : '' }}
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