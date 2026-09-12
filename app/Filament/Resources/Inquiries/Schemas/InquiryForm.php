<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use App\Enums\InquiryStatus;
use App\Enums\InquiryType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('email')
                    ->label('Email address')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('phone')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('subject')
                    ->disabled()
                    ->dehydrated(false),
                Textarea::make('message')
                    ->disabled()
                    ->dehydrated(false)
                    ->columnSpanFull(),
                Select::make('type')
                    ->options(InquiryType::class)
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('workplace')
                    ->disabled()
                    ->dehydrated(false),
                Select::make('region_id')
                    ->relationship('office', 'name')
                    ->disabled()
                    ->dehydrated(false),

                Select::make('status')
                    ->options(InquiryStatus::class)
                    ->required(),
            ]);
    }
}