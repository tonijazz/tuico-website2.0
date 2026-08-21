<?php

namespace App\Filament\Resources\GovernanceLevels\Pages;

use App\Filament\Resources\GovernanceLevels\GovernanceLevelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGovernanceLevel extends EditRecord
{
    protected static string $resource = GovernanceLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['name'] as $field) {
            $data["{$field}_en"] = $this->record->getTranslation($field, 'en');
            $data["{$field}_sw"] = $this->record->getTranslation($field, 'sw');
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateGovernanceLevel::foldTranslatableFields($data);
    }
}
