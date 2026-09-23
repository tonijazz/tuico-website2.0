<?php

namespace App\Filament\Resources\SecretaryGeneralMessages\Pages;

use App\Filament\Resources\SecretaryGeneralMessages\SecretaryGeneralMessageResource;
use App\Models\SecretaryGeneralMessage;
use Filament\Resources\Pages\CreateRecord;

class CreateSecretaryGeneralMessage extends CreateRecord
{
    protected static string $resource = SecretaryGeneralMessageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->foldTranslatableFields($data);
    }

    protected function afterCreate(): void
    {
        if ($this->record->is_featured) {
            SecretaryGeneralMessage::where('id', '!=', $this->record->id)
                ->update(['is_featured' => false]);
        }
    }

    public static function foldTranslatableFields(array $data): array
    {
        foreach (['title', 'content'] as $field) {
            $data[$field] = [
                'en' => $data["{$field}_en"] ?? null,
                'sw' => $data["{$field}_sw"] ?? null,
            ];

            unset($data["{$field}_en"], $data["{$field}_sw"]);
        }

        return $data;
    }
}
