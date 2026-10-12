<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Route;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('question_en')
                                    ->label('Question (English)')
                                    ->required(),

                                Textarea::make('answer_en')
                                    ->label('Answer (English)')
                                    ->required()
                                    ->rows(3),
                            ]),

                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('question_sw')
                                    ->label('Question (Kiswahili)')
                                    ->required(),

                                Textarea::make('answer_sw')
                                    ->label('Answer (Kiswahili)')
                                    ->required()
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpanFull(),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),

                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),

                Repeater::make('links')
                    ->label('Related Links')
                    ->relationship()
                    ->schema([
                        TextInput::make('label_en')
                            ->label('Link Label (English)')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('label_sw')
                            ->label('Link Label (Kiswahili)')
                            ->required()
                            ->maxLength(255),

                        Select::make('route_name')
                            ->label('Destination Page')
                            ->options(fn (): array => collect([
                                'about.index' => 'About TUICO',
                                'sectors.index' => 'Sectors',
                                'regions.index' => 'Regional Offices',
                                'zones.index' => 'Zonal Offices',
                                'contact.create' => 'Contact TUICO',
                                'join-us.create' => 'Join TUICO',
                                'affiliations.index' => 'Affiliations',
                                'leadership.index' => 'Leadership',
                                'news.index' => 'News',
                                'news-events.index' => 'News & Events',
                                'events.index' => 'Events',
                                'resources.index' => 'Resources',
                                'programmes.index' => 'Strategic Plan',
                                'faq.index' => 'Frequently Asked Questions',
                            ])
                                ->filter(
                                    fn ($label, $name) => Route::has($name)
                                )
                                ->all())
                            ->required()
                            ->searchable(),
                    ])
                    ->columns(2)
                    ->defaultItems(0)
                    ->addActionLabel('Add Related Link')
                    ->reorderable()
                    ->orderColumn('order')
                    ->maxItems(3)
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['label_en'] ?? null)
                    ->columnSpanFull(),
            ]);
    }
}
