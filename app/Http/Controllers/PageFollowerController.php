<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageFollowerController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $pageId = $request->input('page_id');
        $page = Page::findOrFail($pageId);

        $page->pageFollowers()->create([
            'user_id' => $request->user()->user_id,
        ]);

        return response()->json([
            'message' => 'Page Followed',
        ], 200);
    }

    public function destroy(string $pageId): JsonResponse
    {
        $page = Page::findOrFail($pageId);
        $page->pageFollowers()  
            ->where('user_id', Auth::user()->user_id)
            ->delete();

        return response()->json([
            'message' => 'Page Unfollowed',
        ], 200);
    }
}
