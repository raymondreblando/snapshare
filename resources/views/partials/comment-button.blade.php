<a href="{{ route('snap.show', $snap) }}" class="flex items-center text-[15px] text-gray-400 font-medium gap-2">
    <img 
        src="{{ asset('images/comment.svg') }}" 
        alt="comment" 
        class="w-5 h-5"
    >
    <p class="count">
        @if ($commentCount > 0) {{ $commentCount }} @endif Comments
    </p>
</a>