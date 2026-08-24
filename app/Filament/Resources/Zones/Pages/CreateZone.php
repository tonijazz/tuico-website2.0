<?php

namespace App\Filament\Resources\Zones\Pages;

use App\Filament\Resources\Zones\ZoneResource;
use Filament\Resources\Pages\CreateRecord;

class CreateZone extends CreateRecord
{
    protected static string $resource = ZoneResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->foldTranslatableFields($data);
    }

    public static function foldTranslatableFields(array $data): array
    {
        $data['name'] = [
            'en' => $data['name_en'] ?? null,
            'sw' => $data['name_sw'] ?? null,
        ];
        unset($data['name_en'], $data['name_sw']);

        return $data;
    }
}
