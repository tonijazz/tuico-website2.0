<?php

namespace App\Http\Controllers;

use App\Enums\OrgUnitType;
use App\Models\GovernanceLevel;
use App\Models\Office;
use App\Models\OrgUnit;
use App\Models\Page;
use App\Models\Zone;
use App\Settings\SiteSettings;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'about-us')
            ->where('locale', app()->getLocale())
            ->first();

        $governanceLevels = GovernanceLevel::with('meetings')
            ->orderBy('order')
            ->get();

        $sectorsCount = OrgUnit::where('type', OrgUnitType::Sector)->count();

        $zonesCount = Zone::count();

        $regionalOfficesCount = Office::where('type', 'regional')->count();

        $subOfficesCount = Office::where('type', 'sub')->count();

        $siteSettings = app(SiteSettings::class);

        return view('about.index', [
            'page' => $page,
            'governanceLevels' => $governanceLevels,
            'sectorsCount' => $sectorsCount,
            'zonesCount' => $zonesCount,
            'regionalOfficesCount' => $regionalOfficesCount,
            'subOfficesCount' => $subOfficesCount,
            'siteSettings' => $siteSettings,
        ]);
    }
}
