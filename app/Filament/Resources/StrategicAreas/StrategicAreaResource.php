<?php

namespace App\Filament\Resources\StrategicAreas;

use App\Filament\Resources\StrategicAreas\Pages\CreateStrategicArea;
use App\Filament\Resources\StrategicAreas\Pages\EditStrategicArea;
use App\Filament\Resources\StrategicAreas\Pages\ListStrategicAreas;
use App\Filament\Resources\StrategicAreas\Schemas\StrategicAreaForm;
use App\Filament\Resources\StrategicAreas\Tables\StrategicAreasTable;
use App\Models\StrategicArea;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StrategicAreaResource extends Resource
{
    protected static ?string $model = StrategicArea::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getRecordTitle(?\Illuminate\Database\Eloquent\Model $record): ?string
    {
        return $record?->title;
    }

    public static function form(Schema $schema): Schema
    {
        return StrategicAreaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StrategicAreasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStrategicAreas::route('/'),
            'create' => CreateStrategicArea::route('/create'),
            'edit' => EditStrategicArea::route('/{record}/edit'),
        ];
    }
}
