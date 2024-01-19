<div id="delete-page-dialog" class="fixed inset-0 hidden flex justify-center items-center bg-black/80 z-30">
    <div class="w-[min(350px,90%)] bg-white rounded-lg p-6">
        <p class="text-black font-bold mb-4">Delete Page</p>
        <p class="text-sm text-light-dark font-semibold mb-1">Do you really want to delete your page?</p>
        <p class="text-xs text-red-600 font-semibold mb-6">All snaps of this page will be permanently deleted. This action cannot be undone</p>
        <form method="POST" id="delete-page-form">
            @csrf
            @method('delete')
            <div class="flex gap-2">
                <button type="submit" id="confirm-delete-page" class="confirm-btn w-full text-sm text-white font-medium bg-primary rounded-md py-2 px-4">Confirm</button>
                <button type="button" class="close-dialog w-full text-sm text-black font-semibold bg-neutral-200 rounded-md py-2 px-4" data-target="#delete-page-dialog">Cancel</button>
            </div>
        </form>
    </div>
</div>