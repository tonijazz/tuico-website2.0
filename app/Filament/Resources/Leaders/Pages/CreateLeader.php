<?php

namespace App\Filament\Resources\Leaders\Pages;

use App\Filament\Resources\Leaders\LeaderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLeader extends CreateRecord
{
    protected static string $resource = LeaderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->foldTranslatableFields($data);
    }

    public static function foldTranslatableFields(array $data): array
    {
        foreach (['position', 'bio'] as $field) {
            $data[$field] = [
                'en' => $data["{$field}_en"] ?? null,
                'sw' => $data["{$field}_sw"] ?? null,
            ];
            unset($data["{$field}_en"], $data["{$field}_sw"]);
        }

        return $data;
    }
}
