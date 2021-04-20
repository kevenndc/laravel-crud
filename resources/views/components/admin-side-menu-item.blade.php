@props(['title', 'route'])

<li class="side-menu-item {{ request()->routeIs($route) ? 'active' : '' }}">
    <a href="{{ route($route) }}" class="inline-flex w-full py-2 px-3">
        <span class="w-6 mr-2">{{  $slot }}</span>
        {{ $title }}
    </a>
</li>
