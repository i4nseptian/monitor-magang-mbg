<?php

namespace App\Filament\Widgets;

use App\Models\Logbook;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WeeklyActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Aktivitas Mingguan (Logbook)';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'md' => 6,
        'lg' => 9,
    ];

    protected function getData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();
        $cacheKey = 'chart_weekly_' . ($isMahasiswa ? 'user_' . $user->id : 'admin');

        return Cache::remember($cacheKey, 300, function () use ($isMahasiswa, $user) {
            $query = Logbook::query();
            if ($isMahasiswa) {
                $query->where('user_id', $user->id);
            }

            $activities = $query->select(
                DB::raw('YEARWEEK(tanggal, 1) as year_week'),
                DB::raw('MIN(tanggal) as week_start'),
                DB::raw('count(*) as count')
            )
            ->whereYear('tanggal', now()->year)
            ->groupBy(DB::raw('YEARWEEK(tanggal, 1)'))
            ->orderBy('week_start', 'asc')
            ->limit(12)
            ->get();

            $labels = [];
            $data = [];

            foreach ($activities as $activity) {
                $weekNum = $activity->week_start ? Carbon::parse($activity->week_start)->weekOfYear : '#';
                $labels[] = 'Mg-' . $weekNum . ' (' . Carbon::parse($activity->week_start)->translatedFormat('d M') . ')';
                $data[] = $activity->count;
            }

            if (empty($data)) {
                $labels = ['Belum ada data'];
                $data = [0];
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Total Kegiatan',
                        'data' => $data,
                        'backgroundColor' => [
                            '#3b82f6', '#60a5fa', '#818cf8', '#6366f1',
                            '#8b5cf6', '#a78bfa', '#3b82f6', '#60a5fa',
                            '#818cf8', '#6366f1', '#8b5cf6', '#a78bfa',
                        ],
                        'borderRadius' => 4,
                        'borderSkipped' => false,
                    ],
                ],
                'labels' => $labels,
            ];
        });
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
