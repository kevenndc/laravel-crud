@extends('layouts.dashboard')
@section('title', 'Posts')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Posts</h1>
    {{--    --}}
    <div>
        <a href="{{ route('admin.posts.index') }}" class="text-blue-400 text-sm">All ({{ $counts['posts'] }})</a>
        <a href="{{ route('admin.posts.index', 'published=1') }}" class="text-blue-400 text-sm">Published ({{ $counts['published'] }})</a>
        <a href="{{ route('admin.posts.index', 'published=0') }}" class="text-blue-400 text-sm">Drafts ({{ $counts['drafts'] }})</a>
        <a href="{{ route('admin.posts.index', 'trashed=1') }}" class="text-red-500 text-sm">Trash ({{ $counts['trashed'] }})</a>
    </div>

    {{--  Post List  --}}
    <div class="bg-white rounded-lg p-4">
            @forelse($posts as $post)
                <div class="flex justify-between py-4 border-b border-gray-300">
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
