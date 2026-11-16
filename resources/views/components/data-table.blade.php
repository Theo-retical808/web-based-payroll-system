@props(['class' => ''])

<div class="overflow-x-auto rounded-xl border border-gray-200 {{ $class }}">
    <table class="w-full text-sm text-left">
        {{ $slot }}
    </table>
</div>
