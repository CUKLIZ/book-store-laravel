<nav class="bg-gray-800 border-b border-gray-700 shadow-lg"> 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-white">MyCommerce</a> 
        <div class="space-x-4">
            <a href="#category-id" class="text-gray-300 hover:text-white">Category</a> 
            <a href="#products-section" class="text-gray-300 hover:text-white">Books</a>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-emerald-400 hover:text-emerald-300 font-medium">Masuk</a>
                <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-emerald-500 text-white rounded-md hover:bg-emerald-600 transition duration-300">Daftar</a>
            @endauth
        </div>
    </div>
</nav>