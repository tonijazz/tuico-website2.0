<?php

namespace App\Filament\Resources\GovernanceMeetings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class GovernanceMeetingForm
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
                                TextInput::make('frequency_en')
                                    ->label('Frequency (English)')
                                    ->required(),
                            ]),
                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('name_sw')
                                    ->label('Name (Kiswahili)')
                                    ->required(),
                                TextInput::make('frequency_sw')
                                    ->label('Frequency (Kiswahili)')
                                    ->required(),
                            ]),
                    ])
                    ->columnSpanFull(),

                Select::make('governance_level_id')
                    ->relationship('governanceLevel', 'name')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
