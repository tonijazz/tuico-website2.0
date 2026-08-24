<?php

namespace App\Filament\Resources\Offices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class OfficeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'head' => 'Head Office',
                        'regional' => 'Regional Office',
                        'sub' => 'Sub-Office',
                    ])
                    ->required()
                    ->live(),
                Select::make('zone_id')
                    ->relationship('zone', 'name')
                    ->visible(fn (Get $get) => $get('type') === 'regional')
                    ->default(null),

                Select::make('parent_office_id')
                    ->relationship('parentOffice', 'name')
                    ->visible(fn (Get $get) => $get('type') === 'sub')
                    ->default(null),
                Toggle::make('is_zonal_seat')
                    ->visible(fn (Get $get) => $get('type') === 'regional')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('lat')
                    ->numeric()
                    ->default(null),
                TextInput::make('lng')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
