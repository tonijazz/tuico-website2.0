<?php

namespace App\Enums;

enum QuickLinkLocation: string implements \Filament\Support\Contracts\HasLabel
{
    case FooterImportant = 'footer_important';
    case FooterPartners = 'footer_partners';
    case Header = 'header';

    public function getLabel(): string
    {
        return match ($this) {
            self::FooterImportant => 'Footer — Important Links',
            self::FooterPartners => 'Footer — Popular Websites/Partners',
            self::Header => 'Header',
        };
    }
}
