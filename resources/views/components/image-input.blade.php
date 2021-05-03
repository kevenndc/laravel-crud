<div class="mb-3 {{ $imageClasses }}">
    <img id="img-preview" src="{{ $value ?? '' }}" class="object-cover h-full mx-auto">
</div>
<label for="{{ $name }}" class="cursor-pointer text-gray-500 border-2 border-blue-500 rounded-md">
    <div class="btn-img-input {{ $value ? 'has-image' : '' }}" id="btn-img-input">
        <x-heroicon-o-cloud-upload class="w-8 text-blue-500" id="label-icon" />
        <span id="img-label-text" class="block font-bold text-center">{{ $value ? 'Change image' : $label }}</span>
    </div>
    <input type="file" id="{{ $name }}" name="{{ $name }}" class="hidden" onchange="updateField(this)" value="{{ $value }}">
</label>

<script>
    const updateField = input => {
        const image = document.getElementById('img-preview');
        const label = document.getElementById('img-label-text');
        const button = document.getElementById('btn-img-input');
        const file = input.files[0];

        // create and assign a temporary URL of the selected image
        image.src = URL.createObjectURL(file);

        label.innerText = 'Change image';
        button.classList.add('has-image');
    };
</script>
