@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-indigo-700 lg:px-3 text-sm uppercase font-bold'
            : 'text-gray-500 hover:text-gray-700 hover:text-white lg:px-3 text-sm uppercase font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
