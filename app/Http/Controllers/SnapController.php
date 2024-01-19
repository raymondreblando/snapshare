<?php

namespace App\Http\Controllers;

use App\Http\Requests\SnapRequest;
use App\Http\Requests\UpdateSnapRequest;
use App\Models\Snap;
use App\Services\SnapService;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SnapController extends Controller
{

    public function __construct(
      private UploadService $uploadService,
      private SnapService $snapService,
    ){}

    public function create(): View
    {
        return view('default.snap.create');
    }

    public function store(SnapRequest $request): RedirectResponse
    {
        if ($request->has('page')) {
            return $this->snapService->createPageSnap($request);
        }

        return $this->snapService->createUserSnap($request);
    }

    public function show(Snap $snap): View
    {
        return view('default.snap.show', compact('snap'));
    }


    public function edit(Snap $snap): View
    {
        $this->authorize('update', $snap);

        return view('default.snap.edit', compact('snap'));
    }

    public function update(UpdateSnapRequest $request, Snap $snap)
    {
        $snapData = $request->validated();

        $this->authorize('update', $snap);

        $snap->update($snapData);
        $this->uploadService->upload($request, $snap->snap_id);

        return redirect()->route('snap.edit', ['snap' => $snap])
                ->with('success', 'Your snap was successfully updated');
    }

    public function destroy(string $id): JsonResponse
    {
        $snap = Snap::find($id);

        if (! $snap) {
            abort(404);
        }

        $this->authorize('delete', $snap);

        $snap->delete();
        $this->uploadService->delete([$snap->snap_image], ['snaps']);

        return response()->json([
            'message' => 'Snap was deleted'
        ]);
    }
}
