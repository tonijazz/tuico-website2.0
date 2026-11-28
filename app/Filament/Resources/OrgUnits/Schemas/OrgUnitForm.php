<?php

namespace App\Filament\Resources\OrgUnits\Schemas;

use App\Enums\OrgUnitType;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;

class OrgUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('name_en')
                                    ->label('Name (English)')
                                    ->required(),
                                Textarea::make('description_en')
                                    ->label('Description (English)')
                                    ->required()
                                    ->rows(3),
                                Repeater::make('examples_en')
                                    ->label(fn(Get $get) => $get('type') === 'sector'
                                        ? 'Examples of workplaces (English)'
                                        : 'Examples of work (English)')
                                    ->simple(TextInput::make('item')->required())
                                    ->addActionLabel('Add example')
                                    ->reorderable(),
                            ]),
                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('name_sw')
                                    ->label('Name (Kiswahili)')
                                    ->required(),
                                Textarea::make('description_sw')
                                    ->label('Description (Kiswahili)')
                                    ->required()
                                    ->rows(3),
                                Repeater::make('examples_sw')
                                    ->label(fn(Get $get) => $get('type') === 'sector'
                                        ? 'Mifano ya maeneo ya kazi (Kiswahili)'
                                        : 'Mifano ya kazi (Kiswahili)')
                                    ->simple(TextInput::make('item')->required())
                                    ->addActionLabel('Add example')
                                    ->reorderable(),
                            ]),
                    ])
                    ->columnSpanFull(),
                Select::make('type')
                    ->options(OrgUnitType::class)
                    ->default('sector')
                    ->live()
                    ->required(),
                Select::make('icon')
                    ->label('Icon')
                    ->options([
                        'factory' => 'Factory (industrial)',
                        'store'   => 'Storefront (commercial)',
                        'bank'    => 'Bank (financial)',
                        'bolt'    => 'Bolt (services)',
                    ])
                    ->visible(fn(Get $get) => in_array(
                        $get('type'),
                        ['sector', OrgUnitType::Sector, OrgUnitType::Sector->value],
                        true
                    )),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->helperText('Address that receives website enquiries when the box below is ticked.'),
                Toggle::make('receives_enquiries')
                    ->label('Receives website enquiries')
                    ->default(false),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
