<div class="flex">
    <div class="mr-2">
        <x-heroicon-o-check-circle class="text-green-600 w-8" />
    </div>
    <div class="fle items-center relative text-gray-600 text-2xl">
        {{ $closeButton }}
        <h5 class="font-bold text-gray-900 text-2xl">Success!</h5>
        {{ $slot }}
    </div>
</div>
