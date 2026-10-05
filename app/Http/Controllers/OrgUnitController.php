<?php

namespace App\Http\Controllers;

use App\Enums\OrgUnitType;
use App\Models\OrgUnit;
use Illuminate\Support\Str;

class OrgUnitController extends Controller
{
    public function sectors()
    {
        $sectors = OrgUnit::where('type', OrgUnitType::Sector)
            ->orderBy('order')
            ->get();

        return view('organization.sectors.index', [
            'sectors' => $sectors,
        ]);
    }

    public function showSector(string $slug)
    {
        $sector = OrgUnit::where('type', OrgUnitType::Sector)
            ->with('leader')
            ->get()
            ->first(function ($sector) use ($slug) {
                return Str::slug(
                    $sector->getTranslation('name', 'en')
                ) === $slug;
            });

        abort_unless($sector, 404);

        return view('organization.sectors.show', [
            'sector' => $sector,
        ]);
    }

    public function departments()
    {
        $departments = OrgUnit::where('type', OrgUnitType::Department)
            ->orderBy('order')
            ->get();

        return view('organization.departments.index', [
            'departments' => $departments,
        ]);
    }

    public function showDepartment(string $slug)
    {
        $department = OrgUnit::where('type', OrgUnitType::Department)
            ->with('leader')
            ->get()
            ->first(function ($department) use ($slug) {
                return Str::slug(
                    $department->getTranslation('name', 'en')
                ) === $slug;
            });

        abort_unless($department, 404);

        return view('organization.departments.show', [
            'department' => $department,
        ]);
    }

    public function units()
    {
        $units = OrgUnit::where('type', OrgUnitType::Unit)
            ->orderBy('order')
            ->get();

        return view('organization.units.index', [
            'units' => $units,
        ]);
    }

    public function showUnit(string $slug)
    {
        $unit = OrgUnit::where('type', OrgUnitType::Unit)
            ->with('leader')
            ->get()
            ->first(function ($unit) use ($slug) {
                return Str::slug(
                    $unit->getTranslation('name', 'en')
                ) === $slug;
            });

        abort_unless($unit, 404);

        return view('organization.units.show', [
            'unit' => $unit,
        ]);
    }
}
