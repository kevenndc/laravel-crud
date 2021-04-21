@extends('layouts.app')
@section('title')
    @yield('title', 'Dashboard')
@endsection

@section('dashboard')
    <div class="flex">
        <div class="w-1/5">
            @include('components.admin-side-menu')
        </div>
        <div class="w-4/5">
            @include('layouts.navigation')
            @section('content')
                @show
        </div>
    </div>
@endsection

