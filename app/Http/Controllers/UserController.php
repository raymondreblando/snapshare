<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{

    public function __construct(
      private UploadService $uploadService
    ){}

    public function index(): View
    {
        $userId = Auth::user()->user_id;
        $users = User::whereNot('user_id', $userId)
                    ->where('is_active', 1)
                    ->latest()
                    ->get();

        return view('default.peoples', compact('users'));
    }

    public function show(User $user): View
    {
        $snaps = $user->snaps()->with('snapable')->latest()->get();
        $followers = $user->followers()->get();
        $followings = $user->following()->get();
        
        return view('default.profile', compact('user', 'snaps', 'followers', 'followings'));
    }

    public function popular(): View
    {
        $users = User::withCount('followers')->having('followers_count', '>', 100)->get();
        return view('default.peoples', compact('users'));
    }

    public function myProfile(): View
    {
        $user = Auth::user();
        $snaps = Auth::user()->snaps()->with('snapable')->latest()->get();
        $followers = Auth::user()->followers()->with('userFollower')->get();
        $followings = Auth::user()->following()->with('userFollowing')->get();

        return view('default.profile', compact('user', 'snaps', 'followers', 'followings'));
    }
}
