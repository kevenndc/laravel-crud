@extends('layouts.dashboard')
@section('title', 'Posts')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Posts</h1>
    {{--  Menu  --}}
    <div class="flex justify-between items-center mb-3">
        {{-- Filters --}}
        <x-post-counts />
        <div>
            <a href="{{ route('posts.create') }}" class="py-2 px-4 font-bold flex items-center text-white bg-blue-500 rounded-lg shadow-md duration-200 hover:bg-blue-600">
                <x-heroicon-o-plus-circle class="w-5 mr-1" />
                New Post
            </a>
        </div>
    </div>
    {{--  Post List  --}}
    <div class="bg-white rounded-lg p-4 shadow-md">
        @if(isset($posts) && $posts->isNotEmpty())
            <table class="w-full">
                <thead>
                    <x-sortable-th route="posts.index" column="title" class="px-3 text-left w-5/12">Title</x-sortable-th>
                    <x-sortable-th route="posts.index" column="created_at" class="px-3 text-left">Date</x-sortable-th>
                    <th class="px-3">Author</th>
                    <th class="px-3">Options</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr class="w-full border-b border-gray-300 last:border-b-0">
                        {{-- Title --}}
                        <td class="py-4 px-3">
                            <a href="{{ route('posts.edit', $post) }}">{{ $post->title }}</a>
                            @if($post->status === 'draft')
                                <span class="text-gray-400 whitespace-nowrap"> - draft</span>
                            @endif
                        </td>
                        {{-- Date --}}
                        <td class="py-4 px-3">
                            <span class="block text-gray-500 text-sm">{{ $post->status === 'published at' ? $post->status : 'created at' }}</span>
                            <span class="block text-gray-700 text-">{{ $post->status === 'published' ? $post->published_at : $post->created_at }}</span>
                        </td>
                        <td class="py-4 px-3 text-center">
                            <a href="#">{{ Str::words($post->user->name, 3, '') }}</a>
                        </td>
                        {{-- Options --}}
                        <td class="py-4 px-3 w-48">
                            <div class="flex justify-evenly">
                                <div class="text-center">
                                    <a href="{{ route('posts.edit', $post) }}" class="text-blue-400 flex flex-col items-center "><x-heroicon-o-pencil-alt class="w-5 inline-block" /> Edit</a>
                                </div>
                                <div class="flex">
                                    <form action="{{
                                        Route::is('posts.trash.index')
                                            ? route('posts.trash.destroy', $post)
                                            : route('posts.destroy', $post)
                                        }}" method="POST" class="flex"
                                    >
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $post }}">
                                        <button type="submit" class="flex flex-col items-center text-red-500"><x-heroicon-o-trash class="w-5 inline-block" /> Delete</button>
                                    </form>
                                </div>
                                @if (Route::is('posts.trash.index'))
                                    <div class="flex">
                                        <form action="{{ route('posts.trash.update', $post) }}" method="POST" class="flex"
                                        >
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $post }}">
                                            <button type="submit" class="text-green-300 flex flex-col items-center "><x-heroicon-o-refresh class="w-5 inline-block" /> Restore</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-5">
            {{ $posts->links() }}
        </div>
        @else
            <h1 class="text-xl text-gray-700 font-bold">No posts found.</h1>
        @endif
    </div>
@endsection
