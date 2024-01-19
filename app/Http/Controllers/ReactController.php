<?php

namespace App\Http\Controllers;

use App\Models\React;
use App\Models\Snap;
use App\Notifications\UserReacted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactController extends Controller
{
    public function store(Request $request): void
    {
        $snapId = $request->input('snap_id');

        $snap = Snap::findOrFail($snapId);

        $request->user()->reacts()->create([
            'snap_id' => $snap->snap_id,
        ]);

        $snap->snapable->notify(new UserReacted($snap, $request->user()));
    }

    public function destroy(string $id): void
    {
        $react = React::where('snap_id', $id)->where('user_id', Auth::user()->user_id);
        $react->delete();
    }
}
