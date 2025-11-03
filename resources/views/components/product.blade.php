{{-- resources/views/components/product.blade.php --}}
<section id="products-section" data-base-url="{{ url()->current() }}"
    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-800 rounded-2xl shadow-2xl mb-12 relative">

    {{-- Loading Spinner --}}
    <div id="loading-spinner"
        class="hidden absolute inset-0 bg-gray-900/80 backdrop-blur-sm rounded-2xl z-50 flex items-center justify-center">
        <div class="flex flex-col items-center gap-4">
            <div class="relative">
                <div class="w-16 h-16 border-4 border-emerald-500/30 border-t-emerald-500 rounded-full animate-spin">
                </div>
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-10 h-10 border-4 border-cyan-500/30 border-t-cyan-500 rounded-full animate-spin animation-delay-150">
                </div>
            </div>
            <p class="text-white font-semibold text-lg">Loading...</p>
        </div>
    </div>

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Books</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-emerald-500 to-cyan-500 mx-auto rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
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

        // Ambil URL dasar (tanpa query string) dari data attribute
        const baseUrl = container.dataset.baseUrl || '/';

        container.addEventListener('click', (e) => {
            const target = e.target.closest('a');

            if (target && target.href && target.closest('nav[aria-label="Pagination Navigation"]')) {
                e.preventDefault();
                const url = target.href;

                // Dapatkan nomor halaman dari URL yang diklik
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
                            // Cek apakah konten yang dikembalikan mengandung produk.
                            // Jika tidak ada produk, Laravel akan mengembalikan HTML dengan grid kosong.
                            if (html.includes(
                                    'grid-cols-4 gap-8'
                                    )) { // Cek keberadaan div grid produk
                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = html;
                                const productGrid = tempDiv.querySelector(
                                    '.grid-cols-4.gap-8');

                                // Jika grid ditemukan, dan tidak ada item produk di dalamnya
                                if (productGrid && productGrid.children.length === 0) {
                                    // --- PENANGANAN HALAMAN KOSONG (PAGE KELEBIHAN) ---
                                    showWarningMessage(pageNumber);
                                    window.history.pushState({}, '',
                                        url); // Tetap update URL
                                    return; // Hentikan proses update konten
                                }
                            }

                            // Jika konten valid, update seperti biasa
                            container.innerHTML = html;

                            // update URL
                            window.history.pushState({}, '', url);

                            // Scroll halus ke atas section
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

        // Fungsi untuk menampilkan pesan peringatan
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

            // Ganti seluruh konten <section> dengan pesan peringatan
            container.innerHTML = warningHTML;

            container.classList.remove('fade-out');
            container.classList.add('fade-in');
            setTimeout(() => container.classList.remove('fade-in'), 400);

            // Scroll halus ke atas section
            window.scrollTo({
                top: container.offsetTop - 50,
                behavior: 'smooth'
            });
        }
    });
</script>
