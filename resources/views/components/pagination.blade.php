@props(['pageVar' => 'currentPage', 'totalVar' => 'totalPages', 'showVar' => 'showPager'])

<div x-show="{{ $showVar }}" class="flex items-center justify-between px-1 py-3">
    <p class="text-sm text-gray-500">
        Page <span x-text="{{ $pageVar }}"></span> of <span x-text="{{ $totalVar }}"></span>
    </p>
    <div class="flex items-center gap-1">
        <button
            @click="prevPage()"
            :disabled="{{ $pageVar }} <= 1"
            :class="{{ $pageVar }} <= 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-gray-100'"
            class="p-2 rounded-lg text-gray-600 transition-colors"
            aria-label="Previous page"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button
            @click="nextPage()"
            :disabled="{{ $pageVar }} >= {{ $totalVar }}"
            :class="{{ $pageVar }} >= {{ $totalVar }} ? 'opacity-40 cursor-not-allowed' : 'hover:bg-gray-100'"
            class="p-2 rounded-lg text-gray-600 transition-colors"
            aria-label="Next page"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>
