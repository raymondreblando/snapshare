<button 
    type="button" 
    class="group heart @if ($snap->hasUserReact()) active @endif" 
    data-id="{{ $snap->snap_id }}"
    title="Heart this snap"
>
    <i class="ri-heart-3-line block group-[.active]:hidden text-2xl"></i>
    <i class="ri-heart-3-fill hidden group-[.active]:block text-2xl text-primary"></i>
    <p class="count group-[.active]:text-primary group-[.active]:font-semibold">
        {{ $reactCount }}
    </p>
</button>