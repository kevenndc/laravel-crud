<label class="text-md font-bold text-gray-900 mr-3 w-1/2" for="role">
    Role:
    <select id="role" name="role" class="w-full" >
        <option {{ $roles->contains($currentRole) ? '' : 'selected' }}>...</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ $role == $currentRole ? 'selected' : '' }}>{{ $role->name }}</option>
        @endforeach
    </select>
</label>
