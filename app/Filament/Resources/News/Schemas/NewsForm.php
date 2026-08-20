<?php

namespace App\Filament\Resources\News\Schemas;

use App\Enums\NewsStatus;
use App\Enums\NewsType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class NewsForm
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
                                Textarea::make('excerpt_en')
                                    ->label('Excerpt (English)')
                                    ->rows(2),
                                Textarea::make('body_en')
                                    ->label('Body (English)')
                                    ->required()
                                    ->rows(6),
                            ]),
                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('title_sw')
                                    ->label('Title (Kiswahili)')
                                    ->required(),
                                Textarea::make('excerpt_sw')
                                    ->label('Excerpt (Kiswahili)')
                                    ->rows(2),
                                Textarea::make('body_sw')
                                    ->label('Body (Kiswahili)')
                                    ->required()
                                    ->rows(6),
                            ]),
                    ])
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->required(),
                Select::make('type')
                    ->options(NewsType::class)
                    ->default('update')
                    ->required(),
                Select::make('status')
                    ->options(NewsStatus::class)
                    ->default('draft')
                    ->required(),
                FileUpload::make('featured_image')
                    ->image(),
                DateTimePicker::make('published_at'),
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->default(null),
            ]);
    }
}
