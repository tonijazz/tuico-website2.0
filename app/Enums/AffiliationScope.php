<?php

namespace App\Enums;

enum AffiliationScope: string implements \Filament\Support\Contracts\HasLabel
{
    case National = 'national';
    case International = 'international';

    public function getLabel(): string
    {
        return match ($this) {
            self::National => 'National',
            self::International => 'International',
        };
    }
}
