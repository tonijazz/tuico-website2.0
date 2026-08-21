<?php

namespace App\Filament\Resources\GovernanceLevels;

use App\Filament\Resources\GovernanceLevels\Pages\CreateGovernanceLevel;
use App\Filament\Resources\GovernanceLevels\Pages\EditGovernanceLevel;
use App\Filament\Resources\GovernanceLevels\Pages\ListGovernanceLevels;
use App\Filament\Resources\GovernanceLevels\Schemas\GovernanceLevelForm;
use App\Filament\Resources\GovernanceLevels\Tables\GovernanceLevelsTable;
use App\Models\GovernanceLevel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GovernanceLevelResource extends Resource
{
    protected static ?string $model = GovernanceLevel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GovernanceLevelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GovernanceLevelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getRecordTitle(?\Illuminate\Database\Eloquent\Model $record): ?string
    {
        return $record?->name;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGovernanceLevels::route('/'),
            'create' => CreateGovernanceLevel::route('/create'),
            'edit' => EditGovernanceLevel::route('/{record}/edit'),
        ];
    }
}
