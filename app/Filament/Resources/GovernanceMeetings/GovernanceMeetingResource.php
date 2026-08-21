<?php

namespace App\Filament\Resources\GovernanceMeetings;

use App\Filament\Resources\GovernanceMeetings\Pages\CreateGovernanceMeeting;
use App\Filament\Resources\GovernanceMeetings\Pages\EditGovernanceMeeting;
use App\Filament\Resources\GovernanceMeetings\Pages\ListGovernanceMeetings;
use App\Filament\Resources\GovernanceMeetings\Schemas\GovernanceMeetingForm;
use App\Filament\Resources\GovernanceMeetings\Tables\GovernanceMeetingsTable;
use App\Models\GovernanceMeeting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GovernanceMeetingResource extends Resource
{
    protected static ?string $model = GovernanceMeeting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GovernanceMeetingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GovernanceMeetingsTable::configure($table);
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
            'index' => ListGovernanceMeetings::route('/'),
            'create' => CreateGovernanceMeeting::route('/create'),
            'edit' => EditGovernanceMeeting::route('/{record}/edit'),
        ];
    }
}
