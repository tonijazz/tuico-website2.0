<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Inquiries\InquiryResource;
use App\Models\Inquiry;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestInquiries extends TableWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Latest inquiries')
            ->query(fn (): Builder => Inquiry::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('name')->weight('semibold'),
                TextColumn::make('subject')->limit(50),
                TextColumn::make('type')->badge(),
                TextColumn::make('status')->badge(),
                TextColumn::make('created_at')->label('Received')->since(),
            ])
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all inquiries')
                    ->url(fn (): string => InquiryResource::getUrl())
                    ->visible(fn (): bool => InquiryResource::canViewAny()),
            ])
            ->paginated(false)
            ->emptyStateHeading('No inquiries yet');
    }
}
