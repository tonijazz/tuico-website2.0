<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use App\Models\OrgUnit;

class LeaderController extends Controller
{
    public function index()
    {
        $nationalExecutives = Leader::where('level', 'national')
            ->whereIn('role_type', ['chairperson', 'secretary'])
            ->orderBy('order')
            ->get();

        $sectors = OrgUnit::where('type', 'sector')
            ->with('leader')
            ->orderBy('order')
            ->get();

        $departments = OrgUnit::where('type', 'department')
            ->with('leader')
            ->orderBy('order')
            ->get();

        $units = OrgUnit::where('type', 'unit')
            ->with('leader')
            ->orderBy('order')
            ->get();

        return view('leadership.index', [
            'nationalExecutives' => $nationalExecutives,
            'sectors' => $sectors,
            'departments' => $departments,
            'units' => $units,
        ]);
    }
}
