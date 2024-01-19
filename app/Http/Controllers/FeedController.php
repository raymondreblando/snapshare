<?php

namespace App\Http\Controllers;

use App\Models\Snap;
use Illuminate\View\View;

class FeedController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $followedUsers = $user->following()->pluck('followed_user_id');

        $followedSnaps = Snap::with(['snapable', 'comments'])
                            ->whereIn('snapable_id', $followedUsers)
                            ->where('snap_privacy', 'Public')
                            ->get();

        $userSnaps = $user->snaps()->with(['snapable', 'comments'])->get();

        $snaps = $followedSnaps->merge($userSnaps)->shuffle();
        
        return view('default.feed', compact('snaps'));
    }

    public function trending(): View
    {
        $snaps = Snap::trending()->get();

        return view('default.feed', compact('snaps'));
    }
}
