<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use App\Models\OrgUnit;

class LeaderController extends Controller
{
    public function index()
    {
        $nationalExecutives = Leader::where('level', 'national')
            ->where('role_type', '!=', 'unit_head')
            ->get();

        $orgUnits = OrgUnit::with('leader')->orderBy('order')->get();

        return view('leadership.index', [
            'nationalExecutives' => $nationalExecutives,
            'orgUnits' => $orgUnits,
        ]);
    }
}
