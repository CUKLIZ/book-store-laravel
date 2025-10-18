@if (!Request::is('/'))
    <div class="max-w-7xl mx-auto w-full px-4">
        <nav class="max-w-7xl mx-auto px-4 pt-8 pb-4 animate-fade-in">
            <ol class="inline-flex items-center space-x-2 text-sm text-gray-400">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-green-400 transition">
                        Home
                    </a>
                </li>

                <li class="text-gray-500">›</li>

                <li>
                    <a href="{{ route('categories.showAll') }}" class="hover:text-green-400 transition">
                        Kategori
                    </a>
                </li>

                @if (Request::routeIs('category.show')) 
                    <li class="text-gray-500">›</li>
                    <li class="text-gray-500 font-medium">
                        {{ $category->name }}
                    </li>
                @endif
            </ol>
        </nav>
    </div>
@endif