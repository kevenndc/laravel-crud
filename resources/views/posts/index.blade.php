@extends('layouts.dashboard')
@section('title', 'Posts')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Posts</h1>
    {{--  Menu  --}}
    <div class="flex justify-between items-center mb-3">
        {{-- Filters --}}
        <div>
            <a href="{{ route('admin.posts.index') }}" class="text-blue-400 text-sm mr-2">All ({{ $counts['posts'] }})</a>
            <a href="{{ route('admin.posts.index', 'published=1') }}" class="text-blue-400 text-sm mr-2">Published ({{ $counts['published'] }})</a>
            <a href="{{ route('admin.posts.index', 'published=0') }}" class="text-blue-400 text-sm mr-2">Drafts ({{ $counts['drafts'] }})</a>
            <a href="{{ route('admin.posts.index', 'trashed=1') }}" class="text-red-500 text-sm">Trash ({{ $counts['trashed'] }})</a>
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
            @forelse($posts as $post)
                <div class="flex justify-between py-4 border-b border-gray-300 last:border-b-0">
                    <div class="w-3/4">
                        <input type="checkbox">
                        <a href="#">{{ $post->title }}</a>
                    </div>
                    <div class="flex w-1/4 justify-end">
                        <div class="mr-6">
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
                </div>
            @empty
                <h1 class="text-xl text-gray-700 font-bold">Nenhum post cadastrado ainda.</h1>
            @endforelse
    </div>
@endsection
