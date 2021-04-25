@extends('layouts.dashboard')
@section('title', 'New post')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">New Post</h1>
    <form action="{{ route('admin.posts.create') }}" method="POST" >
        @csrf
        <div class="flex">
            <div class="w-full bg-white rounded-lg p-4 mr-6 shadow-md">
                <input type="text" name="title" placeholder="Post title" class="block mb-4 w-full rounded-md" required>
                <textarea name="content" placeholder="Post content" class="block mb-4 w-full h-96 resize-none rounded-md"></textarea>
                <textarea name="excerpt" placeholder="Post excerpt" class="block w-full h-40 resize-none rounded-md"></textarea>
            </div>
            <div class="w-2/6 max-w-300 flex flex-col bg-white rounded-lg p-4 shadow-md">
                <div class="flex flex-col items-center mb-5">
                    <button type="submit" name="save" value="publish" class="py-2 mb-2 table-cell align-middle w-full font-bold text-white border-2 border-blue-500 bg-blue-500 rounded-lg shadow-md duration-200 hover:bg-blue-600 hover:border-blue-600">
                        Publish post
                    </button>
                    <button type="submit" name="save" value="draft" class="py-2 mb-2 table-cell align-middle w-full font-bold text-blue-400 border-2 border-current rounded-lg shadow-md duration-200 hover:bg-gray-100">
                        Save as draft
                    </button>
                </div>
                <x-image-input name="featured_image" label="Select a featured image" class="block w-full" />
                <input type="checkbox" name="is_featured">
            </div>
        </div>
    </form>
@endsection

