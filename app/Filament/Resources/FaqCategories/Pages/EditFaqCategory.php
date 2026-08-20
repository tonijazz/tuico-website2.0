<?php

namespace App\Filament\Resources\FaqCategories\Pages;

use App\Filament\Resources\FaqCategories\FaqCategoryResource;
use App\Filament\Resources\FaqCategories\Pages\CreateFaqCategory;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFaqCategory extends EditRecord
{
    protected static string $resource = FaqCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name_en'] = $this->record->getTranslation('name', 'en');
        $data['name_sw'] = $this->record->getTranslation('name', 'sw');

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return CreateFaqCategory::foldTranslatableFields($data);
    }
}
