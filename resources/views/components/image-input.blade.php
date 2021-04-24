<div class="mb-3">
    <img id="img-preview">
</div>
<label for="{{ $name }}" class="flex flex-col items-center py-6 px-3 cursor-pointer border-2 border-gray-500 rounded-md">
    <x-heroicon-o-cloud-upload class="w-8 text-blue-500" />
    <span id="img-label-title" class="block font-bold text-center text-gray-500">{{ $label }}</span>
    <input type="file" id="{{ $name }}" name="{{ $name }}" class="hidden" onchange="loadImage(this)">
</label>

<script>
    const loadImage = input => {
        const image = document.getElementById('img-preview');
        const label = document.getElementById('img-label-title');
        const file = input.files[0];

        image.src = URL.createObjectURL(file);
        label.innerText = file.name;
    };
</script>
