@if($locked)
    <button
        type="button"
        class="px-3 py-2 border border-blue-400 rounded-md text-gray-700 hover:bg-blue-400 hover:text-white"
        onclick="enableInput(this)"
    >
        Change password
    </button>
@endif
<div class="flex items-center w-full" id="password-input-wrapper" style="display: {{ $locked ? 'none' : 'block' }}">
    <div class="w-2/3 relative">
        <input
            type="password"
            id="{{ $id }}"
            name="{{ $name }}"
            class="w-full rounded-md disabled:opacity-30"
            {{ $locked ? 'disabled' : '' }}
        />
        <button
            type="button"
            class="absolute top-0 right-4 h-full"
            onclick="changeVisibility()"
        >
            <x-heroicon-o-eye class="w-5" id="view-icon" />
            <x-heroicon-o-eye-off class="w-5 hidden" id="hide-icon" />
        </button>
    </div>
    <div class="w-1/3 ml-2">
        <button
            type="button"
            class="p-1 text-sm text-indigo-600"
            onclick="generatePassword()"
        >
            Generate password
        </button>
    </div>
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

    const enableInput = e => {
        e.style.display = 'none';
        const wrapper = document.getElementById('password-input-wrapper');
        const input = document.getElementById('{{ $id }}');
        input.disabled = false;
        wrapper.style.display = 'flex';
    }

    const generatePassword = () => {
        const input = document.getElementById('{{ $id }}');
        input.value = Math.random().toString(36).slice(2);
    }
</script>
