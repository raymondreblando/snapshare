<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class TopPageController extends Controller
{
    public function __invoke()
    {
        $pages = Page::popular()->get();
        return view('default.pages.index', compact('pages'));
    }
}
