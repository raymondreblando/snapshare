@use('App\Helpers\StringFormatter')
@use('App\Helpers\DateFormatter')
@use('Illuminate\Support\Number')

@extends('layouts.layout')
@section('title', 'SnapShare - Snap')

@section('render')
@include('partials.delete-snap-dialog')

    @php
        $reactCount = Number::abbreviate($snap->totalReacts());
        $commentCount = Number::abbreviate($snap->totalComments());
    @endphp

    <div class="flex flex-col items-center pt-[110px] pb-8">
        <div class="w-[min(700px,95%)]">
            @include('partials.snap-post', ['snap' => $snap])

            <div class="bg-white rounded-lg border border-gray-200/80 p-6 mt-4 mb-16">
                <p class="text-xs text-gray-400 font-semibold mb-4">Snap Comments</p>
                
                @if ($commentCount > 0)
                    @foreach ($snap->comments as $comment)
                        <div class="flex gap-3 py-2">

                            @if ($comment->user->has_profile)
                                <img 
                                    src="{{ asset('storage/profiles/' . $comment->user->avatar->avatar) }}" 
                                    alt="profile" 
                                    class="shrink-0 w-10 h-10 rounded-full object-cover mt-2"
                                >
                            @else
                                <div class="min-w-10 h-10 grid place-content-center text-white font-medium bg-primary rounded-full mt-2">
                                    {{ StringFormatter::abbreviate($comment->user->fullname) }}
                                </div>
                            @endif

                            <div class="w-max bg-neutral-100 rounded-lg px-6 py-4">
                                <p class="text-sm text-light-dark font-bold mb-1">
                                    {{ $comment->user->fullname }}
                                </p>
                                <p class="text-[13px] text-gray-500 font-medium mb-1">
                                    {{ $comment->comment }}
                                </p>

                                <div class="flex items-center gap-4">
                                    <p class="text-[11px] text-gray-400 font-medium">
                                        {{ DateFormatter::formatElapseTime($comment->created_at) }}
                                    </p>
                                    @can('delete', $comment)
                                        <button type="button" class="delete-comment text-[11px] text-gray-400 font-bold" data-id="{{ $comment->comment_id }}">Delete</button>
                                    @endcan
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-col justify-center items-center py-6">
                        <img src="{{ asset('images/comment.svg') }}" alt="comment" class="w-5 h-5 mb-1">
                        <p class="text-xs text-gray-400">No snap comments</p>
                    </div>
                @endif
                
            </div>
    
            @include('partials.comment-form', ['snap_id' => $snap->snap_id])
        </div>
    </div>
@endsection