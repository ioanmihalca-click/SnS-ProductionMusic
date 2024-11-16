<?php

namespace App\Filament\Widgets;

use App\Models\Track;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    // Reîmprospătează widget-ul la fiecare 60 de secunde
    protected static ?string $pollingInterval = '60s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Tracks', Track::count())
                ->description('Active tracks in library')
                ->descriptionIcon('heroicon-m-musical-note')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]), // Exemplu de mini chart

            Stat::make('Total Plays', number_format(Track::sum('plays_count')))
                ->description($this->getPlaysIncreasePercent() . '% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning')
                ->chart($this->getPlaysChartData()),

            Stat::make('Total Downloads', number_format(Track::sum('downloads_count')))
                ->description('All time downloads')
                ->descriptionIcon('heroicon-m-arrow-down-circle')
                ->color('primary')
                ->chart($this->getDownloadsChartData()),
        ];
    }

    private function getPlaysIncreasePercent(): string
    {
        // Calculăm procentul de creștere a redărilor în ultima săptămână
        $lastWeek = Track::where('created_at', '>=', now()->subWeek())->sum('plays_count');
        $previousWeek = Track::where('created_at', '>=', now()->subWeeks(2))
                            ->where('created_at', '<', now()->subWeek())
                            ->sum('plays_count');

        if ($previousWeek == 0) return '0';

        return number_format((($lastWeek - $previousWeek) / $previousWeek) * 100, 1);
    }

    private function getPlaysChartData(): array
    {
        // Returnăm datele pentru ultimele 7 zile
        return Track::selectRaw('DATE(created_at) as date, SUM(plays_count) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->limit(7)
            ->pluck('count')
            ->toArray();
    }

    private function getDownloadsChartData(): array
    {
        // Similar cu plays
        return Track::selectRaw('DATE(created_at) as date, SUM(downloads_count) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->limit(7)
            ->pluck('count')
            ->toArray();
    }
}