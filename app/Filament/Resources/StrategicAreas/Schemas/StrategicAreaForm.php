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
                        'heroicon-o-users' => 'Users (Organising and Union Building)',
                        'heroicon-o-scale' => 'Scale (Collective Bargaining)',
                        'heroicon-o-academic-cap' => 'Academic Cap (Workers’ Education)',
                        'heroicon-o-chat-bubble-left-right' => 'Chat Bubbles (Social Dialogue)',
                        'heroicon-o-shield-check' => 'Shield (Labour Rights Advocacy)',
                        'heroicon-o-heart' => 'Heart (Health, Safety, and Welfare)',
                        'heroicon-o-building-office-2' => 'Building (Union Governance and Capacity Building)',
                        'heroicon-o-globe-alt' => 'Globe (Policy Influence and Strategic Partnerships)',
                        'heroicon-o-chart-bar' => 'Chart (Monitoring and Evaluation)',
                    ])
                    ->required()
                    ->default('heroicon-o-users'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
