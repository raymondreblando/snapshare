<?php

namespace App\Http\Controllers;

use App\Models\Snap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function snap(Snap $snap, string $notificationId): View
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        return view('default.snap.show', compact('snap'));
    }

    public function followed(User $user, string $notificationId): View
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        $snaps = $user->snaps()->with('snapable')->latest()->get();
        $followers = $user->followers()->get();
        $followings = $user->following()->get();

        return view('default.profile', compact('user', 'snaps', 'followers', 'followings'));
    }
}
