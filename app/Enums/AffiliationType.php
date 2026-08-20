<?php

namespace App\Enums;

enum AffiliationType: string implements \Filament\Support\Contracts\HasLabel
{
    case Partnership = 'partnership';
    case Affiliation = 'affiliation';

    public function getLabel(): string
    {
        return match ($this) {
            self::Partnership => 'Partnership',
            self::Affiliation => 'Affiliation',
        };
    }
}
