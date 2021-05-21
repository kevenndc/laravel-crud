<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <label for="{{ $name }}" class="flex items-center justify-between cursor-pointer">
        <span class="mr-3">
            {{ $label }}
        </span>
        <div class="relative">
            <!-- input -->
            <input type="checkbox" id="{{ $name }}" name="{{ $name }}" class="sr-only toggle-input" value="{{ old($name) }}">
            <!-- line -->
            <div class="block bg-gray-300 w-14 h-8 rounded-full"></div>
            <!-- dot -->
            <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
        </div>
    </label>
</div>
