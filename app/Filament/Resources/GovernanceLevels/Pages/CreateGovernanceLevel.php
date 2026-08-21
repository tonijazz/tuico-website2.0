<?php

namespace App\Filament\Resources\GovernanceLevels\Pages;

use App\Filament\Resources\GovernanceLevels\GovernanceLevelResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGovernanceLevel extends CreateRecord
{
    protected static string $resource = GovernanceLevelResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->foldTranslatableFields($data);
    }

    public static function foldTranslatableFields(array $data): array
    {
        foreach (['name'] as $field) {
            $data[$field] = [
                'en' => $data["{$field}_en"] ?? null,
                'sw' => $data["{$field}_sw"] ?? null,
            ];
            unset($data["{$field}_en"], $data["{$field}_sw"]);
        }

        return $data;
    }
}
