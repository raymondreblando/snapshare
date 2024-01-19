<div class="bg-white rounded-lg border border-gray-200/80 p-6">
    <p class="text-sm text-light-dark font-semibold mb-4">
        Account Security
    </p>

    <form 
        method="POST"
        action="{{ route('account.change.password', $user) }}"
        autocomplete="off"
    >
        @csrf
        @method('put')
        <input 
            type="password" 
            name="current_password" 
            class="h-12 text-sm font-medium border border-gray-200/80 rounded-lg mb-4" 
            placeholder="Enter current password"
            value="{{ old('current_password') }}"
        >
        <input 
            type="password" 
            name="new_password" 
            class="h-12 text-sm font-medium border border-gray-200/80 rounded-lg mb-4" 
            placeholder="Enter new password"
            value="{{ old('new_password') }}"
        >
        <input 
            type="password" 
            name="new_password_confirmation" 
            class="h-12 text-sm font-medium border border-gray-200/80 rounded-lg mb-4" 
            placeholder="Confirm password"
            value="{{ old('new_password_confirmation') }}"
        >
        <button type="submit" class="w-full h-12 text-white bg-primary rounded-lg">
            Change password
        </button>
    </form>
</div>