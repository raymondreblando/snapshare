@extends('layouts.layout')
@section('title', 'SnapShare - Peoples')

@section('render')
    <div class="flex flex-col items-center gap-4 pt-[110px] pb-8">
        @include('partials.searchbar')

        <div class="w-[min(700px,95%)] flex flex-col gap-4">

            @if (count($users) > 0)
                <div class="bg-white rounded-lg border border-gray-200/80 py-2 px-6">
                    @foreach ($users as $user)
                        @include('partials.follower-card', ['user' => $user])
                    @endforeach
                </div>
            @else
                <div class="min-h-[calc(100vh-230px)] flex flex-col justify-center items-center">
                    <img src="{{ asset('images/user-empty.svg') }}" alt="snap empty" class="w-8 h-8 mb-2">
                    <p class="text-sm text-gray-400 font-medium">No snap users found</p>
                </div>
            @endif
        </div>
    </div>
@endsection
