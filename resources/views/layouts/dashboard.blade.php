@extends('layouts.app')
@section('title')
    @yield('title', 'Dashboard')
@endsection

@section('dashboard')
    <div class="flex">
        <div class="w-1/6 min-w-min max-w-200">
            @include('components.admin-side-menu')
        </div>
        <div class="w-full">
            @include('layouts.navigation')
            <div class="max-h-screen p-12 overflow-y-auto">
                <div class="pb-12">
                    @section('content')
                        @show
                </div>
            </div>
        </div>
    </div>
@endsection

