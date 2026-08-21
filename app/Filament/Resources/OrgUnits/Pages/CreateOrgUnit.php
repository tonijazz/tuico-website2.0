<?php

namespace App\Filament\Resources\OrgUnits\Pages;

use App\Filament\Resources\OrgUnits\OrgUnitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrgUnit extends CreateRecord
{
    protected static string $resource = OrgUnitResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->foldTranslatableFields($data);
    }

    public static function foldTranslatableFields(array $data): array
    {
        foreach (['name', 'description'] as $field) {
            $data[$field] = [
                'en' => $data["{$field}_en"] ?? null,
                'sw' => $data["{$field}_sw"] ?? null,
            ];
            unset($data["{$field}_en"], $data["{$field}_sw"]);
        }

        return $data;
    }
}
