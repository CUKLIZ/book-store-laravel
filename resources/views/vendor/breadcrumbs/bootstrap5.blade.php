@if (isset($breadcrumbs))
<nav class="animate-fade-in mb-6" aria-label="Breadcrumb">
    <div class="inline-flex items-center space-x-2">
        <a href="/" class="inline-flex items-center group">
            <svg class="w-4 h-4 text-gray-400 group-hover:text-green-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
        </a>
        <ol class="flex items-center space-x-1">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!$loop->last)
                    <li class="inline-flex items-center group">
                        <a href="{{ $breadcrumb->url ?? '#' }}" 
                           class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-white hover:bg-green-500 dark:hover:bg-green-600 rounded-full transition-all duration-300 ease-out transform hover:scale-105">
                            {{ $breadcrumb->title }}
                        </a>
                        <svg class="w-3.5 h-3.5 mx-1.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </li>
                @else
                    <li aria-current="page" class="inline-flex items-center">
                        <span class="px-3 py-1 text-sm font-semibold text-green-600 dark:text-green-400">
                            {{ $breadcrumb->title }}
                        </span>
                    </li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
@endif