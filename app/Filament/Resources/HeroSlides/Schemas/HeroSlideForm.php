<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class HeroSlideForm
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
                                Textarea::make('subtitle_en')
                                    ->label('Subtitle (English)')
                                    ->rows(3),
                                TextInput::make('cta_label_en')
                                    ->label('Call to Action Label')
                                    ->default(null),
                            ]),
                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('title_sw')
                                    ->label('Title (Kiswahili)')
                                    ->required(),
                                Textarea::make('subtitle_sw')
                                    ->label('Subtitle (Kiswahili)')
                                    ->rows(3),
                                TextInput::make('cta_label_sw')
                                    ->label('Call to Action Label (Kiswahili)')
                                    ->default(null),
                            ]),
                    ])
                    ->columnSpanFull(),

                TextInput::make('cta_url')
                    ->url()
                    ->default(null),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                Toggle::make('is_active'),
                DatePicker::make('starts_at'),
                DatePicker::make('ends_at'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
