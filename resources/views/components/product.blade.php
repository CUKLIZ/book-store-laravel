{{-- resources/views/components/product.blade.php --}}
<section id="products-section"
    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-800 rounded-2xl shadow-2xl mb-12 relative">
    
    {{-- Loading Spinner --}}
    <div id="loading-spinner" class="hidden absolute inset-0 bg-gray-900/80 backdrop-blur-sm rounded-2xl z-50 flex items-center justify-center">
        <div class="flex flex-col items-center gap-4">
            <div class="relative">
                <div class="w-16 h-16 border-4 border-emerald-500/30 border-t-emerald-500 rounded-full animate-spin"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-10 h-10 border-4 border-cyan-500/30 border-t-cyan-500 rounded-full animate-spin animation-delay-150"></div>
            </div>
            <p class="text-white font-semibold text-lg">Loading...</p>
        </div>
    </div>

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Produk Unggulan</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500 mx-auto rounded-full"></div>
    </div>
    
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
</section>



<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('#products-section');
    const spinner = document.getElementById('loading-spinner');

    container.addEventListener('click', (e) => {
        const target = e.target.closest('a');

        if (target && target.href && target.closest('nav[aria-label="Pagination Navigation"]')) {
            e.preventDefault();
            const url = target.href;

            container.classList.add('fade-out');
            spinner.classList.remove('hidden');

            setTimeout(() => {
                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    container.innerHTML = html;

                    // update URL
                    window.history.pushState({}, '', url);

                    // Scroll halus ke atas section
                    window.scrollTo({ top: container.offsetTop - 50, behavior: 'smooth' });

                    container.classList.remove('fade-out');
                    container.classList.add('fade-in');
                    setTimeout(() => container.classList.remove('fade-in'), 400);
                })
                .catch(err => console.error(err))
                .finally(() => {
                    spinner.classList.add('hidden');
                });
            }, 250);
        }
    });
});
</script>