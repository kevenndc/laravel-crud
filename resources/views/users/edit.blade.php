@extends('layouts.dashboard')
@section('title', 'Edit user')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Edit User</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="flex">
            <!-- Post content -->
            <div class="w-full bg-white rounded-lg p-4 mr-6 shadow-md">
                <div class="flex">
                    <div class="w-64 mr-7">
                        <x-user-profile-image-input name="edit avatar" />
                    </div>
                    <div class="w-full">
                        {{-- Name --}}
                        <label for="name" class="text-xl text-gray-700">Name</label>
                        <input type="text" id="name" name="name" placeholder="User name" class="block mb-4 w-full rounded-md" value="{{ $user->name }}" required autofocus>
                        {{-- E-mail --}}
                        <label for="email" class="text-xl text-gray-700">E-mail</label>
                        <input type="text" id="email" name="email" placeholder="User e-mail" class="block mb-4 w-full rounded-md" value="{{ $user->email }}" required>
                        {{-- Password --}}
                        <label for="password-input" class="text-xl text-gray-700">Password</label>
                        <div class="flex items-center max-w-3xl">
                            <div class="w-2/3">
                                <x-password-input name="password" id="password-input" />
                            </div>
                            <div class="w-1/3 ml-2">
                                <button type="button" class="p-1 text-sm text-indigo-600" onclick="generatePassword()">Generate password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post options -->
            <div class="w-2/6 max-w-300 flex flex-col bg-white rounded-lg p-4 shadow-md">
                <div class="flex flex-col items-center mb-8">
                    <button type="submit" name="save" value="publish" class="py-2 mb-2 table-cell align-middle w-full font-bold text-white border-2 border-blue-500 bg-blue-500 rounded-lg shadow-md duration-200 hover:bg-blue-600 hover:border-blue-600">
                        Update user
                    </button>
                </div>
                <div class="flex items-center">
                    <x-select-role name="role" :currentRole="$user->role" />
                </div>
                <x-toggle-button name="send-notification" label="Send email notification?" class="mt-8 text-gray-900 text-md font-bold" />
            </div>
        </div>
    </form>
    <script>
        const generatePassword = () => {
            const input = document.getElementById('password-input');
            input.value = Math.random().toString(36).slice(2);
        }
    </script>
@endsection
