<?php

namespace App\Filament\Resources\QuickLinks\Pages;

use App\Filament\Resources\QuickLinks\QuickLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuickLink extends EditRecord
{
       protected static string $resource = QuickLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['label'] as $field) {
            $data["{$field}_en"] = $this->record->getTranslation($field, 'en');
            $data["{$field}_sw"] = $this->record->getTranslation($field, 'sw');
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateQuickLink::foldTranslatableFields($data);
    }
}
