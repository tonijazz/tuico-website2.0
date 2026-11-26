<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class EventForm
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
                TextInput::make('location')
                    ->required(),
                DatePicker::make('starts_at')
                    ->required(),
                DatePicker::make('ends_at')
                    ->required(),
                FileUpload::make('banner_image')
                    ->image()
                    ->disk('public')
                    ->directory('events'),
                Select::make('governance_meeting_id')
                    ->relationship('governanceMeeting', 'name')
                    ->default(null),
            ]);
    }
}
