<?php

namespace App\Filament\Resources\Zones\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ZoneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name_en')
                            ->label('Name (English)')
                            ->required(),
                        TextInput::make('name_sw')
                            ->label('Name (Kiswahili)')
                            ->required(),
                    ]),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
