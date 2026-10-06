<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Events\EventResource;
use App\Filament\Resources\News\NewsResource;
use App\Filament\Resources\ResourceItems\ResourceItemResource;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;

class QuickLinks extends Widget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.quick-links';

    public function getLinks(): array
    {
        return collect([
            [
                'label' => 'Write news',
                'icon' => 'heroicon-o-newspaper',
                'url' => NewsResource::canCreate() ? NewsResource::getUrl('create') : null,
            ],
            [
                'label' => 'Add event',
                'icon' => 'heroicon-o-calendar-days',
                'url' => EventResource::canCreate() ? EventResource::getUrl('create') : null,
            ],
            [
                'label' => 'Upload resource',
                'icon' => 'heroicon-o-document-arrow-up',
                'url' => ResourceItemResource::canCreate() ? ResourceItemResource::getUrl('create') : null,
            ],
        ])
            ->filter(fn (array $link): bool => filled($link['url']))
            ->values()
            ->all();
    }
}
