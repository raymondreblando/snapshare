@use('App\Helpers\DateFormatter')
@use('App\Helpers\StringFormatter')

@extends('layouts.layout')
@section('title', 'SnapShare - Feed')


@section('render')
<div class="flex flex-col items-center gap-4 pt-[110px] pb-8">
        @include('partials.searchbar')
        @include('partials.delete-snap-dialog')

        <div class="w-[min(700px,95%)] flex flex-col gap-4">
            @forelse ($snaps as $snap)
                @include('partials.snap-post', ['snap' => $snap])
            @empty
                <div class="min-h-[calc(100vh-230px)] flex flex-col justify-center items-center">
                    <img 
                        src="{{ asset('images/snap-empty.svg') }}" 
                        alt="snap empty" 
                        class="w-8 h-8 mb-2"
                    >
                    <p class="text-sm text-gray-400 font-medium">No available snaps</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
