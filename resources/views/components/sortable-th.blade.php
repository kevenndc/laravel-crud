@php
    $isActive = request()->get('orderby') === $column;
    $order = request()->get('order');
    $query = request()->getQueryString();
    $query = preg_replace('/&?orderby(.)*/', '', $query);
    $params = explode('=', $query);
@endphp

<th {{ $attributes->merge(['class']) }}>
    <a href="{{
        $order === 'asc'
            ? route($route, array_merge($params, ['orderby' => $column, 'order' => 'desc']))
            : route($route, array_merge($params, ['orderby' => $column, 'order' => 'asc']))
    }}">
        {{ $slot }}

        @if($isActive && $order === 'asc')
            <x-heroicon-o-arrow-sm-up class="w-5" />
        @elseif($isActive && $order === 'desc')
            <x-heroicon-o-arrow-sm-down class="w-5" />
        @else
            <x-heroicon-o-switch-vertical class="w-5 text-gray-300" />
        @endif
    </a>
</th>
