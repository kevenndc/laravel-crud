@extends('layouts.dashboard')
@section('title', 'Posts')

@section('content')
    <h1 class="text-2xl text-gray-900 font-bold">Posts</h1>
    <div class="bg-white rounded-lg p-4">
        <form>
            @csrf
            @forelse($posts as $post)
                <div class="flex justify-between py-4 border-b border-gray-300">
                    <div>
                        <input type="checkbox">
                        <a href="#">{{ $post->title }}</a>
                    </div>
                    <div>
                        <button><x-heroicon-o-pencil-alt /> Edit</button>
                        <button><x-heroicon-o-trash /> Delete</button>
                    </div>
                </div>
            @empty
                <p>Nenhum post cadastrado ainda.</p>
            @endforelse
        </form>
    </div>
@endsection
