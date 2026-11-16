@props(['model' => 'filter', 'label' => 'Filter', 'options' => []])

<select
    x-model="{{ $model }}"
    {{ $attributes->merge(['class' => 'text-sm border border-gray-300 rounded-lg px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent']) }}
>
    <option value="">All {{ $label }}</option>
    @foreach($options as $option)
        <option value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>
