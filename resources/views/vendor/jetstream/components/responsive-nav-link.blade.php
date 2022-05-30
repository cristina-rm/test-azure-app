@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block p-4 text-base text-gray-600 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition border-b-2 border-primary font-bold focus:border-primary'
            : 'block p-4 border-transparent text-base text-gray-600 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
