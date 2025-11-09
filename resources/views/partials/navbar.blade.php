<nav class="bg-gray-800 border-b border-gray-700 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Left: Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}"
                    class="text-2xl font-bold text-white hover:text-emerald-400 transition-colors duration-200">
                    MyCommerce
                </a>
            </div>

            {{-- Center: Search Bar (Hidden on mobile) --}}
            <div class="hidden md:flex flex-1 max-w-2xl mx-8" x-data="{
                searchQuery: '',
                searchResults: [],
                isSearching: false,
                showResults: false,
                error: null,
                async searchBooks() {
                    if (this.searchQuery.length < 2) {
                        this.searchResults = [];
                        this.showResults = false;
                        this.error = null;
                        return;
                    }
            
                    this.isSearching = true;
                    this.showResults = true;
                    this.error = null;
            
                    try {
                        const response = await fetch(`/api/search?q=${encodeURIComponent(this.searchQuery)}`);
            
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
            
                        const data = await response.json();
            
                        if (data.success) {
                            this.searchResults = data.results || [];
                        } else {
                            this.error = data.message || 'Terjadi kesalahan';
                            this.searchResults = [];
                        }
                    } catch (error) {
                        console.error('Search error:', error);
                        this.error = 'Terjadi kesalahan saat mencari. Silakan coba lagi.';
                        this.searchResults = [];
                    } finally {
                        this.isSearching = false;
                    }
                }
            }" @click.outside="showResults = false">
                <div class="relative w-full">
                    {{-- Search Input --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" x-model="searchQuery" @input.debounce.300ms="searchBooks()"
                            @focus="if(searchQuery.length >= 2) showResults = true"
                            @keydown.enter.prevent="if(searchQuery.length >= 2) window.location.href = `/search?q=${encodeURIComponent(searchQuery)}`"
                            placeholder="Cari judul buku atau penulis..."
                            class="w-full pl-10 pr-12 py-2.5 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">

                        {{-- Loading Spinner --}}
                        <div x-show="isSearching" x-cloak class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="animate-spin h-5 w-5 text-emerald-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>

                        {{-- Clear Button --}}
                        <button x-show="searchQuery.length > 0 && !isSearching" x-cloak
                            @click="searchQuery = ''; searchResults = []; showResults = false; error = null"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Search Results Dropdown --}}
                    <div x-show="showResults && searchQuery.length >= 2" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute z-50 w-full mt-2 bg-gray-800 rounded-lg shadow-xl border border-gray-700 max-h-96 overflow-y-auto"
                        style="scrollbar-width: thin; scrollbar-color: #10b981 #374151;">

                        {{-- Error Message --}}
                        <div x-show="error" x-cloak
                            class="px-4 py-6 text-center border-b border-gray-700 bg-red-900/20">
                            <svg class="w-10 h-10 mx-auto text-red-500 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-400 text-sm font-medium" x-text="error"></p>
                        </div>

                        {{-- Results List --}}
                        <div x-show="searchResults.length > 0 && !error" x-cloak class="py-2">
                            <template x-for="book in searchResults" :key="book.id">
                                <a :href="`/products/${book.slug}`" @click="showResults = false"
                                    class="flex items-center px-4 py-3 hover:bg-gray-700 transition-colors duration-150 group">
                                    {{-- Book Image --}}
                                    <img :src="book.image" :alt="book.name"
                                        onerror="this.src='{{ asset('images/default-book.png') }}'"
                                        class="w-12 h-16 object-cover rounded shadow-sm group-hover:shadow-md transition-shadow">

                                    {{-- Book Info --}}
                                    <div class="ml-3 flex-1 min-w-0">
                                        <p class="text-sm font-medium text-white truncate group-hover:text-emerald-400 transition-colors"
                                            x-text="book.name"></p>
                                        <p class="text-xs text-gray-400 truncate" x-text="book.author"></p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p class="text-sm font-semibold text-emerald-500"
                                                x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(book.price)"></p>
                                            <span class="text-xs text-gray-500" x-text="'Stok: ' + book.stock"></span>
                                        </div>
                                    </div>

                                    {{-- Arrow Icon --}}
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-emerald-400 transition-colors flex-shrink-0 ml-2"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </template>

                            {{-- View All Results --}}
                            <div class="border-t border-gray-700 mt-2">
                                <a :href="`/search?q=${encodeURIComponent(searchQuery)}`"
                                    class="flex items-center justify-center px-4 py-3 text-sm font-medium text-emerald-400 hover:bg-gray-700 transition-colors">
                                    Lihat semua hasil untuk "<span class="font-semibold" x-text="searchQuery"></span>"
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        {{-- No Results --}}
                        <div x-show="searchResults.length === 0 && !isSearching && !error" x-cloak
                            class="px-4 py-8 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-600 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-gray-400 text-sm">Tidak ada hasil untuk "<span x-text="searchQuery"
                                    class="font-medium text-white"></span>"</p>
                            <p class="text-gray-500 text-xs mt-1">Coba kata kunci lain atau periksa ejaan</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Navigation Links & Icons --}}
            <div class="flex items-center space-x-4">

                {{-- Navigation Links --}}
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('home') }}#category-id"
                        class="text-gray-300 hover:text-white transition-colors duration-150 font-medium text-[15px] p-2 rounded-lg hover:bg-gray-700">
                        Category
                    </a>
                    <a href="{{ route('home') }}#products-section"
                        class="text-gray-300 hover:text-white transition-colors duration-150 font-medium text-[15px] p-2 rounded-lg hover:bg-gray-700">
                        Books
                    </a>
                </div>

                {{-- Cart Icon (NEW!) --}}
                @auth
                    <a href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-300 hover:text-white hover:bg-gray-700 rounded-lg transition-all duration-200 group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>

                        {{-- Cart Badge Counter --}}
                        <span id="cartCount"
                            class="absolute -top-1 -right-1 bg-emerald-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-gray-800 group-hover:scale-110 transition-transform duration-200">
                            {{ auth()->user()->carts()->sum('quantity') ?? 0 }}
                        </span>
                    </a>
                @else
                    {{-- Cart untuk guest (redirect ke login) --}}
                    <button onclick="ProductDetail.showLoginModal()"
                        class="relative p-2 text-gray-300 hover:text-white hover:bg-gray-700 rounded-lg transition-all duration-200 group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 bg-gray-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-gray-800">
                            0
                        </span>
                    </button>
                @endauth

                {{-- Profile/Auth Section --}}
                <div class="flex items-center">
                    @auth
                        {{-- Profile Dropdown --}}
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = !open"
                                class="flex items-center space-x-2.5 focus:outline-none group pr-0 pl-3 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                                <div class="relative">
                                    <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-600 group-hover:border-emerald-500 transition-all duration-200"
                                        src="{{ Auth::user()->profile_photo_url ?? 'https://i.pravatar.cc/150?u=' . Auth::user()->email }}"
                                        alt="{{ Auth::user()->name }}">
                                    <span
                                        class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 border-2 border-gray-800"></span>
                                </div>
                                <span
                                    class="text-white text-sm font-medium hidden lg:block group-hover:text-emerald-400 transition-colors duration-200">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg class="h-4 w-4 text-gray-400 transition-transform duration-200 hidden lg:block"
                                    :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 top-full mt-2 w-56 bg-gray-900 rounded-lg shadow-xl overflow-hidden z-50 border border-gray-700">

                                <div class="px-4 py-3 bg-gray-800 border-b border-gray-700">
                                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                                </div>

                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-200 hover:bg-gray-800 hover:text-white transition duration-150">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil
                                    </a>

                                    {{-- Cart Link (mobile visible in dropdown) --}}
                                    <a href="{{ route('cart.index') }}"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-200 hover:bg-gray-800 hover:text-white transition duration-150 md:hidden">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Keranjang
                                        <span
                                            class="ml-auto bg-emerald-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                            {{ auth()->user()->carts()->sum('quantity') ?? 0 }}
                                        </span>
                                    </a>
                                </div>

                                <div class="border-t border-gray-700">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full px-4 py-2.5 text-sm text-red-400 hover:bg-gray-800 hover:text-red-300 transition duration-150">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}"
                                class="text-gray-300 hover:text-white font-medium transition-colors duration-150 px-3 py-2 text-[15px]">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-5 py-2 bg-emerald-500 text-white font-medium rounded-lg hover:bg-emerald-600 transition-all duration-300 shadow-lg hover:shadow-emerald-500/50 text-[15px]">
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <button type="button" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</nav>