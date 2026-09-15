<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Support\Icons\Heroicon;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.manage-site-settings';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(app(SiteSettings::class)->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('vision')->required(),
                Textarea::make('mission')->required(),
                TextInput::make('street_address')->required(),
                TextInput::make('po_box')->required(),
                TextInput::make('phone')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('fax')->required(),
                TextInput::make('facebook_url')->url()->default(null),
                TextInput::make('instagram_url')->url()->default(null),
                TextInput::make('tiktok_url')->url()->default(null),
                TextInput::make('linkedin_url')->url()->default(null),
                TextInput::make('youtube_url')->url()->default(null),
                FileUpload::make('logo')
                    ->image()
                    ->directory('site')
                    ->default(null),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $settings = app(SiteSettings::class);
        $settings->fill($this->form->getState());
        $settings->save();
    }
}
