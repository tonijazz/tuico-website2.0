<?php

namespace App\Filament\Resources\ResourceCategories;

use App\Filament\Resources\ResourceCategories\Pages\CreateResourceCategory;
use App\Filament\Resources\ResourceCategories\Pages\EditResourceCategory;
use App\Filament\Resources\ResourceCategories\Pages\ListResourceCategories;
use App\Filament\Resources\ResourceCategories\Schemas\ResourceCategoryForm;
use App\Filament\Resources\ResourceCategories\Tables\ResourceCategoriesTable;
use App\Models\ResourceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResourceCategoryResource extends Resource
{
    protected static ?string $model = ResourceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ResourceCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResourceCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    //added this method to get the record title for the resource
    public static function getRecordTitle(?\Illuminate\Database\Eloquent\Model $record): ?string
    {
        return $record?->name;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResourceCategories::route('/'),
            'create' => CreateResourceCategory::route('/create'),
            'edit' => EditResourceCategory::route('/{record}/edit'),
        ];
    }
}
