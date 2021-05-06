@extends('layouts.dashboard')
@section('title', 'Users')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Users</h1>
    {{--  Menu  --}}
    <div class="flex justify-between items-center mb-3">
        {{-- Filters --}}
        <div>
            <a href="{{ route('users.index') }}" class="text-blue-400 text-sm mr-2">All ()</a>
            <a href="{{ route('users.index') }}" class="text-blue-400 text-sm mr-2">Admins ()</a>
            <a href="{{ route('users.index') }}" class="text-blue-400 text-sm mr-2">Editors ()</a>
            <a href="{{ route('users.index') }}" class="text-blue-400 text-sm">Collaborator ()</a>
        </div>
        <div>
            <a href="{{ route('users.create') }}" class="py-2 px-4 font-bold flex items-center text-white bg-blue-500 rounded-lg shadow-md duration-200 hover:bg-blue-600">
                <x-heroicon-o-user-add class="w-5 mr-1" />
                Add user
            </a>
        </div>
    </div>
    {{--  Post List  --}}
    <div class="bg-white rounded-lg p-4 shadow-md">
        @if(isset($users))
            <table class="w-full">
                <thead>
                <x-sortable-th route="users.index" column="title" class="px-3 text-left">Name</x-sortable-th>
                <th class="px-3">E-mail</th>
                <x-sortable-th route="users.index" column="created_at" class="px-3 text-left text-center">Nº of Posts</x-sortable-th>
                <th class="px-3">Role</th>
                <th class="px-3">Actions</th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="w-full border-b border-gray-300 last:border-b-0">
                        {{-- Name --}}
                        <td class="py-4 px-3">
                            <a href="{{ route('users.edit', $user) }}">{{ $user->name }}</a>
                        </td>
                        {{-- E-mail --}}
                        <td class="py-4 px-3 text-center">
                            <p>{{ $user->email }}</p>
                        </td>
                        {{-- Nº of posts --}}
                        <td class="py-4 px-3 text-center">
                            <a href="#">{{ $user->posts->count() }}</a>
                        </td>
                        {{-- Role --}}
                        <td class="py-4 px-3 text-center">
                            <a href="#">{{ $user->role ?? 'Placeholder' }}</a>
                        </td>
                        {{-- Options --}}
                        <td class="py-4 px-3 w-36">
                            <div class="flex justify-between">
                                <div class="text-center">
                                    <a href="{{ route('users.edit', $user) }}" class="text-blue-400"><x-heroicon-o-pencil-alt class="w-5 inline-block" /> Edit</a>
                                </div>
                                <div class="flex">
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="flex">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user }}">
                                        <button type="submit" class="text-red-500"><x-heroicon-o-trash class="w-5 inline-block" /> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{ $users->links() }}
            </div>
        @else
            <h1 class="text-xl text-gray-700 font-bold">No users found.</h1>
        @endif
    </div>
@endsection
