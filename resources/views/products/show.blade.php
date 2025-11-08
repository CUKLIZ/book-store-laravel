@extends('layouts.app')

@section('title', $product->name . ' - Detail Produk')

@section('content')
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Main Product Section (Compact) --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-8 mb-8">

                {{-- Left: Product Image (2 columns) --}}
                <div class="lg:col-span-2 space-y-3">
                    <div
                        class="relative bg-gray-800/40 backdrop-blur-sm rounded-xl overflow-hidden border border-gray-700/30 group">
                        {{-- Badges --}}
                        <div class="absolute top-3 left-3 z-10 flex flex-col gap-2">
                            @if ($product->stock > 0)
                                <span
                                    class="inline-flex items-center px-2.5 py-1 bg-emerald-500/90 backdrop-blur-sm text-white text-xs font-semibold rounded-lg shadow-lg">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
                                    Tersedia
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-1 bg-gray-600/90 backdrop-blur-sm text-gray-300 text-xs font-semibold rounded-lg shadow-lg">
                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></span>
                                    Stok Habis
                                </span>
                            @endif

                            @if ($product->stock > 0 && $product->stock <= 5)
                                <span
                                    class="inline-flex items-center px-2.5 py-1 bg-orange-500/90 backdrop-blur-sm text-white text-xs font-semibold rounded-lg shadow-lg animate-pulse">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Segera Habis!
                                </span>
                            @endif
                        </div>

                        {{-- Wishlist & Share --}}
                        <div class="absolute top-3 right-3 z-10 flex gap-2">
                            <button type="button" onclick="toggleWishlist({{ $product->id }})"
                                class="p-2 bg-gray-900/70 backdrop-blur-sm rounded-full hover:bg-gray-900/90 transition-all hover:scale-110 group">
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-red-400 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            <button type="button" onclick="ProductDetail.shareProduct()"
                                class="p-2 bg-gray-900/70 backdrop-blur-sm rounded-full hover:bg-gray-900/90 transition-all hover:scale-110">
                                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                            </button>
                        </div>

                        {{-- Image with Zoom --}}
                        <div class="relative overflow-hidden cursor-zoom-in">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/600x800/1f2937/9ca3af?text=No+Image' }}"
                                alt="{{ $product->name }}"
                                class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x800/1f2937/9ca3af?text=No+Image';">
                        </div>
                    </div>

                    {{-- Trust Badges --}}
                    <div class="grid grid-cols-3 gap-2">
                        <div class="bg-gray-800/40 backdrop-blur-sm rounded-lg p-2 border border-gray-700/30 text-center">
                            <svg class="w-5 h-5 text-emerald-400 mx-auto mb-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <p class="text-gray-300 text-xs font-medium">Original</p>
                        </div>
                        <div class="bg-gray-800/40 backdrop-blur-sm rounded-lg p-2 border border-gray-700/30 text-center">
                            <svg class="w-5 h-5 text-emerald-400 mx-auto mb-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                            <p class="text-gray-300 text-xs font-medium">Gratis Ongkir</p>
                        </div>
                        <div class="bg-gray-800/40 backdrop-blur-sm rounded-lg p-2 border border-gray-700/30 text-center">
                            <svg class="w-5 h-5 text-emerald-400 mx-auto mb-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <p class="text-gray-300 text-xs font-medium">Garansi</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Product Info (3 columns) --}}
                <div class="lg:col-span-3 space-y-4">
                    {{-- Category Badge --}}
                    <a href="{{ route('category.show', $product->category->slug) }}"
                        class="inline-flex items-center px-2.5 py-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-medium rounded-lg hover:bg-emerald-500/20 transition-all">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ $product->category->name }}
                    </a>

                    {{-- Product Title --}}
                    <h1 class="text-2xl lg:text-3xl font-bold text-white leading-tight">
                        {{ $product->name }}
                    </h1>

                    {{-- Author --}}
                    @if ($product->author)
                        <div class="flex items-center text-gray-300 text-sm">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Oleh <span
                                    class="font-semibold hover:text-emerald-400 transition-colors cursor-pointer">{{ $product->author }}</span></span>
                        </div>
                    @endif

                    {{-- Rating --}}
                    <div class="flex items-center gap-3 pb-3 border-b border-gray-700/30 text-sm">
                        <div class="flex items-center text-yellow-400">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.924 7.625Z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="text-white font-semibold">4.5</span>
                        <span class="text-gray-400">|</span>
                        <a href="#reviews" class="text-emerald-400 hover:text-emerald-300 transition-colors font-medium">120
                            ulasan</a>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-400">Terjual <span class="text-white font-semibold">500+</span></span>
                    </div>

                    {{-- Price --}}
                    <div
                        class="bg-gradient-to-br from-gray-800/60 to-gray-800/40 backdrop-blur-sm rounded-xl p-4 border border-gray-700/30">
                        <p class="text-gray-400 text-xs font-medium mb-1">Harga</p>
                        <p class="text-emerald-400 font-bold text-3xl mb-2">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <div class="flex items-center gap-2 text-sm">
                            @if ($product->stock > 0)
                                <span class="text-gray-400">Stok:</span>
                                <span class="text-emerald-400 font-bold">{{ $product->stock }} unit</span>
                            @else
                                <span class="text-red-400 font-semibold">Stok habis</span>
                            @endif
                        </div>
                    </div>

                    {{-- Quantity & Actions --}}
                    @if ($product->stock > 0)
                        <div class="space-y-3">
                            {{-- Quantity --}}
                            <div class="flex items-center gap-3">
                                <label class="text-gray-300 font-medium text-sm min-w-[60px]">Jumlah:</label>
                                <div class="flex items-center bg-gray-800/40 rounded-lg border border-gray-700/30">
                                    <button type="button" onclick="ProductDetail.decreaseQuantity()"
                                        class="px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700/50 transition-all rounded-l-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity" value="1" min="1"
                                        max="{{ $product->stock }}"
                                        class="w-16 text-center bg-transparent border-x border-gray-700/30 text-white font-semibold py-2 text-sm focus:outline-none focus:ring-1 focus:ring-emerald-500/50">
                                    <button type="button"
                                        onclick="ProductDetail.increaseQuantity({{ $product->stock }})"
                                        class="px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-700/50 transition-all rounded-r-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="flex gap-2">
                                <button type="button" onclick="ProductDetail.addToCart({{ $product->id }})"
                                    class="flex-1 flex items-center justify-center gap-2 bg-emerald-500 text-white font-semibold py-3 px-4 rounded-lg hover:bg-emerald-600 transition-all text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Keranjang
                                </button>
                            </div>

                            <button type="button"
                                class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white font-bold py-3 px-4 rounded-lg transition-all text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Beli Sekarang
                            </button>
                        </div>
                    @else
                        <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-3">
                            <p class="text-red-400 font-medium flex items-center text-sm">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Maaf, produk ini sedang tidak tersedia
                            </p>
                        </div>
                    @endif

                    {{-- Social Share --}}
                    <div class="pt-3 border-t border-gray-700/30">
                        <p class="text-gray-400 text-xs mb-2">Bagikan:</p>
                        <div class="flex gap-2">
                            <button onclick="ProductDetail.shareToWhatsApp('{{ $product->name }}')"
                                class="p-2 bg-green-600/20 hover:bg-green-600/30 border border-green-600/30 text-green-400 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                            </button>
                            <button onclick="ProductDetail.shareToFacebook()"
                                class="p-2 bg-blue-600/20 hover:bg-blue-600/30 border border-blue-600/30 text-blue-400 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </button>
                            <button onclick="ProductDetail.shareToTwitter('{{ $product->name }}')"
                                class="p-2 bg-sky-600/20 hover:bg-sky-600/30 border border-sky-600/30 text-sky-400 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs Section --}}
            <div class="bg-gray-800/40 backdrop-blur-sm rounded-xl border border-gray-700/30 mb-8 overflow-hidden">
                {{-- Tab Headers --}}
                <div class="flex border-b border-gray-700/30">
                    <button onclick="ProductDetail.switchTab('description')" id="tab-description"
                        class="tab-button flex-1 px-4 py-3 text-white text-sm font-semibold border-b-2 border-emerald-500 bg-gray-700/30 transition-all">
                        Deskripsi
                    </button>
                    <button onclick="ProductDetail.switchTab('specifications')" id="tab-specifications"
                        class="tab-button flex-1 px-4 py-3 text-gray-400 text-sm font-semibold border-b-2 border-transparent hover:text-white hover:bg-gray-700/20 transition-all">
                        Spesifikasi
                    </button>
                    <button onclick="ProductDetail.switchTab('reviews')" id="tab-reviews"
                        class="tab-button flex-1 px-4 py-3 text-gray-400 text-sm font-semibold border-b-2 border-transparent hover:text-white hover:bg-gray-700/20 transition-all">
                        Ulasan (120)
                    </button>
                </div>

                {{-- Tab Contents --}}
                <div class="p-6">
                    {{-- Description --}}
                    <div id="content-description" class="tab-content">
                        @if ($product->description)
                            <div class="text-gray-300 leading-relaxed whitespace-pre-line text-sm">
                                {{ $product->description }}
                            </div>
                        @else
                            <p class="text-gray-400 text-center py-6 text-sm">Belum ada deskripsi.</p>
                        @endif
                    </div>

                    {{-- Specifications --}}
                    <div id="content-specifications" class="tab-content hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="bg-gray-700/20 rounded-lg p-3 border border-gray-700/30">
                                <p class="text-gray-400 text-xs mb-1">Kategori</p>
                                <p class="text-white font-semibold text-sm">{{ $product->category->name }}</p>
                            </div>
                            @if ($product->author)
                                <div class="bg-gray-700/20 rounded-lg p-3 border border-gray-700/30">
                                    <p class="text-gray-400 text-xs mb-1">Penulis/Penerbit</p>
                                    <p class="text-white font-semibold text-sm">{{ $product->author }}</p>
                                </div>
                            @endif
                            <div class="bg-gray-700/20 rounded-lg p-3 border border-gray-700/30">
                                <p class="text-gray-400 text-xs mb-1">Harga</p>
                                <p class="text-emerald-400 font-semibold text-sm">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-gray-700/20 rounded-lg p-3 border border-gray-700/30">
                                <p class="text-gray-400 text-xs mb-1">Stok</p>
                                <p class="text-white font-semibold text-sm">
                                    @if ($product->stock > 0)
                                        <span class="text-emerald-400">{{ $product->stock }} unit</span>
                                    @else
                                        <span class="text-red-400">Habis</span>
                                    @endif
                                </p>
                            </div>
                            <div class="bg-gray-700/20 rounded-lg p-3 border border-gray-700/30">
                                <p class="text-gray-400 text-xs mb-1">SKU</p>
                                <p class="text-white font-semibold text-sm">{{ strtoupper($product->slug) }}</p>
                            </div>
                            <div class="bg-gray-700/20 rounded-lg p-3 border border-gray-700/30">
                                <p class="text-gray-400 text-xs mb-1">Berat</p>
                                <p class="text-white font-semibold text-sm">500 gram</p>
                            </div>
                        </div>
                    </div>

                    {{-- Reviews --}}
                    <div id="content-reviews" class="tab-content hidden">
                        <div class="space-y-4">
                            {{-- Review Summary --}}
                            <div class="bg-gray-700/20 rounded-lg p-4 border border-gray-700/30">
                                <div class="flex items-center justify-between flex-wrap gap-4">
                                    <div class="text-center">
                                        <p class="text-4xl font-bold text-white mb-1">4.5</p>
                                        <div class="flex items-center text-yellow-400 mb-1">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.924 7.625Z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="text-gray-400 text-xs">120 ulasan</p>
                                    </div>
                                    <div class="flex-1 max-w-md space-y-1.5">
                                        @foreach ([5, 4, 3, 2, 1] as $star)
                                            <div class="flex items-center gap-2">
                                                <span class="text-gray-400 text-xs w-6">{{ $star }} ★</span>
                                                <div class="flex-1 bg-gray-700/50 rounded-full h-1.5 overflow-hidden">
                                                    <div class="bg-yellow-400 h-full rounded-full"
                                                        style="width: {{ [85, 10, 3, 1, 1][$star - 1] }}%"></div>
                                                </div>
                                                <span
                                                    class="text-gray-400 text-xs w-10">{{ [85, 10, 3, 1, 1][$star - 1] }}%</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Individual Reviews --}}
                            @for ($i = 0; $i < 3; $i++)
                                <div class="bg-gray-700/20 rounded-lg p-4 border border-gray-700/30">
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                {{ substr(['A', 'B', 'C'][$i], 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-white font-semibold text-sm">
                                                    {{ ['Andi Pratama', 'Budi Santoso', 'Citra Dewi'][$i] }}</p>
                                                <p class="text-gray-400 text-xs">
                                                    {{ ['2 hari lalu', '1 minggu lalu', '2 minggu lalu'][$i] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center text-yellow-400">
                                            @for ($j = 0; $j < 5; $j++)
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.924 7.625Z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-300 leading-relaxed text-sm">
                                        {{ ['Produk bagus, sesuai deskripsi. Pengiriman cepat dan packaging rapi!', 'Kualitas oke, harga terjangkau. Recommended!', 'Produk original dan berkualitas. Pelayanan memuaskan.'][$i] }}
                                    </p>
                                </div>
                            @endfor

                            <button
                                class="w-full py-2.5 bg-gray-700/30 hover:bg-gray-700/50 text-gray-300 hover:text-white font-medium rounded-lg border border-gray-700/30 transition-all text-sm">
                                Lihat Lebih Banyak
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if (isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Produk Terkait
                        </h2>
                        <a href="{{ route('category.show', $product->category->slug) }}"
                            class="text-emerald-400 hover:text-emerald-300 font-medium flex items-center gap-1 transition-colors text-sm">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    {{-- Grid dengan max-width per card --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 md:gap-4">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="max-w-[280px] mx-auto w-full">
                                <x-product-card :product="$relatedProduct" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Sticky Cart Bar (Mobile) --}}
    @if ($product->stock > 0)
        <div id="stickyCartBar"
            class="fixed bottom-0 left-0 right-0 bg-gray-900/95 backdrop-blur-lg border-t border-gray-700/50 px-4 py-2.5 transform translate-y-full transition-transform duration-300 z-40 lg:hidden">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-gray-400 text-xs">Harga</p>
                    <p class="text-emerald-400 font-bold text-base">Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <button onclick="toggleWishlist({{ $product->id }})"
                        class="p-2.5 bg-gray-800 hover:bg-gray-700 rounded-lg transition-all">
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                    <button onclick="ProductDetail.addToCart({{ $product->id }})"
                        class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-5 py-2.5 rounded-lg transition-all flex items-center justify-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Keranjang
                    </button>
                </div>
            </div>
        </div>
    @endif
@endsection
