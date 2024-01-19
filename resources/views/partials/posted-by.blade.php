@use('App\Helpers\DateFormatter')
@use('App\Helpers\StringFormatter')

<div class="flex gap-4">
    @if ($snap->snapable_type === 'App\Models\User' && $snapable->has_profile)
        <img 
            src="{{ asset('storage/profiles/' . $snapable->avatar->avatar) }}" 
            alt="profile" 
            class="w-10 h-10 rounded-full object-cover"
        >
    @elseif ($snap->snapable_type === 'App\Models\User' && ! $snapable->has_profile)
        <div class="w-10 h-10 grid place-content-center text-white font-bold bg-primary rounded-full">
            {{ StringFormatter::abbreviate($snapable->fullname) }}
        </div>
    @else
        <img 
            src="{{ asset('storage/page_profiles/' . $snapable->page_profile) }}" 
            alt="profile" 
            class="w-10 h-10 rounded-full object-cover"
        >
    @endif
    <div>
        <a href="{{ route('people.show', $snap->snapable) }}" class="finder1 text-sm sm:text-base text-black font-semibold">
            @if ($snap->snapable_type === 'App\Models\User')
                {{ $snapable->fullname }}
            @else
                {{ $snapable->page_name }}
            @endif
        </a>
        <p class="text-[10px] sm:text-xs text-gray-400">
            {{ DateFormatter::formatElapseTime($snap->created_at) }}
        </p>
    </div>
</div>