<?php

namespace App\Filament\Resources\SecretaryGeneralMessages\Pages;

use App\Filament\Resources\SecretaryGeneralMessages\SecretaryGeneralMessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSecretaryGeneralMessages extends ListRecords
{
    protected static string $resource = SecretaryGeneralMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
