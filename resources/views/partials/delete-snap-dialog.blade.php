<div id="delete-snap-dialog" class="fixed inset-0 hidden flex justify-center items-center bg-black/80 z-30">
    <div class="w-[min(350px,90%)] bg-white rounded-lg p-6">
        <p class="text-black font-bold mb-4">Delete Snap</p>
        <p class="text-sm text-light-dark font-semibold mb-1">Do you really want to delete this snap post?</p>
        <p class="text-xs text-red-600 font-semibold mb-6">This action cannot be undone</p>
        <form id="delete-snap-form" class="mb-0">
            @csrf
            @method('delete')
            <div class="flex gap-2">
                <button type="submit" id="confirm-delete-snap" class="confirm-btn w-full text-sm text-white font-medium bg-primary rounded-md py-2 px-4">Confirm</button>
                <button 
                    type="button" 
                    class="close-dialog w-full text-sm text-black font-semibold bg-neutral-200 rounded-md py-2 px-4" 
                    data-target="#delete-snap-dialog"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>