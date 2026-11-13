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
                        Block::make('intro')
                            ->label('Page Intro (shown in the page header)')
                            ->schema([
                                Textarea::make('content')
                                    ->label('Intro Text')
                                    ->required()
                                    ->rows(2),
                            ]),
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
                        Block::make('key_figures')
                            ->label('Key Figures (About page card)')
                            ->schema([
                                Repeater::make('items')
                                    ->label('Figures')
                                    ->schema([
                                        TextInput::make('value')
                                            ->label('Figure (e.g. 1995 or 150,000+)')
                                            ->required(),
                                        TextInput::make('label')
                                            ->label('Caption (e.g. Established)')
                                            ->required(),
                                    ])
                                    ->required(),
                            ]),
                        Block::make('mission_commitments')
                            ->label('Mission Commitments (numbered list under the Mission)')
                            ->schema([
                                TextInput::make('intro')
                                    ->label('Intro line (optional, e.g. "We do this by:")')
                                    ->default(null),
                                Repeater::make('items')
                                    ->label('Commitments')
                                    ->schema([
                                        TextInput::make('item')
                                            ->label('Commitment')
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
