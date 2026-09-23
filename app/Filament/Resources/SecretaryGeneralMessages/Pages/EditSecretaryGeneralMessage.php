<?php

namespace App\Filament\Resources\SecretaryGeneralMessages\Pages;

use App\Filament\Resources\SecretaryGeneralMessages\SecretaryGeneralMessageResource;
use App\Models\SecretaryGeneralMessage;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSecretaryGeneralMessage extends EditRecord
{
    protected static string $resource = SecretaryGeneralMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['title', 'content'] as $field) {
            $data["{$field}_en"] = $this->record->getTranslation($field, 'en');
            $data["{$field}_sw"] = $this->record->getTranslation($field, 'sw');
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateSecretaryGeneralMessage::foldTranslatableFields($data);
    }

    protected function afterSave(): void
    {
        if ($this->record->is_featured) {
            SecretaryGeneralMessage::where('id', '!=', $this->record->id)
                ->update(['is_featured' => false]);
        }
    }
}
