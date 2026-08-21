<?php

namespace App\Filament\Resources\GovernanceLevels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class GovernanceLevelForm
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

                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
