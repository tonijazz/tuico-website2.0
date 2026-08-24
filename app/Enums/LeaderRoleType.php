<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LeaderRoleType: string implements HasLabel
{
    //
    case Chairperson = 'chairperson';
    case Secretary = 'secretary';
    case UnitHead = 'unit_head';

    public function getLabel(): string
    {
        return match ($this) {
            self::Chairperson => 'Chairperson',
            self::Secretary => 'Secretary',
            self::UnitHead => 'Unit Head',
        };
    }
}
