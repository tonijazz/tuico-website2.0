<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LeaderLevel: string implements HasLabel
{
    //
    case National = 'national';
    case Zonal = 'zonal';
    case Regional = 'regional';
    case Sub = 'sub';

    public function getLabel(): string
    {
        return match ($this) {
            self::National => 'National',
            self::Zonal => 'Zonal',
            self::Regional => 'Regional',
            self::Sub => 'Sub',
        };
    }


}
