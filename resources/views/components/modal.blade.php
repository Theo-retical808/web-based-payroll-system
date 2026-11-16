@props(['name' => 'modal', 'title' => '', 'maxWidth' => 'lg'])

@php
$widths = ['sm' => 'max-w-sm', 'md' => 'max-w-md', 'lg' => 'max-w-lg', 'xl' => 'max-w-xl', '2xl' => 'max-w-2xl'];
$widthClass = $widths[$maxWidth] ?? $widths['lg'];
@endphp

<div
    x-data="{ open: false, triggerEl: null }"
    @open-modal-{{ $name }}.window="open = true; triggerEl = $event.detail?.trigger ?? null"
    @close-modal-{{ $name }}.window="open = false; $nextTick(() => triggerEl?.focus())"
    @keydown.escape.window="if(open) { open = false; $nextTick(() => triggerEl?.focus()); }"
>
    {{-- Backdrop --}}
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false; $nextTick(() => triggerEl?.focus())"
        class="fixed inset-0 z-40 bg-black/50"
        style="display: none;"
    ></div>

    {{-- Panel --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-trap.inert.noscroll="open"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        style="display: none;"
    >
        <div class="bg-white rounded-2xl shadow-2xl w-full {{ $widthClass }} max-h-screen overflow-y-auto">
            @if($title)
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-base font-semibold text-gray-900">{{ $title }}</h3>
                <button
                    @click="open = false; $nextTick(() => triggerEl?.focus())"
                    class="p-1.5 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-600"
                    aria-label="Close dialog"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endif
            <div class="px-6 py-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
