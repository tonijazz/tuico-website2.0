<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProgrammeStatus: string implements HasLabel, HasColor
{
    case Active = 'active';
    case Past = 'past';

    public function getLabel(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Past => 'Past',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Past => 'gray',
        };
    }
}
