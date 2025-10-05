{{-- Component Carousel --}}
<section class="mb-12 relative">
    <div id="default-carousel" class="relative w-full overflow-hidden rounded-lg shadow-2xl" data-carousel="slide"
        data-carousel-interval="5000">
        {{-- Carousel wrapper --}}
        <div class="relative h-72 sm:h-80 md:h-96 lg:h-[500px] overflow-hidden">
            {{-- Item 1 --}}
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://picsum.photos/1920/800?random=1"
                    class="absolute block w-full h-full object-cover top-0 left-0 scale-110 animate-ken-burns"
                    alt="Banner 1">
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-start p-8 md:p-16">
                    <div class="max-w-2xl animate-slide-in-left">
                        <span
                            class="inline-block bg-emerald-500/20 backdrop-blur-sm text-emerald-300 px-4 py-1 rounded-full text-sm font-semibold mb-4 border border-emerald-500/30">🔥
                            Trending</span>
                        <h1
                            class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4 drop-shadow-2xl">
                            Temukan Produk <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Terbaikmu</span>
                            di Sini!
                        </h1>
                        <p class="text-lg sm:text-xl text-gray-200 mb-6 hidden md:block drop-shadow-lg">Pilihan
                            terlengkap dengan harga bersaing, siap memenuhi kebutuhanmu.</p>
                        <a href="#products-section"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-emerald-500/50 hover:scale-105 transition-all duration-300 group">
                            Lihat Produk
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://picsum.photos/1920/800?random=2"
                    class="absolute block w-full h-full object-cover top-0 left-0 scale-110 animate-ken-burns"
                    alt="Banner 2">
                <div class="absolute inset-0 bg-gradient-to-l from-black/80 via-black/60 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-end p-8 md:p-16">
                    <div class="max-w-2xl text-right animate-slide-in-right">
                        <span
                            class="inline-block bg-indigo-500/20 backdrop-blur-sm text-indigo-300 px-4 py-1 rounded-full text-sm font-semibold mb-4 border border-indigo-500/30">⚡
                            Special Offer</span>
                        <h1
                            class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4 drop-shadow-2xl">
                            Diskon <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Spesial</span>
                            Minggu Ini!
                        </h1>
                        <p class="text-lg sm:text-xl text-gray-200 mb-6 hidden md:block drop-shadow-lg">Jangan lewatkan
                            penawaran terbatas untuk produk pilihan favoritmu.</p>
                        <a href="#products-section"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-indigo-500/50 hover:scale-105 transition-all duration-300 group">
                            Belanja Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Item 3 --}}
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://picsum.photos/1920/800?random=3"
                    class="absolute block w-full h-full object-cover top-0 left-0 scale-110 animate-ken-burns"
                    alt="Banner 3">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-center p-8 md:p-16">
                    <div class="max-w-2xl text-center animate-fade-in-up">
                        <span
                            class="inline-block bg-purple-500/20 backdrop-blur-sm text-purple-300 px-4 py-1 rounded-full text-sm font-semibold mb-4 border border-purple-500/30">🎁
                            Free Shipping</span>
                        <h1
                            class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4 drop-shadow-2xl">
                            Gratis <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Ongkir</span>
                            untuk Setiap Pembelian
                        </h1>
                        <p class="text-lg sm:text-xl text-gray-200 mb-6 hidden md:block drop-shadow-lg">Nikmati
                            kemudahan berbelanja tanpa biaya pengiriman tambahan.</p>
                        <a href="#products-section"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-purple-500/50 hover:scale-105 transition-all duration-300 group">
                            Klaim Promo
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slider indicators dengan efek modern --}}
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button"
                class="w-12 h-1.5 rounded-full bg-white/30 hover:bg-white transition-all duration-300 backdrop-blur-sm"
                aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button"
                class="w-12 h-1.5 rounded-full bg-white/30 hover:bg-white transition-all duration-300 backdrop-blur-sm"
                aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button"
                class="w-12 h-1.5 rounded-full bg-white/30 hover:bg-white transition-all duration-300 backdrop-blur-sm"
                aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>

        {{-- Slider controls dengan efek glassmorphism --}}
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/10 backdrop-blur-md border border-white/20 group-hover:bg-white/20 group-hover:scale-110 transition-all duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/10 backdrop-blur-md border border-white/20 group-hover:bg-white/20 group-hover:scale-110 transition-all duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</section>
