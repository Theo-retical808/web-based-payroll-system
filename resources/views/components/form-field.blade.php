@props(['name' => '', 'label' => '', 'type' => 'text', 'required' => false, 'error' => null, 'options' => []])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if($required)<span class="text-red-500 ml-0.5">*</span>@endif
    </label>

    @if($type === 'select')
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->merge(['class' => 'w-full text-sm border border-gray-300 rounded-lg px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent' . ($error ? ' border-red-400' : '')]) }}
        >
            {{ $slot }}
        </select>
    @elseif($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="3"
            {{ $attributes->merge(['class' => 'w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none' . ($error ? ' border-red-400' : '')]) }}
        >{{ $slot }}</textarea>
    @else
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->merge(['class' => 'w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent' . ($error ? ' border-red-400' : '')]) }}
        >
    @endif

    @if($error)
        <p class="mt-1 text-sm text-red-700">{{ $error }}</p>
    @endif
</div>
