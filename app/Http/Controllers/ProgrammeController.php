<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Models\StrategicArea;

class ProgrammeController extends Controller
{
    public function index()
    {
        $strategicAreas = StrategicArea::orderBy('order')->get();
        $activeProgrammes = Programme::active()->get();
        $pastProgrammes = Programme::past()->get();

        return view('programmes.index', [
            'strategicAreas' => $strategicAreas,
            'activeProgrammes' => $activeProgrammes,
            'pastProgrammes' => $pastProgrammes,
        ]);
    }
}
