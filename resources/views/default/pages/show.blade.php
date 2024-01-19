@use('App\Helpers\StringFormatter')
@use('App\Helpers\DateFormatter')
@use('Illuminate\Support\Number')

@extends('layouts.layout')
@section('title', 'SnapShare - ' . $page->page_name)

@section('render')
    <div class="flex flex-col items-center gap-4 pt-[110px] pb-8">
        @include('partials.delete-page-dialog')

        <div class="w-[min(700px,95%)] flex flex-col gap-4">
            <div class="bg-white rounded-lg border border-gray-200/80 overflow-hidden">
                <div class="relative h-[250px]">
                    <img 
                        data-src="{{ asset('storage/page_covers/'. $page->page_cover) }}" 
                        src="{{ asset('storage/page_covers/' . 'optimize-' . $page->page_cover) }}" 
                        alt="{{ $page->page_name }} page cover photo" 
                        class="lazy w-full h-full object-cover"
                    >
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap justify-between items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img 
                                    data-src="{{ asset('storage/page_profiles/'. $page->page_profile) }}" 
                                    src="{{ asset('storage/page_profiles/'. 'optimize-' . $page->page_profile) }}" 
                                    alt="{{ $page->page_name }} profile" 
                                    class="lazy w-16 h-16 rounded-full object-cover"
                                >
                            </div>
                            <div>
                                <p class="text-black font-semibold">
                                    {{ $page->page_name }}
                                </p>
                                <p class="text-xs text-gray-400 font-medium">
                                    Created by {{ StringFormatter::username($page->user->username) }}
                                </p>
                                <p class="text-xs text-primary font-bold">
                                    <span class="follower-count">{{ Number::abbreviate($page->pageFollowerCount()) }}</span> Followers
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-2">

                            @unless ($page->isPageCreator())
                                @if ($page->isPageFollowed())
                                    @include('partials.unfollow-page-button', ['pageId' => $page->page_id])
                                @else
                                    @include('partials.follow-page-button', ['pageId' => $page->page_id])
                                @endif
                            @endunless

                            @can('update', $page)
                                @include('partials.page-option', ['page' => $page])
                            @endcan

                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200 px-6">
                    <button type="button" class="tab active">Snaps</button>
                    <button type="button" class="tab">Followers</button>
                </div>
            </div>

            @include('partials.searchbar')

            <div class="tab-container">
                <div class="tab-item active">
                    @forelse ($snaps as $snap)
                        @include('partials.snap-post', ['snap' => $snap])
                    @empty
                        <div
                            class="min-h-[300px] flex flex-col justify-center items-center bg-white rounded-lg border border-gray-200/80">
                            <img src="{{ asset('images/snap-empty.svg') }}" alt="snap empty" class="w-8 h-8 mb-2">
                            <p class="text-sm text-gray-400 font-medium">
                                No available page snaps
                            </p>
                        </div>
                    @endforelse
                </div>
                <div class="tab-item bg-white rounded-lg border border-gray-200/80 px-6 py-2">

                    @forelse ($followers as $follower)
                        @include('partials.follower-card-simplified', ['user' => $follower->user])
                    @empty
                        <div class="min-h-[300px] flex flex-col justify-center items-center">
                            <img src="{{ asset('images/user-empty.svg') }}" alt="snap empty" class="w-8 h-8 mb-2">
                            <p class="text-sm text-gray-400 font-medium">Page have no followers</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
