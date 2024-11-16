<?php

namespace App\Filament\Widgets;

use App\Models\Track;
use Filament\Widgets\ChartWidget;

class ActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Activity Overview';
    
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = $this->getActivityData();

        return [
            'datasets' => [
                [
                    'label' => 'Plays',
                    'data' => $data['plays'],
                    'borderColor' => '#EAB308',
                    'fill' => 'start',
                ],
                [
                    'label' => 'Downloads',
                    'data' => $data['downloads'],
                    'borderColor' => '#3B82F6',
                    'fill' => 'start',
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getActivityData(): array
    {
        $days = now()->subDays(30)->daysUntil(now());
        
        $plays = [];
        $downloads = [];
        $labels = [];

        foreach ($days as $day) {
            $date = $day->format('Y-m-d');
            
            $plays[] = Track::whereDate('created_at', $date)->sum('plays_count');
            $downloads[] = Track::whereDate('created_at', $date)->sum('downloads_count');
            $labels[] = $day->format('M d');
        }

        return [
            'plays' => $plays,
            'downloads' => $downloads,
            'labels' => $labels,
        ];
    }
}