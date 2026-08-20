<?php

namespace App\Filament\Resources\ResourceItems\Pages;

use App\Filament\Resources\ResourceItems\ResourceItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateResourceItem extends CreateRecord
{
    protected static string $resource = ResourceItemResource::class;

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->foldTranslatableFields($data);
    }

    public static function foldTranslatableFields(array $data): array
    {
        foreach (['title', 'description'] as $field) {
            $data[$field] = [
                'en' => $data["{$field}_en"] ?? null,
                'sw' => $data["{$field}_sw"] ?? null,
            ];
            unset($data["{$field}_en"], $data["{$field}_sw"]);
        }

        return $data;
    }
}
