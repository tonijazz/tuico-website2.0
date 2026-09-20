<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Zone;

class OfficeController extends Controller
{


    public function regions()
{
    $regions = Office::where('type', 'regional')->with('subOffices')->orderBy('name')->get();

    return view('regions.index', ['regions' => $regions]);
}

    public function showRegion(string $slug)
    {
        $region = Office::where('type', 'regional')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('regions.show', ['region' => $region]);
    }

    public function zones()
    {
        $zones = Zone::with('offices')->orderBy('order')->get();

        return view('zones.index', ['zones' => $zones]);
    }

    public function showZone(string $slug)
    {
        $zone = Zone::where('slug', $slug)->firstOrFail();

        return view('zones.show', ['zone' => $zone]);
    }
}
