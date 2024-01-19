<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageSnapController extends Controller
{
    public function __invoke(Request $request, string $pageId): View
    {
        return view('default.snap.create', compact('pageId'));
    }
}
