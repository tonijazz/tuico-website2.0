<?php

namespace App\Filament\Resources\Affiliations;

use App\Filament\Resources\Affiliations\Pages\CreateAffiliation;
use App\Filament\Resources\Affiliations\Pages\EditAffiliation;
use App\Filament\Resources\Affiliations\Pages\ListAffiliations;
use App\Filament\Resources\Affiliations\Schemas\AffiliationForm;
use App\Filament\Resources\Affiliations\Tables\AffiliationsTable;
use App\Models\Affiliation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AffiliationResource extends Resource
{
    protected static ?string $model = Affiliation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AffiliationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AffiliationsTable::configure($table);
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
            'index' => ListAffiliations::route('/'),
            'create' => CreateAffiliation::route('/create'),
            'edit' => EditAffiliation::route('/{record}/edit'),
        ];
    }
}
