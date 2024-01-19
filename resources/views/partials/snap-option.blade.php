<div class="relative z-[2]">
    <button type="button" class="show-snap-option w-10 h-10 grid place-content-center border-0 hover:border border-gray-200 hover:bg-neutral-100 rounded-full transition-all duration-200">
        <i class="ri-more-2-fill"></i>
    </button>

    <ul class="snap-options absolute top-full right-0 w-max hidden bg-white rounded-md shadow-2xl py-1">
        <li>
            <a href="{{ route('snap.edit', $snap) }}" class="block h-max text-xs text-gray-400 font-medium hover:bg-neutral-100 transition-all duration-200 py-2 px-6">
                Update Snap
            </a>
        </li>
        <li>
            <button 
                type="button" 
                class="delete-snap block w-full h-max text-xs text-gray-400 font-medium hover:bg-neutral-100 transition-all duration-200 py-2 px-6" 
                data-id="{{ $snap->snap_id }}"
            >
                Delete Snap
            </button>
        </li>
    </ul>
</div>