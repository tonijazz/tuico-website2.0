<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;


enum InquiryType: string implements HasLabel
{
    //
    case General = 'general';
    case Membership = 'membership';

        public function getLabel(): string
    {
        return match ($this) {
            self::General => 'General',
            self::Membership => 'Membership',
        };
    }
}
