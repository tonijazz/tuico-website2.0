<?php

namespace App\Filament\Resources\StrategicAreas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class StrategicAreaForm
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
                Select::make('icon')
                    ->options([
                        'heroicon-o-flag' => 'Flag',
                        'heroicon-o-scale' => 'Scale (Bargaining)',
                        'heroicon-o-academic-cap' => 'Academic Cap (Education)',
                        'heroicon-o-chat-bubble-left-right' => 'Chat Bubbles (Dialogue)',
                        'heroicon-o-shield-check' => 'Shield (Safety/Rights)',
                        'heroicon-o-users' => 'Users (Organising)',
                        'heroicon-o-globe-alt' => 'Globe (Partnerships)',
                        'heroicon-o-chart-bar' => 'Chart (Monitoring)',
                    ])
                    ->required()
                    ->default('heroicon-o-flag'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
