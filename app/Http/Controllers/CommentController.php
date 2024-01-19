<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Notifications\UserCommented;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'snap_id' => ['required'],
            'comment' => ['max:1000'],
        ]);

        $comment = $request->user()->comments()->create($validatedData);
        $snap = $comment->snap;

        $snap->snapable->notify(new UserCommented($snap, $request->user()));

        return response()->json([
            'type' => 'success',
            'message' => 'Comment was posted'
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $comment = Comment::find($id);

        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Comment was deleted'
        ]);
    }
}
