<div id="loginModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-gray-800 rounded-xl p-6 max-w-md w-full border border-gray-700/50 shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="loginModalContent">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Login Diperlukan</h3>
            <p class="text-gray-400 text-sm">Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="ProductDetail.closeLoginModal()" class="flex-1 px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg transition-all">
                Batal
            </button>
            <a href="{{ route('login') }}" class="flex-1 px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-lg transition-all text-center">
                Login
            </a>
        </div>
    </div>
</div>