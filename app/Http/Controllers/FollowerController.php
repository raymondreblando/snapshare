<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use App\Notifications\UserFollowed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FollowerController extends Controller
{
    public function index(): View
    {
        $followers = Auth::user()->followers()->with('userFollower.avatar')->latest()->get();
        return view('default.followers', compact('followers'));
    }

    public function store(Request $request): JsonResponse
    {
        $followedId = $request->input('followed_id');
        $user = User::findOrFail($followedId);

        $request->user()->following()->create([
            'followed_user_id' => $followedId,
        ]);
        
        $user->notify(new UserFollowed($request->user()));

        return response()->json([
            'message' => 'Followed'
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $follower = Follower::where('followed_user_id', $id)
                            ->where('request_user_id', Auth::user()->user_id)
                            ->first();

        $this->authorize('delete', $follower);

        $follower->delete();

        return response()->json([
            'message' => 'Unfollowed'
        ]);
    }
}
