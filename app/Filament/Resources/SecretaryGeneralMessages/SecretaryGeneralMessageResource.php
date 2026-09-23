<?php

namespace App\Filament\Resources\SecretaryGeneralMessages;

use App\Filament\Resources\SecretaryGeneralMessages\Pages\CreateSecretaryGeneralMessage;
use App\Filament\Resources\SecretaryGeneralMessages\Pages\EditSecretaryGeneralMessage;
use App\Filament\Resources\SecretaryGeneralMessages\Pages\ListSecretaryGeneralMessages;
use App\Filament\Resources\SecretaryGeneralMessages\Schemas\SecretaryGeneralMessageForm;
use App\Filament\Resources\SecretaryGeneralMessages\Tables\SecretaryGeneralMessagesTable;
use App\Models\SecretaryGeneralMessage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SecretaryGeneralMessageResource extends Resource
{
    /*
     * TUICO terminology:
     * Nilikosea kuandika "General Secretary" ikawa "Secretary General sooo".
     * The underlying model/resource class retains "SecretaryGeneral"
     * for technical consistency and to avoid unnecessary refactoring.
     * These methods control the terminology displayed in Filament.
     */

    public static function getNavigationLabel(): string
    {
        return 'General Secretary Messages';
    }

    public static function getModelLabel(): string
    {
        return 'General Secretary Message';
    }

    public static function getPluralModelLabel(): string
    {
        return 'General Secretary Messages';
    }

    protected static ?string $model = SecretaryGeneralMessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return SecretaryGeneralMessageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SecretaryGeneralMessagesTable::configure($table);
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
            'index' => ListSecretaryGeneralMessages::route('/'),
            'create' => CreateSecretaryGeneralMessage::route('/create'),
            'edit' => EditSecretaryGeneralMessage::route('/{record}/edit'),
        ];
    }
}
