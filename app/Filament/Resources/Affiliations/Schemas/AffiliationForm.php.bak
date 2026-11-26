<?php

namespace App\Filament\Resources\Affiliations\Schemas;

use App\Enums\AffiliationScope;
use App\Enums\AffiliationType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class AffiliationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('description_en')
                            ->label('Description (English)'),
                        TextInput::make('description_sw')
                            ->label('Description (Kiswahili)'),
                    ]),
                Select::make('type')
                    ->options(AffiliationType::class)
                    ->default('affiliation')
                    ->required(),
                Select::make('scope')
                    ->options(AffiliationScope::class)
                    ->default('national')
                    ->required(),
                TextInput::make('website_url')
                    ->url()
                    ->default(null),
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('affiliations'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
