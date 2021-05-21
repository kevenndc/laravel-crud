@php
    $isActive = request()->get('orderby') === $column;
    $order = request()->get('order');
    $params = request()->query->all();
@endphp

<th {{ $attributes->merge(['class']) }}>
    @if($isActive && $order === 'asc')
        <a href="{{ route(Route::currentRouteName(), array_merge($params, ['orderby' => $column, 'order' => 'desc'])) }}">
            {{ $slot }}
            <x-heroicon-o-arrow-sm-up class="inline-block w-5" />
        </a>
    @elseif($isActive && $order === 'desc')
        <a href="{{ route(Route::currentRouteName(), array_merge($params, ['orderby' => $column, 'order' => 'asc'])) }}">
            {{ $slot }}
            <x-heroicon-o-arrow-sm-down class="inline-block w-5" />
        </a>
    @else
        <a href="{{ route(Route::currentRouteName(), array_merge($params, ['orderby' => $column, 'order' => 'asc'])) }}">
            {{ $slot }}
            <x-heroicon-o-switch-vertical class="inline-block w-5 text-gray-300" />
        </a>
    @endif
</th>
