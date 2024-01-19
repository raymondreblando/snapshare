<?php

namespace App\Http\Controllers;

use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoverPhotoController extends Controller
{
    public function __invoke(Request $request, UploadService $uploadService): JsonResponse
    {
        $filenames = $uploadService->upload($request, auth()->user()->user_id);

        $request->user()->coverPhoto()->create([
            'cover_photo' => $filenames[0],
        ]);

        $request->user()->update([
            'has_cover_photo' => true
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'Cover photo was uploaded',
        ], 200);
    }
}
