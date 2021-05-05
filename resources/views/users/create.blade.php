@extends('layouts.dashboard')
@section('title', 'New user')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">New User</h1>
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
        @csrf
        <div class="flex">
            <!-- Post content -->
            <div class="w-full bg-white rounded-lg p-4 mr-6 shadow-md">
                <div class="grid grid-rows-2 grid-cols-3 gap-2">
                    <div class="col-span-1 row-span-2">
                        <x-image-input name="featured_image" label="Select a featured image" class="block w-full" imageClasses="max-h-48" />
                    </div>
                    <div class="col-span-2 row-span-2">
                        <label for="title" class="text-xl text-gray-700">Name</label>
                        <input type="text" id="title" name="title" placeholder="Post title" class="block mb-4 w-full rounded-md" value="{{ old('name') }}" required autofocus>

                        <label for="content" class="text-xl text-gray-700">E-mail</label>
                        <input type="text" id="title" name="title" placeholder="Post title" class="block mb-4 w-full rounded-md" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <label for="excerpt" class="text-xl text-gray-700">Excerpt</label>
                <textarea id="excerpt" name="excerpt" placeholder="Post excerpt" class="block w-full h-40 resize-none rounded-md">{{ old('excerpt') }}</textarea>
            </div>
            <!-- Post options -->
            <div class="w-2/6 max-w-300 flex flex-col bg-white rounded-lg p-4 shadow-md">
                <div class="flex flex-col items-center mb-8">
                    <button type="submit" name="save" value="publish" class="py-2 mb-2 table-cell align-middle w-full font-bold text-white border-2 border-blue-500 bg-blue-500 rounded-lg shadow-md duration-200 hover:bg-blue-600 hover:border-blue-600">
                        Publish post
                    </button>
                    <button type="submit" name="save" value="draft" class="py-2 table-cell align-middle w-full font-bold text-blue-400 border-2 border-current rounded-lg shadow-md duration-200 hover:bg-gray-100">
                        Save as draft
                    </button>
                </div>
                <x-toggle-button name="is_featured" label="Is featured?" class="mb-7" />

            </div>
        </div>
    </form>
@endsection
