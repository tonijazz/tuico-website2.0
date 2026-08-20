<?php

namespace App\Filament\Resources\StrategicAreas\Pages;

use App\Filament\Resources\StrategicAreas\StrategicAreaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStrategicAreas extends ListRecords
{
    protected static string $resource = StrategicAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
