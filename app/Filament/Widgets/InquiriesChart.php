<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class InquiriesChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 3;

    public function getHeading(): string|Htmlable|null
    {
        return 'Inquiries per month';
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        // Last 6 months, oldest first
        $months = collect(range(5, 0))
            ->map(fn (int $i) => now()->startOfMonth()->subMonthsNoOverflow($i));

        return [
            'datasets' => [
                [
                    'label' => 'Inquiries',
                    'data' => $months
                        ->map(fn ($m): int => Inquiry::whereBetween('created_at', [
                            $m->copy()->startOfMonth(),
                            $m->copy()->endOfMonth(),
                        ])->count())
                        ->all(),
                    'backgroundColor' => '#2EA8DC',
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $months->map(fn ($m): string => $m->format('M'))->all(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => ['legend' => ['display' => false]],
            'scales' => ['y' => ['ticks' => ['precision' => 0]]],
        ];
    }
}
