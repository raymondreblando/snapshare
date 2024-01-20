<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleSignInController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();
        $existingUser = User::where('google_id', $googleUser->getId())->first();

        if ($existingUser) {
            Auth::login($existingUser);
            return redirect()->intended('feed');
        }
        
        $createdUser = User::create([
            'fullname' => $googleUser->getName(),
            'username' => explode('@', $googleUser->getName())[0],
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId()
        ]);

        Auth::login($createdUser);
        return redirect()->intended('feed');
    }
}
