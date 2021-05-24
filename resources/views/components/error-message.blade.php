<div class="flex">
    <div class="mr-2">
        <x-heroicon-o-x-circle class="text-red-600 w-8" />
    </div>
    <div class="fle items-center relative text-gray-600 text-2xl">
        {{ $closeButton }}
        <h5 class="font-bold text-gray-900 text-2xl">Warning!</h5>
        {{ $slot }}
    </div>
</div>
