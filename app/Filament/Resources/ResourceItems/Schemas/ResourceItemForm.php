<?php

namespace App\Filament\Resources\ResourceItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ResourceItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('title_en')
                                    ->label('Title (English)')
                                    ->required(),
                                Textarea::make('description_en')
                                    ->label('Description (English)')
                                    ->required()
                                    ->rows(3),
                            ]),
                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('title_sw')
                                    ->label('Title (Kiswahili)')
                                    ->required(),
                                Textarea::make('description_sw')
                                    ->label('Description (Kiswahili)')
                                    ->required()
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpanFull(),
                FileUpload::make('file_path')
                    ->required()
                    ->directory('resources'),
                Select::make('access_level')
                    ->options([
                        'public' => 'Public',
                        'members-only' => 'Members Only',
                    ])
                    ->required()
                    ->default('public'),

                Toggle::make('is_publication')
                    ->required()
                    ->live(),
                TextInput::make('author')
                    ->visible(fn (Get $get) => $get('is_publication'))
                    ->default(null),
                TextInput::make('publish_year')
                    ->visible(fn (Get $get) => $get('is_publication'))
                    ->default(null),
                FileUpload::make('cover_image')
                    ->visible(fn (Get $get) => $get('is_publication'))
                    ->image(),

                TextInput::make('downloads_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
            ]);
    }
}
