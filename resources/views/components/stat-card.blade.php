@props(['title' => '', 'value' => '0', 'subtitle' => null, 'color' => 'primary'])

@php
$iconColors = [
    'primary' => 'bg-teal-100 text-teal-900',
    'success' => 'bg-green-100 text-green-600',
    'warning' => 'bg-amber-100 text-amber-600',
    'danger'  => 'bg-red-100 text-red-600',
    'info'    => 'bg-sky-100 text-sky-600',
];
$iconColor = $iconColors[$color] ?? $iconColors['primary'];
@endphp

<div class="bg-white rounded-xl border border-gray-200 p-5 flex items-start gap-4">
    @if($slot->isNotEmpty())
    <div class="shrink-0 w-10 h-10 rounded-lg flex items-center justify-center {{ $iconColor }}">
        {{ $slot }}
    </div>
    @endif
    <div class="min-w-0">
        <p class="text-sm text-gray-500 font-medium truncate">{{ $title }}</p>
        <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $value }}</p>
        @if($subtitle)
        <p class="text-sm text-gray-600 mt-0.5">{{ $subtitle }}</p>
        @endif
    </div>
</div>
