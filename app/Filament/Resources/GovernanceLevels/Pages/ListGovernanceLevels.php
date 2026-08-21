<?php

namespace App\Filament\Resources\GovernanceLevels\Pages;

use App\Filament\Resources\GovernanceLevels\GovernanceLevelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGovernanceLevels extends ListRecords
{
    protected static string $resource = GovernanceLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
