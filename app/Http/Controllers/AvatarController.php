<?php

namespace App\Http\Controllers;

use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function __invoke(Request $request, UploadService $uploadService): JsonResponse
    {
        $filenames = $uploadService->upload($request, auth()->user()->user_id, 'profile');

        $request->user()->avatar()->create([
            'avatar' => $filenames[0],
        ]);

        $request->user()->update([
            'has_profile' => true
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'Profile was uploaded',
        ], 200);
    }
}
