<?php

namespace App\Filament\Resources\OrgUnits\Schemas;

use App\Enums\OrgUnitType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class OrgUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
             Tabs::make('Translations')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('name_en')
                                    ->label('Name (English)')
                                    ->required(),
                                Textarea::make('description_en')
                                    ->label('Description (English)')
                                    ->required()
                                    ->rows(3),
                            ]),
                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('name_sw')
                                    ->label('Name (Kiswahili)')
                                    ->required(),
                                Textarea::make('description_sw')
                                    ->label('Description (Kiswahili)')
                                    ->required()
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpanFull(),
                Select::make('type')
                    ->options(OrgUnitType::class)
                    ->default('sector')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
