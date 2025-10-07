<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Telusuri Kategori Pilihan</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500 mx-auto rounded-full"></div>
    </div>

    <div id="category-scroll-container" class="relative group">
        <div id="category-list" class="flex overflow-x-auto space-x-6 pb-4 scroll-smooth hide-scrollbar">
            @foreach ($categories as $category)
                <div
                    class="flex-shrink-0 w-40 sm:w-48 bg-gray-800 p-4 rounded-xl shadow-lg hover:shadow-emerald-500/30 transition-all duration-300 hover:-translate-y-2 group border border-gray-700">
                    <div class="relative mb-3">
                        <img src="https://picsum.photos/100/100?random={{ $category->id }}" alt="{{ $category->name }}"
                            class="w-24 h-24 mx-auto rounded-full object-cover border-2 border-emerald-500 group-hover:border-emerald-400 transition-all duration-300 group-hover:scale-105 transform">
                    </div>
                    <a href="{{ route('category.show', $category->slug) }}"
                        class="block text-center text-base font-semibold text-white group-hover:text-emerald-400 transition-colors duration-300">
                        {{ $category->name ?? 'Nama Kategori' }}
                    </a>
                </div>
            @endforeach
        </div>

        <button id="prevButton"
            class="absolute left-0 top-1/2 -translate-y-1/2 transform bg-gray-900 bg-opacity-70 p-2 rounded-full text-white shadow-xl cursor-pointer z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ml-2 disabled:opacity-0 disabled:cursor-default hover:bg-emerald-600/90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button id="nextButton"
            class="absolute right-0 top-1/2 -translate-y-1/2 transform bg-gray-900 bg-opacity-70 p-2 rounded-full text-white shadow-xl cursor-pointer z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 mr-2 disabled:opacity-0 disabled:cursor-default hover:bg-emerald-600/90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <div class="text-center mt-6">
        <a href="{{ route('categories.showAll') }}"
            class="inline-flex items-center gap-2 bg-emerald-600 text-white py-2 px-6 rounded-full hover:bg-emerald-700 hover:shadow-lg transition-all duration-300">
            Lihat Semua Kategori
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>
</section>

<script>
    function initializeCategoryScroll() {
        const scrollContainer = document.getElementById('category-list');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        if (!scrollContainer || !prevButton || !nextButton) {
            console.warn("Category scroll elements not found. Skipping initialization.");
            return;
        }

        const scrollAmount = 300;

        function updateButtonStates() {
            prevButton.disabled = scrollContainer.scrollLeft <= 0;

            nextButton.disabled = Math.ceil(scrollContainer.scrollLeft + scrollContainer.clientWidth) >= scrollContainer
                .scrollWidth;
        }

        // Ke Kiri
        prevButton.onclick = () => {
            scrollContainer.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
            setTimeout(updateButtonStates, 400);
        };

        nextButton.onclick = () => {
            scrollContainer.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
            setTimeout(updateButtonStates, 400);
        };

        updateButtonStates();
        scrollContainer.addEventListener('scroll', updateButtonStates);
        window.addEventListener('resize', updateButtonStates);
    }
    document.addEventListener('DOMContentLoaded', initializeCategoryScroll);
</script>
