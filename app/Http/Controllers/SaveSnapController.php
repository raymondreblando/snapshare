<?php

namespace App\Http\Controllers;

use App\Models\SaveSnap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SaveSnapController extends Controller
{
    public function index(): View
    {
        $saves = Auth::user()->saves()->with(['snap.snapable'])->get();
        return view('default.save-snaps', compact('saves'));
    }

    public function store(Request $request): JsonResponse
    {
        $snapId = $request->input('snap_id');
        $request->user()->saves()->create([
            'snap_id' => $snapId,
        ]);

        return response()->json([
            'message' => 'Snap was saved'
        ], 200);
    }

    public function destroy(Request $request, string $snapId): JsonResponse
    {
        $request->user()->saves()
                ->where('snap_id', $snapId)
                ->delete();

        return response()->json([
            'message' => 'Snap was removed from saved'
        ], 200);
    }
}
