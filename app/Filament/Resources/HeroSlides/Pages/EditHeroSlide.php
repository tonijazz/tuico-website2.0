<?php

namespace App\Filament\Resources\HeroSlides\Pages;

use App\Filament\Resources\HeroSlides\HeroSlideResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHeroSlide extends EditRecord
{
       protected static string $resource = HeroSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (['title', 'subtitle', 'cta_label'] as $field) {
            $data["{$field}_en"] = $this->record->getTranslation($field, 'en');
            $data["{$field}_sw"] = $this->record->getTranslation($field, 'sw');
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateHeroSlide::foldTranslatableFields($data);
    }
}
