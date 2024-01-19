@extends('layouts.layout')
@section('title', 'SnapShare - Save Snaps')

@section('render')
<div class="flex flex-col items-center gap-4 pt-[110px] pb-8">
        @include('partials.searchbar')
        @include('partials.delete-snap-dialog')

        <div class="w-[min(700px,95%)] flex flex-col gap-4">
            @forelse ($saves as $save)
                @include('partials.snap-post', ['snap' => $save->snap])
            @empty
                <div class="min-h-[calc(100vh-200px)] flex flex-col justify-center items-center">
                    <img 
                        src="{{ asset('images/snap-empty.svg') }}" 
                        alt="snap empty" 
                        class="w-8 h-8 mb-2"
                    >
                    <p class="text-sm text-gray-400 font-medium">No save snaps found</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
