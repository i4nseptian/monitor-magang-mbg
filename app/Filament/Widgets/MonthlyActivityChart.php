<?php

namespace App\Filament\Widgets;

use App\Models\Logbook;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonthlyActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Aktivitas Bulanan (Logbook)';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'md' => 6,
        'lg' => 8,
    ];

    protected function getData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();

        $query = Logbook::query();
        if ($isMahasiswa) {
            $query->where('user_id', $user->id);
        }

        $activities = $query->select(
            DB::raw('MONTH(tanggal) as month_num'),
            DB::raw('count(*) as count')
        )
        ->groupBy(DB::raw('MONTH(tanggal)'))
        ->orderBy('month_num', 'asc')
        ->get();

        $labels = [];
        $data = [];

        foreach ($activities as $activity) {
            $labels[] = Carbon::create()->month($activity->month_num)->translatedFormat('F');
            $data[] = $activity->count;
        }

        if (empty($data)) {
            $labels = ['Belum ada data'];
            $data = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kegiatan',
                    'data' => $data,
                    'borderColor' => '#059669',
                    'backgroundColor' => 'rgba(5, 150, 105, 0.08)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#059669',
                    'pointBorderColor' => '#fff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                    'borderWidth' => 3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
