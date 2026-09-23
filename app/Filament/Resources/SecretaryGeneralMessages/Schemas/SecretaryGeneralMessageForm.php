<?php

namespace App\Filament\Resources\SecretaryGeneralMessages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SecretaryGeneralMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('leader_id')
                    ->label('General Secretary')
                    ->relationship('leader', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

                Tabs::make('Translations')
                    ->tabs([

                        Tab::make('English')
                            ->schema([
                                TextInput::make('title_en')
                                    ->label('Title')
                                    ->required(),

                                RichEditor::make('content_en')
                                    ->label('Message')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('title_sw')
                                    ->label('Title')
                                    ->required(),

                                RichEditor::make('content_sw')
                                    ->label('Message')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                    ])
                    ->columnSpanFull(),

                Section::make('Publication')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published'),

                        Toggle::make('is_featured')
                            ->label('Featured Message')
                            ->helperText('Display this message as the main message on the General Secretary page.'),

                        DateTimePicker::make('published_at')
                            ->label('Published At')
                            ->seconds(false),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

            ]);
    }
}
