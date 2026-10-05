<?php

namespace App\Http\Controllers;

use App\Enums\OrgUnitType;
use App\Models\Affiliation;
use App\Models\HeroSlide;
use App\Models\News;
use App\Models\Office;
use App\Models\OrgUnit;
use App\Models\SecretaryGeneralMessage;
use App\Models\Zone;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::active()
            ->orderBy('order')
            ->get();

        $featuredNews = News::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $zonesCount = Zone::count();

        $regionalOfficesCount = Office::where('type', 'regional')->count();

        $subOfficesCount = Office::where('type', 'sub')->count();

        $featuredSecretaryGeneralMessage = SecretaryGeneralMessage::with('leader')
            ->where('is_published', true)
            ->where('is_featured', true)
            ->first();

        $sectors = OrgUnit::where('type', OrgUnitType::Sector)
            ->orderBy('order')
            ->get();

        $affiliations = Affiliation::orderByRaw("CASE WHEN scope = 'national' THEN 0 ELSE 1 END")
            ->orderBy('order')
            ->get();

        return view('home', [
            'slides' => $slides,
            'featuredNews' => $featuredNews,
            'zonesCount' => $zonesCount,
            'regionalOfficesCount' => $regionalOfficesCount,
            'subOfficesCount' => $subOfficesCount,
            'featuredSecretaryGeneralMessage' => $featuredSecretaryGeneralMessage,
            'sectors' => $sectors,
            'affiliations' => $affiliations,
        ]);
    }
}
