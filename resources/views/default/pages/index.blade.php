@use('App\Helpers\StringFormatter')

@extends('layouts.layout')
@section('title', 'SnapShare - Pages')

@section('render')
    <div class="flex flex-col items-center gap-4 pt-[110px] pb-8">
        @include('partials.searchbar')

        <div class="w-[min(700px,95%)] flex flex-col gap-4">

            @if (count($pages) > 0)
                <div class="bg-white rounded-lg border border-gray-200/80 px-6 py-2">

                    @foreach ($pages as $page)
                        <div class="search-area flex flex-wrap justify-between items-center border-b last:border-b-0 border-b-gray-200/80 gap-3 py-6">
                            <div class="flex items-center gap-4">
                                <img 
                                    data-src="{{ asset('storage/page_profiles/'. $page->page_profile) }}" 
                                    src="{{ asset('storage/page_profiles/'. 'optimize-' . $page->page_profile) }}" 
                                    alt="{{ $page->page_name }} profile" 
                                    class="lazy w-20 h-20 rounded-full object-cover"
                                >
                                <div>
                                    <a href="{{ route('page.show', $page) }}" class="finder1 text-black font-semibold">
                                        {{ $page->page_name }}
                                    </a>
                                    <p class="finder2 text-xs text-gray-400 font-medium mb-1">
                                        Created by {{ StringFormatter::username($page->user->username) }}
                                    </p>
                                    <p class="text-sm text-primary font-bold">
                                        <span class="follower-count">{{ $page->pageFollowerCount() }}</span> Followers
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2">

                                @if ($page->isPageCreator())
                                    <a href="{{ route('page.show', $page) }}" class="h-max text-xs text-white font-medium bg-primary rounded-full py-2 px-4">
                                        Manage
                                    </a>
                                @else
                                    @if ($page->isPageFollowed())
                                        <button 
                                            type="button" 
                                            class="unfollow-page h-max text-xs text-white font-medium bg-primary rounded-full py-2 px-4" 
                                            data-id="{{ $page->page_id }}"
                                        >Unfollow</button>
                                    @else
                                        <button 
                                            type="button" 
                                            class="follow-page h-max text-xs text-white font-medium bg-primary rounded-full py-2 px-4" 
                                            data-id="{{ $page->page_id }}"
                                        >Follow</button>
                                    @endif
                                @endif

                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="min-h-[calc(100vh-230px)] flex flex-col justify-center items-center">
                    <img 
                        src="{{ asset('images/page-empty.svg') }}" 
                        alt="snap empty" 
                        class="w-8 h-8 mb-2"
                    >
                    <p class="text-sm text-gray-400 font-medium">No page were found</p>
                </div>
            @endif

        </div>
    </div>
@endsection
