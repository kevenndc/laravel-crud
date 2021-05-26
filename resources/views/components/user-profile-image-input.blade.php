<div class="h-56 w-56 relative group mx-auto">
    <img id="img-preview" src="{{ $value ?? \App\Models\User::DEFAULT_PROFILE_IMAGE }}" class="object-cover object-center w-full h-full rounded-full mx-auto">
    <label for="{{ $name }}" class="hidden absolute top-0 bg-black bg-opacity-50 cursor-pointer text-white rounded-full w-full h-full group-hover:flex items-center justify-center">
        <div class="btn-img-input flex flex-col text-white" id="btn-img-input">
            <x-heroicon-o-cloud-upload class="w-8 " id="label-icon" />
            <span id="img-label-text text-md" class="block font-bold text-center">Change image</span>
        </div>
        <input type="file" id="{{ $name }}" name="{{ $name }}" class="hidden" onchange="updateField(this)" value="{{ $value }}">
    </label>
</div>

<script>
    const updateField = input => {
        const image = document.getElementById('img-preview');
        const file = input.files[0];

        // create and assign a temporary URL of the selected image
        image.src = URL.createObjectURL(file);
    };
</script>
