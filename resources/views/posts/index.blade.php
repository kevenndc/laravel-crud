@extends('layouts.dashboard')
@section('title', 'Posts')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Posts</h1>
    <div class="bg-white rounded-lg p-4">
        <form>
            @csrf
            @forelse($posts as $post)
                <div class="flex justify-between py-4 border-b border-gray-300">
                    <div class="w-3/4">
                        <input type="checkbox">
                        <a href="#">{{ $post->title }}</a>
                    </div>
                    <div class="flex w-1/4 justify-end">
                        <div class="mr-6">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-400"><x-heroicon-o-pencil-alt class="w-5 inline-block" /> Edit</a>
                        </div>
                        <div class="flex">
                            <form action="{{ route('admin.posts.delete', $post->id) }}" method="GET" class="flex">
                                @csrf
                                <input type="hidden" name="id" value="{{ $post->id }}">
                                <button type="submit" class="text-red-500"><x-heroicon-o-trash class="w-5 inline-block" /> Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nenhum post cadastrado ainda.</p>
            @endforelse
        </form>
    </div>
@endsection
