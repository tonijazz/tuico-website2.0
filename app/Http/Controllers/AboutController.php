<?php

namespace App\Http\Controllers;

use App\Models\GovernanceLevel;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'about-us')
            ->where('locale', app()->getLocale())
            ->first();

        $governanceLevels = GovernanceLevel::with('meetings')->orderBy('order')->get();

        return view('about.index', [
            'page' => $page,
            'governanceLevels' => $governanceLevels,
        ]);
    }
}
