<nav class="bg-gray-800 border-b border-gray-700 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Left: Logo Only --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}"
                    class="text-2xl font-bold text-white hover:text-emerald-400 transition-colors duration-200">
                    MyCommerce
                </a>
            </div>

            {{-- Right: Navigation Links & Profile (Menggunakan Flexbox untuk Penataan) --}}
            <div class="flex items-center space-x-6">

                {{-- Navigation Links --}}
                <div class="hidden md:flex items-center space-x-4">
                    {{-- Jarak antar tautan dibuat lebih rapat (space-x-4) --}}
                    <a href="{{ route('home') }}#category-id"
                        class="text-gray-300 hover:text-white transition-colors duration-150 font-medium text-[15px] p-2 rounded-lg hover:bg-gray-700">
                        Category
                    </a>
                    <a href="{{ route('home') }}#products-section"
                        class="text-gray-300 hover:text-white transition-colors duration-150 font-medium text-[15px] p-2 rounded-lg hover:bg-gray-700">
                        Books
                    </a>
                </div>

                {{-- Right Corner: Profile/Auth --}}
                {{-- Tidak ada padding tambahan di sini, biarkan padding dari mx-auto yang bekerja --}}
                <div class="flex items-center">
                    @auth
                        {{-- Profile Dropdown --}}
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">

                            {{-- Trigger Button --}}
                            <button @click="open = !open"
                                class="flex items-center space-x-2.5 focus:outline-none group pr-0 pl-3 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-200">

                                {{-- Profile Image --}}
                                <div class="relative">
                                    <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-600 group-hover:border-emerald-500 transition-all duration-200"
                                        src="{{ Auth::user()->profile_photo_url ?? 'https://i.pravatar.cc/150?u=' . Auth::user()->email }}"
                                        alt="{{ Auth::user()->name }}">

                                    {{-- Active Indicator --}}
                                    <span
                                        class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 border-2 border-gray-800"></span>
                                </div>

                                {{-- User Name (Desktop) --}}
                                <span
                                    class="text-white text-sm font-medium hidden lg:block group-hover:text-emerald-400 transition-colors duration-200">
                                    {{ Auth::user()->name }}
                                </span>

                                {{-- Chevron Icon --}}
                                <svg class="h-4 w-4 text-gray-400 transition-transform duration-200 hidden lg:block"
                                    :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            {{-- Dropdown Menu --}}
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 top-full mt-2 w-56 bg-gray-900 rounded-lg shadow-xl overflow-hidden z-50 border border-gray-700"
                                style="display: none;">

                                {{-- ... (Konten dropdown lainnya sama) ... --}}

                                <div class="px-4 py-3 bg-gray-800 border-b border-gray-700">
                                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                                </div>

                                <div class="py-1">
                                    {{-- <a href="{{ url('/dashboard') }}"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-200 hover:bg-gray-800 hover:text-white transition duration-150">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Dashboard
                                    </a> --}}

                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-200 hover:bg-gray-800 hover:text-white transition duration-150">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil
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
                        {{-- Guest Actions --}}
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
