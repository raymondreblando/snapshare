@use('App\Helpers\StringFormatter')
@use('Illuminate\Support\Number')

@php
    $userFollowingFollowerCount = Number::abbreviate(count($user->followers));
@endphp

<div class="flex flex-wrap justify-between items-center border-b last:border-b-0 border-b-gray-200/80 gap-3 py-4">
    <div class="flex items-center gap-3">
        @if ($user->has_profile)
            <img src="{{ asset('storage/profiles/' . $user->avatar->avatar) }}"
                alt="profile" class="w-12 h-12 rounded-full object-cover">
        @else
            <div
                class="w-12 h-12 grid place-content-center text-white font-bold bg-primary rounded-full">
                {{ StringFormatter::abbreviate($user->fullname) }}
            </div>
        @endif
        <div>
            <a href="{{ route('people.show', $user) }}"
                class="text-black font-semibold">
                {{ $user->fullname }}
            </a>
            <p class="text-xs text-gray-400 font-medium">
                {{ StringFormatter::username($user->username) }} - <span
                    class="text-primary font-semibold">{{ $userFollowingFollowerCount }}
                    Followers</span>
            </p>
        </div>
    </div>
    <div class="flex gap-2">
        @if ($user->isFollowed())
            @include('partials.unfollow-user-button', ['userId' => $user->user_id])
        @else
            @include('partials.follow-user-button', ['userId' => $user->user_id])
        @endif
    </div>
</div>