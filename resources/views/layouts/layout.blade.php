@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 pb-12">
        @include('partials.toast')
        @include('partials.nav')
        @include('partials.sidebar')

        @yield('render')

        @include('partials.notifications')`
    </div>
@endsection