<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountSettingController extends Controller
{
    public function index(): View
    {
        return view('default.settings');
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();

        $user->update($validatedData);

        return redirect()->route('account.setting')
            ->with('success', 'Account information was updated');
    }

    public function changeAccountStatus(User $user): RedirectResponse
    {
        $user->update([
            'is_active' => $user->is_active ? 0 : 1,
        ]);

        return redirect()->route('account.setting')
            ->with('success', 'Account status was changed');
    }

    public function changePassword(ChangePasswordRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $user->updateOrFail([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('account.setting')
            ->with('success', 'Account password changed successfully');
    }
}
