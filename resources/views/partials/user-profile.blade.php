@use('App\Helpers\StringFormatter')

<div class="bg-white rounded-lg border border-gray-200/80 overflow-hidden">
    <div class="relative h-[250px]">

        @if ($user->has_cover_photo)
            <img 
                data-src="{{ asset('storage/cover_photos/'. $user->coverPhoto->cover_photo) }}" 
                src="{{ asset('storage/cover_photos/' . 'optimize-' . $user->coverPhoto->cover_photo) }}" 
                alt="cover photo" 
                class="lazy w-full h-full object-cover"
            >
        @else
            <div class="w-full h-[250px] flex justify-center items-center text-xs text-gray-400 font-semibold bg-gray-200">
                Cover photo not available
            </div>
        @endif

        <form method="POST" id="cover-photo-form" enctype="multipart/form-data">
            <input type="file" name="cover_photo" id="cover-photo" hidden>
            <button type="submit" id="upload-cover-photo" hidden></button>
        </form>

        @if ($user === auth()->user())
            <button type="button" id="change-cover-photo" class="absolute bottom-3 left-1/2 -translate-x-1/2 text-xs text-gray-400 font-semibold bg-white rounded-full py-1 px-3">
                Change Cover Photo
            </button>
        @endif

    </div>
    <div class="p-6">
        <div class="flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="relative">

                    @if ($user->has_profile)
                        <img 
                            src="{{ asset('storage/profiles/' . $user->avatar->avatar) }}" 
                            alt="profile" 
                            class="w-16 h-16 rounded-full object-cover"
                        >
                    @else
                        <div class="w-16 h-16 grid place-content-center text-xl text-white font-bold bg-primary rounded-full">
                            {{ StringFormatter::abbreviate($user->fullname) }}
                        </div>
                    @endif

                    <form method="POST" id="profile-picture-form" enctype="multipart/form-data">
                        <input type="file" name="profile" id="profile-picture" hidden>
                        <button type="submit" id="upload-profile-picture" hidden></button>
                    </form>

                    @if ($user === auth()->user())
                        <button type="button" id="change-profile" class="absolute bottom-0 right-0 w-6 h-6 text-sm text-black font-medium bg-white rounded-full"><i class="ri-loop-left-line"></i></button>
                    @endif

                </div>
                <div>
                    <p class="text-black font-semibold">
                        {{ $user->fullname }}
                    </p>
                    <p class="text-xs text-gray-400 font-medium">
                        {{ StringFormatter::username($user->username) }}
                    </p>
                </div>
            </div>

            @if ($user !== auth()->user())
                <div class="flex gap-2">
                    @if ($user->isFollowed())
                        @include('partials.unfollow-user-button', ['userId' => $user->user_id])
                    @else
                        @include('partials.follow-user-button', ['userId' => $user->user_id])
                    @endif
                </div>
            @endif

        </div>
    </div>
    <div class="border-t border-gray-200 px-6">
        <button type="button" class="tab active">Snaps</button>
        <button type="button" class="tab">Followers</button>
        <button type="button" class="tab">Following</button>
    </div>
</div>