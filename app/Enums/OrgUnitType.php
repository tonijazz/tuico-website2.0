<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OrgUnitType: string implements HasLabel
{

    case Sector = 'sector';
    case Department = 'department';
    case Unit = 'unit';

    public function getLabel(): string
    {
        return match ($this) {
            self::Sector => 'Sector',
            self::Department => 'Department',
            self::Unit => 'Unit',
        };
    }
}
