<?php

namespace App\Filament\Resources\StrategicAreas\Pages;

use App\Filament\Resources\StrategicAreas\StrategicAreaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStrategicArea extends EditRecord
{
    protected static string $resource = StrategicAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['title', 'description'] as $field) {
            $data["{$field}_en"] = $this->record->getTranslation($field, 'en');
            $data["{$field}_sw"] = $this->record->getTranslation($field, 'sw');
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateStrategicArea::foldTranslatableFields($data);
    }
}
