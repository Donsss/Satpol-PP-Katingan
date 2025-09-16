@props(['active' => false])

@php
$classes = $active
    ? 'flex items-center px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-200'
    : 'flex items-center px-4 py-2 mt-2 text-sm font-semibold text-gray-600 rounded-lg hover:bg-gray-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>