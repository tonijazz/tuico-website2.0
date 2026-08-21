<?php

namespace App\Filament\Resources\Programmes\Schemas;

use App\Enums\ProgrammeStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProgrammeForm
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
                                Textarea::make('outcomes_en')
                                    ->label('Outcomes (English)')
                                    ->rows(6),
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
                                Textarea::make('outcomes_sw')
                                    ->label('Outcomes (Kiswahili)')
                                    ->rows(6),
                            ]),
                    ])
                    ->columnSpanFull(),

                Select::make('status')
                    ->options(ProgrammeStatus::class)
                    ->default('active')
                    ->required(),
                Select::make('affiliation_id')
                    ->relationship('affiliation', 'name')
                    ->default(null),
                DatePicker::make('starts_at'),
                DatePicker::make('ends_at'),
            ]);
    }
}
