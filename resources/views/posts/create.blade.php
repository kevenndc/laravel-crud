@extends('layouts.dashboard')
@section('title', 'New post')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">New Post</h1>
    <form action="{{ route('admin.posts.create') }}" method="POST" >
        @csrf
        <div class="flex">
            <div class="w-5/6 bg-white rounded-lg p-4 mr-6 shadow-md">
                <input type="text" name="post-title" placeholder="Post title" class="block mb-4 w-full rounded-md" required>
                <textarea name="post-content" placeholder="Post content" class="block mb-4 w-full h-96 resize-none rounded-md"></textarea>
                <textarea name="post-excerpt" placeholder="Post excerpt" class="block w-full h-40 resize-none rounded-md"></textarea>
            </div>
            <div class="w-1/6 flex flex-col bg-white rounded-lg p-4 shadow-md">
                <div class="flex flex-col items-center">
                    <button type="submit" name="save" value="publish" class="py-2 mb-2 table-cell align-middle w-full max-w-200 font-bold text-white border-2 border-blue-500 bg-blue-500 rounded-lg shadow-md duration-200 hover:bg-blue-600 hover:border-blue-600">
                        Publish post
                    </button>
                    <button type="submit" name="save" value="draft" class="py-2 mb-2 table-cell align-middle w-full max-w-200 max-w-xs font-bold text-blue-400 border-2 border-current rounded-lg shadow-md duration-200 hover:bg-gray-100">
                        Save as draft
                    </button>
                </div>
                <input type="file" name="featured-image" class="block w-full">
                <input type="checkbox" name="is-featured">
            </div>
        </div>
    </form>
@endsection

