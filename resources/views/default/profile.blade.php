@use('App\Helpers\StringFormatter')
@use('App\Helpers\DateFormatter')
@use('Illuminate\Support\Number')

@extends('layouts.layout')
@section('title', 'SnapShare - Profile')

@section('render')
    <div class="flex flex-col items-center gap-4 pt-[110px] pb-8">
        @include('partials.delete-snap-dialog')

        <div class="w-[min(700px,95%)] flex flex-col gap-4">
            @include('partials.user-profile')
            @include('partials.searchbar')

            <div class="tab-container">
                <div class="tab-item active">
                    <div class="flex flex-col gap-4">
                        @forelse ($snaps as $snap)
                            @include('partials.snap-post', ['snap' => $snap])
                        @empty
                            <div
                                class="min-h-[300px] flex flex-col justify-center items-center bg-white rounded-lg border border-gray-200/80">
                                <img src="{{ asset('images/snap-empty.svg') }}" alt="snap empty" class="w-8 h-8 mb-2">
                                <p class="text-sm text-gray-400 font-medium">
                                    No available snaps
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="tab-item bg-white rounded-lg border border-gray-200/80 px-6 py-2">
                    @forelse ($followers as $follower)
                        @include('partials.follower-card-simplified', ['user' => $follower->userFollower])
                    @empty
                        <div class="min-h-[300px] flex flex-col justify-center items-center">
                            <img src="{{ asset('images/user-empty.svg') }}" alt="snap empty" class="w-8 h-8 mb-2">
                            <p class="text-sm text-gray-400 font-medium">No followers were found</p>
                        </div>
                    @endforelse

                </div>
                <div class="tab-item bg-white rounded-lg border border-gray-200/80 px-6 py-2">
                    @forelse ($followings as $following)
                        @include('partials.follower-card-simplified', ['user' => $following->userFollowing])
                    @empty
                        <div class="min-h-[300px] flex flex-col justify-center items-center">
                            <img src="{{ asset('images/user-empty.svg') }}" alt="snap empty" class="w-8 h-8 mb-2">
                            <p class="text-sm text-gray-400 font-medium">User have no followings</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection
