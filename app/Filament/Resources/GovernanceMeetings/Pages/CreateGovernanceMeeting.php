<?php

namespace App\Filament\Resources\GovernanceMeetings\Pages;

use App\Filament\Resources\GovernanceMeetings\GovernanceMeetingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGovernanceMeeting extends CreateRecord
{
    protected static string $resource = GovernanceMeetingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->foldTranslatableFields($data);
    }

    public static function foldTranslatableFields(array $data): array
    {
        foreach (['name', 'frequency'] as $field) {
            $data[$field] = [
                'en' => $data["{$field}_en"] ?? null,
                'sw' => $data["{$field}_sw"] ?? null,
            ];
            unset($data["{$field}_en"], $data["{$field}_sw"]);
        }

        return $data;
    }
}
