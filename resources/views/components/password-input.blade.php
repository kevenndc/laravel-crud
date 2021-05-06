<div class="relative">
    <input type="password" id="{{ $id }}" name="{{ $name }}" class="w-full rounded-md">
    <button type="button" class="absolute top-0 right-4 h-full" onclick="changeVisibility()">
        <x-heroicon-o-eye class="w-5" id="view-icon" />
        <x-heroicon-o-eye-off class="w-5 hidden" id="hide-icon" />
    </button>
</div>
<script>
    const changeVisibility = () => {
        const input = document.getElementById('{{ $id }}');
        const viewIcon = document.getElementById('view-icon');
        const hideIcon = document.getElementById('hide-icon');
        if (input.type === 'password') {
            input.type = 'text';
            viewIcon.style.display = 'none';
            hideIcon.style.display = 'block';
        } else {
            input.type = 'password';
            viewIcon.style.display = 'block';
            hideIcon.style.display = 'none';
        }
    }
</script>
