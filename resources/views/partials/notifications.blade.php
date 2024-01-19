@use('App\Helpers\DateFormatter')

<div class="notification">
    <div class="flex justify-between items-center border-b border-b-gray-100 gap-4 pb-6 px-8">
        <p class="text-black font-semibold">Notifications</p>
        <button type="button" class="hide-notification block sm:hidden">
            <i class="ri-close-line"></i>
        </button>
    </div>
    <ul class="max-h-[calc(100vh-180px)] overflow-y-auto">
        @forelse ($user->notifications as $notification)
            <a 
                href="{{ $notification['data']['url'] }}"
                @class([
                    'notif', 
                    'unread' => empty($notification['read_at']),
                ])
            >
                <img src="{{ asset($notification['data']['icon']) }}" alt="{{ $notification['type'] }}" class="w-10 h-10">
                <div>
                    <p class="font-semibold">
                        {{ $notification['data']['message'] }}
                    </p>
                    <p class="text-[11px] text-gray-400 font-semibold">
                        {{ DateFormatter::formatElapseTime($notification['created_at']) }}
                    </p>
                </div>
            </a>
        @empty
            <div class="min-h-[calc(100vh-180px)] flex flex-col justify-center items-center">
                <p class="text-xs text-gray-400 font-semibold">No notifications yet.</p>
            </div>
        @endforelse
    </ul>
</div>