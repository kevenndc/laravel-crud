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
            <div class="max-h-screen p-12 overflow-y-scroll">
                <div class="pb-12">
                    @section('content')
                        @show
                </div>
            </div>
        </div>
    </div>
@endsection

