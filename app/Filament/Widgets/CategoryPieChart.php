<?php

namespace App\Filament\Widgets;

use App\Models\Logbook;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryPieChart extends ChartWidget
{
    protected static ?string $heading = 'Kategori Kegiatan (Distribusi)';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'md' => 6,
        'lg' => 3,
    ];

    protected function getData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();
        $cacheKey = 'chart_category_' . ($isMahasiswa ? 'user_' . $user->id : 'admin');

        return Cache::remember($cacheKey, 300, function () use ($isMahasiswa, $user) {
            $query = Logbook::query();
            if ($isMahasiswa) {
                $query->where('user_id', $user->id);
            }

            $activities = $query->select('kategori_kegiatan', DB::raw('count(*) as count'))
                ->groupBy('kategori_kegiatan')
                ->get();

            $labels = [];
            $data = [];

            foreach ($activities as $activity) {
                $labels[] = $activity->kategori_kegiatan;
                $data[] = $activity->count;
            }

            if (empty($data)) {
                $labels = ['Belum ada data'];
                $data = [0];
            }

            return [
                'datasets' => [
                    [
                        'data' => $data,
                        'backgroundColor' => [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#8b5cf6',
                            '#ec4899',
                            '#f43f5e',
                            '#06b6d4',
                            '#14b8a6',
                            '#6b7280',
                        ],
                    ],
                ],
                'labels' => $labels,
            ];
        });
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
