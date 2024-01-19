@use('App\Helpers\StringFormatter')

<div class="bg-white rounded-lg border border-gray-200/80">
    <div class="p-6">
        <div class="flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="relative">
                    @if ($user->has_profile)
                        <img 
                            src="{{ asset('storage/profiles/' . $user->avatar->avatar) }}" 
                            alt="profile" 
                            class="w-12 h-12 rounded-full object-cover"
                        >
                    @else
                        <div class="w-12 h-12 grid place-content-center text-xl text-white font-bold bg-primary rounded-full">
                            {{ StringFormatter::abbreviate($user->fullname) }}
                        </div>
                    @endif
                </div>
                <div>
                    <p class="text-black font-semibold">
                        {{ $user->fullname }}
                    </p>
                    <p class="text-xs text-gray-400 font-medium">
                        {{ '@' . $user->username }}
                    </p>
                </div>
            </div>
            <button 
                type="button" 
                id="edit-information" 
                class="w-10 h-10 grid place-content-center border border-gray-200 hover:bg-neutral-100 rounded-full transition-all duration-200"
            >
                <i class="ri-pencil-fill"></i>
            </button>
        </div>
    </div>
    <form 
        method="POST"
        action="{{ route('account.update', $user) }}"
        class="border-t border-gray-200 px-6 pt-3 pb-6" 
        autocomplete="off"
    >
        @csrf
        @method('put')
        <div class="flex justify-between items-center gap-4 mb-4">
            <p class="text-sm text-light-dark font-semibold">
                Account Information
            </p>
            <button 
                type="submit" 
                id="save-information" 
                class="hidden text-xs text-white font-medium bg-primary rounded-full py-2 px-4"
            >
                Save
            </button>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <input 
                type="text" 
                name="fullname" 
                class="disabled-input h-12 text-sm text-gray-400 font-medium border border-gray-200/80 rounded-lg disabled:cursor-not-allowed" 
                placeholder="Enter your fullname" 
                value="{{ $user->fullname }}"
                disabled
            >
            <input 
                type="text"
                name="username" 
                class="disabled-input h-12 text-sm text-gray-400 font-medium border border-gray-200/80 rounded-lg disabled:cursor-not-allowed" 
                placeholder="Enter username" 
                value="{{ $user->username }}"
                disabled
            >
            <input 
                type="text" 
                name="email" 
                class="disabled-input h-12 text-sm text-gray-400 font-medium border border-gray-200/80 rounded-lg disabled:cursor-not-allowed" 
                placeholder="Enter your email address" 
                value="{{ $user->email }}"
                disabled
            >
            <input 
                type="text" 
                name="phone_number" 
                class="disabled-input h-12 text-sm text-gray-400 font-medium border border-gray-200/80 rounded-lg disabled:cursor-not-allowed" 
                placeholder="Phone number (optional)" 
                value="{{ $user->phone_number }}"
                minlength="11"
                maxlength="11"
                disabled
            >
            <input 
                type="text" 
                name="address" 
                class="disabled-input md:col-span-2 h-12 text-sm text-gray-400 font-medium border border-gray-200/80 rounded-lg disabled:cursor-not-allowed" 
                placeholder="Enter address" 
                value="{{ $user->address }}"
                disabled
            >
        </div>
    </form>
</div>