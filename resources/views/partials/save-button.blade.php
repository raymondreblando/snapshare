<button 
    type="button" 
    @class([
        'group/save',
        'save-snap' =>  ! $snap->isSave(),
        'unsave-snap' =>  $snap->isSave(),
        'flex',
        'items-center',
        'text-sm',
        'text-gray-400',
        'gap-2',
    ]);
    data-id="{{ $snap->snap_id }}"
    title="Unsave snap"
>
    <img 
        src="{{ asset('images/save.svg') }}" 
        alt="save snap" 
        class="hidden group-[.save-snap]/save:block w-5 h-5"
    >
    <img 
        src="{{ asset('images/unsave.svg') }}" 
        alt="unsave snap" 
        class="hidden group-[.unsave-snap]/save:block w-5 h-5"
    >
</button>