<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Select::make('locale')
                    ->options([
                        'en' => 'English',
                        'sw' => 'Kiswahili',
                    ])
                    ->required()
                    ->default('en'),
                TextInput::make('slug')
                    ->required(),
                Builder::make('blocks')
                    ->blocks([
                        Block::make('heading')
                            ->schema([
                                TextInput::make('content')
                                    ->label('Heading Text')
                                    ->required(),
                            ]),
                        Block::make('paragraph')
                            ->schema([
                                Textarea::make('content')
                                    ->label('Paragraph Text')
                                    ->required()
                                    ->rows(4),
                            ]),
                        Block::make('bulleted_list')
                            ->schema([
                                Repeater::make('items')
                                    ->label('List Items')
                                    ->schema([
                                        TextInput::make('item')
                                            ->label('Item Text')
                                            ->required(),
                                    ])
                                    ->required(),
                            ]),
                    ])
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('seo_title')
                    ->default(null),
                TextInput::make('seo_description')
                    ->default(null),
            ]);
    }
}
