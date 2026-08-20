<?php

namespace App\Filament\Resources\QuickLinks\Schemas;

use App\Enums\QuickLinkLocation;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class QuickLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('label_en')
                            ->label('Label (English)')
                            ->required(),
                        TextInput::make('label_sw')
                            ->label('Label (Kiswahili)')
                            ->required(),
                    ]),

                TextInput::make('url')
                    ->url()
                    ->required()
                    ->columnSpanFull(),
                Select::make('location')
                    ->options(QuickLinkLocation::class)
                    ->default('footer_important')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
