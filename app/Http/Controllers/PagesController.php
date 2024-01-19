<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function __construct(
        private UploadService $uploadService
    ){}

    public function index(): View
    {
        $pages = Page::all();
        return view('default.pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('default.pages.create');
    }

    public function store(StorePageRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $pageCreated = $request->user()->pages()->create([
            'page_name' => $validatedData['page_name']
        ]);

        $filenames = $this->uploadService->upload($request, $pageCreated->page_id);

        $pageCreated->update([
            'page_profile' => $filenames[0],
            'page_cover' => $filenames[1],
        ]);

        return redirect()->route('page.create')
            ->with('success', 'Page was created successfully');
    }

    public function show(Page $page): View
    {
        $snaps = $page->snaps()->with('comments')->get();
        $followers = $page->pageFollowers()->with('user')->get();
        return view('default.pages.show', compact('page', 'snaps', 'followers'));
    }

    public function edit(Page $page): View
    {
        return view('default.pages.edit', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $this->authorize('update', $page);

        $validatedData = $request->validated();

        $page->update([
            'page_name' => $validatedData['page_name'],
        ]);

        $this->uploadService->upload($request, $page->page_id);

        return redirect()->route('page.edit', $page)
            ->with('success', 'Page was updated successfully');
    }

    public function destroy(string $id): JsonResponse
    {
        $page = Page::find($id);

        if (! $page) {
            abort(404);
        }

        $this->authorize('delete', $page);

        $page->delete();
        
        $this->uploadService->delete(
            [$page->page_cover, $page->page_profile],
            ['page_covers', 'page_profiles']
        );

        return response()->json([
            'message' => 'Page was deleted'
        ], 200);
    }
}
