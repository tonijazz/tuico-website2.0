<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('locale', app()->getLocale())
            ->firstOrFail();

        return view('pages.show', ['page' => $page]);
    }
}
