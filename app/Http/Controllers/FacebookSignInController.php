<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookSignInController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $facebookUser = Socialite::driver('facebook')->user();
        $existingUser = User::where('facebook_id', $facebookUser->getId())->first();

        if ($existingUser) {
            Auth::login($existingUser);
            return redirect()->intended('feed');
        }
        
        $createdUser = User::create([
            'fullname' => $facebookUser->getName(),
            'username' => $facebookUser->getName(),
            'email'=> $facebookUser->getEmail(),
            'facebook_id' => $facebookUser->getId()
        ]);

        Auth::login($createdUser);
        return redirect()->intended('feed');
    }
}
