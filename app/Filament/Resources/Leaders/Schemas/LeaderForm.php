<?php

namespace App\Filament\Resources\Leaders\Schemas;

use App\Enums\LeaderLevel;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class LeaderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                TextInput::make('position_en')
                                    ->label('Position (English)')
                                    ->required(),
                                Textarea::make('bio_en')
                                    ->label('Biography (English)')
                                    ->required()
                                    ->rows(3),
                            ]),
                        Tab::make('Kiswahili')
                            ->schema([
                                TextInput::make('position_sw')
                                    ->label('Position (Kiswahili)')
                                    ->required(),
                                Textarea::make('bio_sw')
                                    ->label('Biography (Kiswahili)')
                                    ->required()
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpanFull(),
                FileUpload::make('photo')
                    ->image()
                    ->directory('leaders')
                    ->default(null),
                Select::make('level')
                    ->options(LeaderLevel::class)
                    ->required()
                    ->live(),
                Select::make('role_type')
                    ->options(function (Get $get) {
                        $level = $get('level');
                        $level = $level instanceof \BackedEnum ? $level->value : $level;

                        return match ($level) {
                            'national' => [
                                'chairperson' => 'Chairperson',
                                'secretary' => 'Secretary',
                                'unit_head' => 'Unit Head',
                            ],
                            'zonal' => [
                                'chairperson' => 'Chairperson',
                            ],
                            'regional' => [
                                'chairperson' => 'Chairperson',
                                'secretary' => 'Secretary',
                            ],
                            'sub' => [
                                'secretary' => 'Secretary',
                            ],
                            default => [],
                        };
                    })
                    ->required()
                    ->live(),

                Select::make('org_unit_id')
                    ->relationship('orgUnit', 'name')
                    ->visible(function (Get $get) {
                        $roleType = $get('role_type');
                        $roleType = $roleType instanceof \BackedEnum ? $roleType->value : $roleType;

                        return $roleType === 'unit_head';
                    })
                    ->default(null),

                Select::make('zone_id')
                    ->relationship('zone', 'name')
                    ->visible(function (Get $get) {
                        $level = $get('level');
                        $level = $level instanceof \BackedEnum ? $level->value : $level;
                        $roleType = $get('role_type');
                        $roleType = $roleType instanceof \BackedEnum ? $roleType->value : $roleType;

                        return $level === 'zonal' && $roleType === 'chairperson';
                    })
                    ->default(null),

                Select::make('office_id')
                    ->relationship('office', 'name')
                    ->visible(function (Get $get) {
                        $level = $get('level');
                        $level = $level instanceof \BackedEnum ? $level->value : $level;

                        return in_array($level, ['regional', 'sub']);
                    })
                    ->default(null),
                DatePicker::make('term_start')
                    ->visible(function (Get $get) {
                        $level = $get('level');
                        $level = $level instanceof \BackedEnum ? $level->value : $level;
                        $roleType = $get('role_type');
                        $roleType = $roleType instanceof \BackedEnum ? $roleType->value : $roleType;

                        return $roleType === 'chairperson' || ($level === 'national' && $roleType === 'secretary');
                    }),

                DatePicker::make('term_end')
                    ->visible(function (Get $get) {
                        $level = $get('level');
                        $level = $level instanceof \BackedEnum ? $level->value : $level;
                        $roleType = $get('role_type');
                        $roleType = $roleType instanceof \BackedEnum ? $roleType->value : $roleType;

                        return $roleType === 'chairperson' || ($level === 'national' && $roleType === 'secretary');
                    }),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
