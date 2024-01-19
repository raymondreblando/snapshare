@use('App\Helpers\StringFormatter')

<header class="fixed top-0 inset-x-0 flex justify-between items-center bg-white border-b border-gray-100 px-4 sm:px-12 py-4 z-30">
    <div>
        <p class="text-xl text-black font-medium uppercase">
            <span class="text-primary font-bold">Snap</span>Share
        </p>
    </div>

    <div class="w-[500px] hidden lg:flex items-center bg-neutral-100 rounded-full gap-3 px-6 py-4">
        <input 
            type="text" 
            class="search-input w-full text-sm font-medium bg-neutral-100 p-0" 
            placeholder="Search"
            autocomplete="off"
        >
        <img 
            src="{{ asset('images/search.svg') }}" 
            alt="search" 
            class="w-4 h-4"
        >
    </div>

    <div class="flex items-center gap-4">
        <div class="relative flex justify-center items-center">
            <div class="show-notification w-10 h-10 grid place-content-center border border-gray-100 rounded-full">
                <button type="button" class="relative">
                    <img 
                        src="{{ asset('images/notification.svg') }}" 
                        alt="notification" 
                        class="w-5 h-5"
                    >
                    @if (count($user->unreadNotifications) > 0)
                        <span class="absolute top-[2px] right-[2px] w-[10px] h-[10px] bg-primary border border-white rounded-full"></span>  
                        <span class="animate-ping absolute top-[2px] right-[2px] w-[10px] h-[10px] bg-primary border border-white rounded-full"></span>  
                    @endif
                </button>
            </div>
        </div>

        @if (in_array(Route::currentRouteName(), ['feed', 'my-profile']))
            <a href="{{ route('snap.create') }}" class="w-9 h-9 grid place-content-center text-white bg-primary rounded-full">
                <i class="ri-add-fill"></i>
            </a>
        @elseif (in_array(Route::currentRouteName(), ['page.show']))
            @can('update', $page)
                <a href="{{ route('snap.page', $page) }}" class="w-9 h-9 grid place-content-center text-white bg-primary rounded-full">
                    <i class="ri-add-fill"></i>
                </a>
            @endcan
        @elseif (in_array(Route::currentRouteName(), ['page.index']))
            <a href="{{ route('page.create') }}" class="w-9 h-9 grid place-content-center text-white bg-primary rounded-full">
                <i class="ri-add-fill"></i>
            </a>
        @endif

        <div class="relative">
            <div class="show-profile flex items-center gap-1" role="button">
                @if (Auth::user()->has_profile)
                    <img 
                        src="{{ asset('storage/profiles/' . Auth::user()->avatar->avatar) }}" 
                        alt="profile" 
                        class="w-9 h-9 rounded-full object-cover"
                    >
                @else
                    <div class="w-9 h-9 grid place-content-center text-white font-semibold bg-primary rounded-full">
                        {{ StringFormatter::abbreviate(Auth::user()->fullname) }}
                    </div>
                @endif
                <i class="ri-arrow-down-s-fill text-xl"></i>
            </div>

            <ul class="profile absolute top-[170%] right-0 hidden w-max bg-white rounded-md shadow-2xl px-1 py-2">
                <li>
                    <a href="{{ route('my-profile') }}" class="flex items-center text-sm text-light-dark font-medium hover:bg-neutral-100 gap-3 px-8 py-2">
                        <i class="ri-user-line"></i>
                        My Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('saves') }}" class="flex items-center text-sm text-light-dark font-medium hover:bg-neutral-100 gap-3 px-8 py-2">
                        <img src="{{ asset('images/snap.svg') }}" alt="save snap" class="w-4 h-4">
                        Save Snaps
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.setting') }}" class="flex items-center text-sm text-light-dark font-medium hover:bg-neutral-100 gap-3 px-8 py-2">
                        <i class="ri-settings-3-line"></i>
                        Account Settings
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center text-sm text-light-dark font-medium hover:bg-neutral-100 gap-3 px-8 py-2">
                        <i class="ri-logout-circle-r-line"></i>
                        Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>