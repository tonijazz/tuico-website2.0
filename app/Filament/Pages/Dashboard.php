<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class Dashboard extends BaseDashboard
{
    public function getHeading(): string|Htmlable
    {
        $name = Str::of(auth()->user()?->name ?? '')->trim()->before(' ');

        return filled((string) $name) ? "Karibu, {$name}" : 'Karibu';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return now()->translatedFormat('l, j F Y');
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
