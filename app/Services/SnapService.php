<?php

namespace App\Services;
use App\Http\Requests\SnapRequest;
use App\Models\Page;
use App\Models\Snap;
use Illuminate\Http\RedirectResponse;

class SnapService
{
    public function __construct(
        private UploadService $uploadService
    ){}

    public function createPageSnap(SnapRequest $request): RedirectResponse
    {
        $snapData = $request->validated();

        $page = Page::findOrFail($request->page);
        $createdSnap = $page->snaps()->create($snapData);

        return $this->handleSnapUpload($request, $createdSnap);
    }

    public function createUserSnap(SnapRequest $request): RedirectResponse
    {
        $snapData = $request->validated();
        $createdSnap = $request->user()->snaps()->create($snapData);

        return $this->handleSnapUpload($request, $createdSnap);
    }

    protected function handleSnapUpload(SnapRequest $request, Snap $createdSnap): RedirectResponse 
    {
        $filenames = $this->uploadService->upload($request, $createdSnap->snap_id);

        $createdSnap->update([
            'snap_image' => $filenames[0]
        ]);

        return redirect()->route('snap.create')
            ->with('success', 'Your snap was successfully created');
    }
}