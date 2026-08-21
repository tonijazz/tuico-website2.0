<?php

namespace App\Filament\Resources\GovernanceMeetings\Pages;

use App\Filament\Resources\GovernanceMeetings\GovernanceMeetingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGovernanceMeeting extends EditRecord
{
    protected static string $resource = GovernanceMeetingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['name', 'frequency'] as $field) {
            $data["{$field}_en"] = $this->record->getTranslation($field, 'en');
            $data["{$field}_sw"] = $this->record->getTranslation($field, 'sw');
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateGovernanceMeeting::foldTranslatableFields($data);
    }
}
