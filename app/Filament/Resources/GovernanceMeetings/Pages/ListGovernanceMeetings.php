<?php

namespace App\Filament\Resources\GovernanceMeetings\Pages;

use App\Filament\Resources\GovernanceMeetings\GovernanceMeetingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGovernanceMeetings extends ListRecords
{
    protected static string $resource = GovernanceMeetingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
