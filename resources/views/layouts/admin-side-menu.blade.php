<div class="w-1/5 h-screen bg-gray-700">
    <div class="bg-gray-800">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-white">
                <x-application-logo class="block h-10 w-auto fill-current" />
                <h1 class="font-logo ml-3 text-2xl">neutrino</h1>
            </a>
        </div>
    </div>
    <ul class=" p-2">
        <x-side-menu-item route='admin.dashboard' title='Dashboard'>
            <x-heroicon-o-home/>
        </x-side-menu-item>
        <x-side-menu-item route='admin.posts' title='Posts'>
            <x-heroicon-o-newspaper />
        </x-side-menu-item>
    </ul>
</div>

