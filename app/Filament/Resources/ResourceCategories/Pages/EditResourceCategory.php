<?php

namespace App\Filament\Resources\ResourceCategories\Pages;

use App\Filament\Resources\ResourceCategories\ResourceCategoryResource;
use App\Filament\Resources\ResourceCategories\Pages\CreateResourceCategory;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResourceCategory extends EditRecord
{
    protected static string $resource = ResourceCategoryResource::class;

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
        return CreateResourceCategory::foldTranslatableFields($data);
    }
}
