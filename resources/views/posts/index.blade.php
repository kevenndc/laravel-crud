@extends('layouts.dashboard')
@section('title', 'Posts')

@section('content')
    <ul>
        @forelse($posts as $post)
            <li>{{ $post->title }}</li>
        @empty
            <p>Nenhum post cadastrado ainda.</p>
        @endforelse
    </ul>
@endsection
