<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class UpcomingEvents extends TableWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Upcoming events')
            ->query(fn (): Builder => Event::query()
                ->whereDate('starts_at', '>=', today())
                ->orderBy('starts_at')
                ->limit(5))
            ->columns([
                TextColumn::make('title')->limit(40)->weight('semibold'),
                TextColumn::make('starts_at')->label('Date')->date('d M Y'),
                TextColumn::make('location')->limit(25)->placeholder('—'),
            ])
            ->paginated(false)
            ->emptyStateHeading('No upcoming events');
    }
}
