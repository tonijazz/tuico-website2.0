<?php

namespace App\Http\Controllers;

use App\Models\GovernanceLevel;
use App\Models\Office;
use App\Models\Page;
use App\Models\StrategicArea;
use App\Models\Zone;
use App\Settings\SiteSettings;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'about-us')
            ->where('locale', app()->getLocale())
            ->first();

        $strategicAreas = StrategicArea::orderBy('order')->get();

        $governanceLevels = GovernanceLevel::with('meetings')
            ->orderBy('order')
            ->get();

        $zonesCount = Zone::count();

        $regionalOfficesCount = Office::where('type', 'regional')->count();

        $subOfficesCount = Office::where('type', 'sub')->count();

        $siteSettings = app(SiteSettings::class);

        return view('about.index', [
            'page' => $page,
            'strategicAreas' => $strategicAreas,
            'governanceLevels' => $governanceLevels,
            'zonesCount' => $zonesCount,
            'regionalOfficesCount' => $regionalOfficesCount,
            'subOfficesCount' => $subOfficesCount,
            'siteSettings' => $siteSettings,
        ]);
    }
}
