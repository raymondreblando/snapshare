@extends('layouts.layout')

@section('title', 'SnapShare - Account Settings')

@section('render')
    <div class="flex flex-col items-center gap-4 pt-[110px] pb-8">
        @php
            $user = auth()->user();
        @endphp

        <div class="w-[min(700px,95%)] flex flex-col gap-4">
            @include('partials.error')
            @include('partials.success')
            @include('partials.account-details', ['user' => $user])

            @unless (!empty($user->google_id) || !empty($user->facebook_id))
                @include('partials.account-security', ['user' => $user])
            @endunless

            @include('partials.account-deactivate', ['user' => $user])
        </div>
    </div>
@endsection
