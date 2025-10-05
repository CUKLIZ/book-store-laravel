{{-- resources/views/vendor/pagination/tailwind.blade.php --}}
@if ($paginator->hasPages())
    <div class="flex flex-col items-center gap-6">
        {{-- Pagination Navigation --}}
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-700/50 text-gray-500 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="hidden sm:inline">Previous</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-700 text-white hover:bg-emerald-600 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/50 group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="hidden sm:inline font-medium">Previous</span>
                </a>
            @endif

            {{-- Page Numbers - Limit to 5 pages --}}
            <div class="flex items-center gap-1">
                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                    
                    // Adjust if we're near the beginning or end
                    if ($current <= 3) {
                        $start = 1;
                        $end = min(5, $last);
                    } elseif ($current > $last - 2) {
                        $start = max(1, $last - 4);
                        $end = $last;
                    }
                @endphp

                {{-- First page if not in range --}}
                @if ($start > 1)
                    <a href="{{ $paginator->url(1) }}" 
                       class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white transition-all duration-300 hover:scale-110 font-semibold border-2 border-transparent hover:border-emerald-500/30">
                        1
                    </a>
                    @if ($start > 2)
                        <span class="inline-flex items-center justify-center w-10 h-10 text-gray-400 font-bold">...</span>
                    @endif
                @endif

                {{-- Page numbers --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <span class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold shadow-lg shadow-emerald-500/50 border-2 border-emerald-400">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}" 
                           class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white transition-all duration-300 hover:scale-110 font-semibold border-2 border-transparent hover:border-emerald-500/30">
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                {{-- Last page if not in range --}}
                @if ($end < $last)
                    @if ($end < $last - 1)
                        <span class="inline-flex items-center justify-center w-10 h-10 text-gray-400 font-bold">...</span>
                    @endif
                    <a href="{{ $paginator->url($last) }}" 
                       class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white transition-all duration-300 hover:scale-110 font-semibold border-2 border-transparent hover:border-emerald-500/30">
                        {{ $last }}
                    </a>
                @endif
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-700 text-white hover:bg-emerald-600 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/50 group">
                    <span class="hidden sm:inline font-medium">Next</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-700/50 text-gray-500 cursor-not-allowed">
                    <span class="hidden sm:inline">Next</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
        </nav>

        {{-- Page Info --}}
        <div class="text-sm text-gray-400">
            Showing <span class="font-semibold text-emerald-400">{{ $paginator->firstItem() }}</span> 
            to <span class="font-semibold text-emerald-400">{{ $paginator->lastItem() }}</span> 
            of <span class="font-semibold text-emerald-400">{{ $paginator->total() }}</span> results
        </div>
    </div>
@endif