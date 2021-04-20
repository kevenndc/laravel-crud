@props(['title', 'route'])

<li class="side-menu-item {{ request()->routeIs($route) ? 'active' : '' }}">
    <a href="{{ route($route) }}" class="inline-block w-full py-2 px-3">
        {{ $title }}
    </a>
</li>
