<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Models\StrategicArea;

class ProgrammeController extends Controller
{
    public function index()
    {
        $strategicAreas = StrategicArea::orderBy('order')
            ->paginate(6, ['*'], 'strategic_page')
            ->withQueryString();

        $activeProgrammes = Programme::active()
            ->with('affiliation')
            ->latest('starts_at')
            ->paginate(6, ['*'], 'active_page')
            ->withQueryString();

        $pastProgrammes = Programme::past()
            ->with('affiliation')
            ->latest('ends_at')
            ->paginate(6, ['*'], 'past_page')
            ->withQueryString();

        return view('programmes.index', [
            'strategicAreas' => $strategicAreas,
            'activeProgrammes' => $activeProgrammes,
            'pastProgrammes' => $pastProgrammes,
        ]);
    }

    public function strategicArea(StrategicArea $strategicArea)
    {
        return view('programmes.strategic-area', [
            'strategicArea' => $strategicArea,
        ]);
    }

    public function programme(Programme $programme)
    {
        $programme->load('affiliation');

        return view('programmes.programme', [
            'programme' => $programme,
        ]);
    }
}
