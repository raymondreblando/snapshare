<aside class="fixed top-[84px] left-0 min-h-[calc(100vh-84px)] flex flex-col bg-white border-r border-r-gray-200/80 py-8 z-20">
    <ul class="fixed xl:static bottom-0 inset-x-0 flex flex-row xl:flex-col justify-around md:justify-center xl:justify-normal bg-white border-t xl:border-t-0 border-t-gray-100 gap-12 xl:gap-0 px-12 xl:px-0 py-2 xl:py-0">
        <li>
            <a href="{{ route('feed') }}" class="group/link sidebar-link @active(['feed', 'snap.create', 'snap.show', 'snap.edit'])">
                <img src="{{ asset('images/snap.svg') }}" alt="snap feed" class="block group-[.active]/link:hidden w-6 h-6">
                <img src="{{ asset('images/snap-active.svg') }}" alt="snap feed" class="hidden group-[.active]/link:block w-6 h-6">
                <p>Snaps</p>
            </a>
        </li>
        <li>
            <a href="{{ route('page.index') }}" class="group/link sidebar-link @active(['page.index', 'page.show', 'page.create', 'page.edit'])">
                <img src="{{ asset('images/page.svg') }}" alt="page" class="block group-[.active]/link:hidden w-6 h-6">
                <img src="{{ asset('images/page-active.svg') }}" alt="page" class="hidden group-[.active]/link:block w-6 h-6">
                <p>Pages</p>
            </a>
        </li>
        <li>
            <a href="{{ route('peoples') }}" class="group/link sidebar-link @active(['peoples'])">
                <img src="{{ asset('images/user.svg') }}" alt="user" class="block group-[.active]/link:hidden w-6 h-6">
                <img src="{{ asset('images/user-active.svg') }}" alt="user" class="hidden group-[.active]/link:block w-6 h-6">
                <p>Peoples</p>
            </a>
        </li>
        <li>
            <a href="{{ route('followers') }}" class="group/link sidebar-link @active(['followers'])">
                <img src="{{ asset('images/user-add.svg') }}" alt="followers" class="block group-[.active]/link:hidden w-6 h-6">
                <img src="{{ asset('images/user-add-active.svg') }}" alt="followers" class="hidden group-[.active]/link:block w-6 h-6">
                <p>Followers</p>
                @if ($userTotalFollowers > 0)
                    <span class="hidden md:block w-6 h-6 text-[10px] text-white text-center font-semibold leading-6 bg-primary rounded-full">
                        {{ $userTotalFollowers }}
                    </span>
                @endif
            </a>
        </li>
    </ul>

    <ul class="hidden xl:block mt-8">
        <p class="text-sm text-gray-400 font-semibold ml-12 mb-4">Discover</p>

        <li>
            <a href="{{ route('trending') }}" class="group/link sidebar-link @active(['trending'])">
                <i class="ri-fire-line text-2xl block group-[.active]/link:hidden"></i>
                <i class="ri-fire-fill text-2xl text-primary hidden group-[.active]/link:block"></i>
                Trending Snaps
                {{-- <span class="w-6 h-6 text-[10px] text-white text-center font-semibold leading-6 bg-primary rounded-full">99</span> --}}
            </a>
        </li>
        <li>
            <a href="{{ route('peoples.popular') }}" class="group/link sidebar-link @active(['peoples.popular'])">
                <img src="{{ asset('images/people.svg') }}" alt="popular peoples" class="block group-[.active]/link:hidden w-6 h-6">
                <img src="{{ asset('images/people-active.svg') }}" alt="popular peoples" class="hidden group-[.active]/link:block w-6 h-6">
                Popular Peoples 
            </a>
        </li>
        <li>
            <a href="{{ route('page.top') }}" class="group/link sidebar-link @active(['page.top'])">
                <img src="{{ asset('images/page.svg') }}" alt="page" class="block group-[.active]/link:hidden w-6 h-6">
                <img src="{{ asset('images/page-active.svg') }}" alt="page" class="hidden group-[.active]/link:block w-6 h-6">
                Top Pages
            </a>
        </li>
    </ul>
    
    <div class="hidden xl:block mt-auto px-6">
        <div class="flex justify-center items-center gap-4 mb-4">
            <a href="#" class="text-xs text-gray-400 font-medium">About</a>
            <a href="#" class="text-xs text-gray-400 font-medium">Terms</a>
            <a href="#" class="text-xs text-gray-400 font-medium">Policy</a>
        </div>
        <p class="text-xs text-gray-400 text-center font-medium">© SnapShare 2023</p>
    </div>
</aside>