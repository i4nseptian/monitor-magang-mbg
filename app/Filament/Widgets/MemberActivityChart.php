<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Logbook;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MemberActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Aktivitas Anggota (Perbandingan Kegiatan)';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'md' => 6,
        'lg' => 4,
    ];

    protected function getData(): array
    {
        return Cache::remember('chart_member_activity', 300, function () {
            $mahasiswaList = User::role('mahasiswa')->get(['id', 'name']);
            $mahasiswaIds = $mahasiswaList->pluck('id');

            $counts = Logbook::select('user_id', DB::raw('count(*) as total'))
                ->whereIn('user_id', $mahasiswaIds)
                ->groupBy('user_id')
                ->pluck('total', 'user_id');

            $labels = [];
            $data = [];

            foreach ($mahasiswaList as $mhs) {
                $labels[] = $mhs->name;
                $data[] = $counts[$mhs->id] ?? 0;
            }

            if (empty($data)) {
                $labels = ['Belum ada mahasiswa'];
                $data = [0];
            }

            $colors = [
                '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6',
                '#ec4899', '#06b6d4', '#f43f5e', '#14b8a6',
                '#6366f1', '#d946ef', '#84cc16', '#e11d48',
            ];

            $bgColors = [];
            for ($i = 0; $i < count($data); $i++) {
                $bgColors[] = $colors[$i % count($colors)];
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Jumlah Logbook',
                        'data' => $data,
                        'backgroundColor' => $bgColors,
                        'borderRadius' => 6,
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
