<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Inquiry;
use App\Models\News;
use App\Models\ResourceItem;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Inquiries per day for the last 7 days (sparkline)
        $perDay = Inquiry::query()
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->groupBy('d')
            ->pluck('c', 'd');

        $trend = collect(range(6, 0))
            ->map(fn (int $i): int => (int) ($perDay[now()->subDays($i)->toDateString()] ?? 0))
            ->all();

        return [
            Stat::make(
                'Inquiries this month',
                Inquiry::where('created_at', '>=', now()->startOfMonth())->count(),
            )
                ->description('Last 7 days')
                ->chart($trend)
                ->color('info'),

            Stat::make('Published news', News::published()->count())
                ->description('Live on the website')
                ->color('success'),

            Stat::make(
                'Upcoming events',
                Event::whereDate('starts_at', '>=', today())->count(),
            )
                ->description('From today onwards')
                ->color('warning'),

            Stat::make('Resource items', ResourceItem::count())
                ->description('Documents and downloads')
                ->color('primary'),
        ];
    }
}
