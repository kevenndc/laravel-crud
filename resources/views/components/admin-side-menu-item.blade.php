@props(['title', 'route'])

@php
    $classes = 'py-1 px-3 rounded-lg ';
    $classes .= request()->routeIs($route)
                ? 'bg-gray-800 text-white'
                : 'text-gray-300';
@endphp


<li {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ route($route) }}">
        {{ $title }}
    </a>
</li>
