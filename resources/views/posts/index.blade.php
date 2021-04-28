@extends('layouts.dashboard')
@section('title', 'Posts')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Posts</h1>
    {{--  Menu  --}}
    <div class="flex justify-between items-center mb-3">
        {{-- Filters --}}
        <div>
            <a href="{{ route('admin.posts.index') }}" class="text-blue-400 text-sm mr-2">All ({{ $counts['posts'] }})</a>
            <a href="{{ route('admin.posts.index', [ 'filter' => 'published']) }}" class="text-blue-400 text-sm mr-2">Published ({{ $counts['published'] }})</a>
            <a href="{{ route('admin.posts.index', ['filter' => 'drafts']) }}" class="text-blue-400 text-sm mr-2">Drafts ({{ $counts['drafts'] }})</a>
            <a href="{{ route('admin.posts.index', ['filter' => 'trashed']) }}" class="text-red-500 text-sm">Trash ({{ $counts['trashed'] }})</a>
        </div>
        <div>
            <a href="{{ route('admin.posts.create') }}" class="py-2 px-4 font-bold flex items-center text-white bg-blue-500 rounded-lg shadow-md duration-200 hover:bg-blue-600">
                <x-heroicon-o-plus-circle class="w-5 mr-1" />
                New Post
            </a>
        </div>
    </div>

    {{--  Post List  --}}
    <div class="bg-white rounded-lg p-4 shadow-md">
        @if($posts->isNotEmpty())
        <table class="w-full">
            <thead>
                <x-sortable-th route="admin.posts.index" column="id" class="text-left">
                    ID
                </x-sortable-th>
                <x-sortable-th route="admin.posts.index" column="title" class="text-left">
                    Title
                </x-sortable-th>
                <x-sortable-th route="admin.posts.index" column="title" class="text-left">
                    Created at
                </x-sortable-th>
                <th>Author</th>
                <th>Options</th>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr class="w-full border-b border-gray-300 last:border-b-0">
                    <td class="py-4">
                        <span>{{ $post->id }}</span>
                    </td>
                    <td class="py-4">
                        <a href="#">{{ Str::limit($post->title, 100, '...') }}</a>
                        <span> -  {{ $post->published }}</span>
                    </td>
                    <td class="py-4 text-center">
                        <a href="#">{{ $post->user->name }}</a>
                    </td>
                    <td class="py-4">
                        <div class="flex justify-between">
                            <div>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-400"><x-heroicon-o-pencil-alt class="w-5 inline-block" /> Edit</a>
                            </div>
                            <div class="flex">
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="flex">
                                    @method('DELETE')
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $post }}">
                                    <button type="submit" class="text-red-500"><x-heroicon-o-trash class="w-5 inline-block" /> Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <h1 class="text-xl text-gray-700 font-bold">No posts found.</h1>
        @endif

    </div>
@endsection
