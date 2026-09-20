<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;

class AffiliationController extends Controller
{
    public function index()
    {
        $national = Affiliation::where('scope', 'national')->orderBy('order')->get();
        $international = Affiliation::where('scope', 'international')->orderBy('order')->get();

        return view('affiliations.index', [
            'national' => $national,
            'international' => $international,
        ]);
    }
}
