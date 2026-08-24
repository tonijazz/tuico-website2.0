<?php

namespace App\Filament\Resources\Zones\Pages;

use App\Filament\Resources\Zones\ZoneResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditZone extends EditRecord
{
    protected static string $resource = ZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name_en'] = $this->record->getTranslation('name', 'en');
        $data['name_sw'] = $this->record->getTranslation('name', 'sw');

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateZone::foldTranslatableFields($data);
    }
}
