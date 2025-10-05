{{-- Component Category --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Telusuri Kategori Pilihan</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500 mx-auto rounded-full"></div>
    </div>
    <div class="flex overflow-x-auto space-x-6 pb-4 scroll-smooth hide-scrollbar">
        @foreach ($categories as $category)
            <div
                class="flex-shrink-0 w-40 sm:w-48 bg-gray-800 p-4 rounded-xl shadow-lg hover:shadow-emerald-500/30 transition-all duration-300 hover:-translate-y-2 group border border-gray-700">
                <div class="relative mb-3">
                    <img src="https://picsum.photos/100/100?random={{ $category->id }}" alt="{{ $category->name }}"
                        class="w-24 h-24 mx-auto rounded-full object-cover border-2 border-emerald-500 group-hover:border-emerald-400 transition-all duration-300 group-hover:scale-105 transform">
                </div>
                <a href="#"
                    class="block text-center text-base font-semibold text-white group-hover:text-emerald-400 transition-colors duration-300">
                    {{ $category->slug ?? 'Nama Kategori' }}
                </a>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-6">
        <a href="#"
            class="inline-flex items-center gap-2 bg-emerald-600 text-white py-2 px-6 rounded-full hover:bg-emerald-700 hover:shadow-lg transition-all duration-300">
            Lihat Semua Kategori
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>
</section>