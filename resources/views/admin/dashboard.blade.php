<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <nav class="w-1/5">
            @include('admin.components.side-menu')
        </nav>
        <div class="w-4/5">
            @include('layouts.navigation')
        </div>
    </div>

</x-app-layout>
