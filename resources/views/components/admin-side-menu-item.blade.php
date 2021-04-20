@props(['title', 'route'])

@php
    $classes = 'py-1 px-3 rounded-lg hover:bg-gray-600 ';
    $classes .= request()->routeIs($route)
                ? 'bg-gray-800 text-white'
                : 'text-gray-300';
@endphp


<li {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ route($route) }}" class="inline-block w-full">
        {{ $title }}
    </a>
</li>
