<div class="bg-white rounded-lg border border-gray-200/80 p-6">
    <div class="flex flex-wrap justify-between items-center gap-3 py-2">
        <div>
            <p class="text-sm text-red-600 font-semibold">
                Deactivate Account
            </p>
            <p class="text-xs text-gray-400 font-medium">
                Deactivated account will not be visible from other users.
            </p>
        </div>
        <form 
            method="POST"
            action="{{ route('account.change.status', $user) }}"
            class="flex gap-2"
        >
            @csrf
            @method('put')
            <button type="submit" class="h-max text-xs text-red-600 font-medium border border-red-600 rounded-full py-2 px-4">
                Deactivate
            </button>
        </div>
    </div>
</div>