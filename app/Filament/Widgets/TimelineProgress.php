<?php

namespace App\Filament\Widgets;

use App\Helpers\InternshipHelper;
use Filament\Widgets\Widget;

class TimelineProgress extends Widget
{
    protected static string $view = 'filament.widgets.timeline-progress';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'lg' => 7,
    ];

    protected function getViewData(): array
    {
        [$tglMulai, $tglSelesai] = InternshipHelper::getDateRange();
        $progress = InternshipHelper::getProgress();

        return [
            'tanggal_mulai' => $tglMulai->translatedFormat('d F Y'),
            'tanggal_selesai' => $tglSelesai->translatedFormat('d F Y'),
            'total_hari' => $progress['totalHari'],
            'hari_berjalan' => $progress['hariBerjalan'],
            'hari_tersisa' => $progress['hariTersisa'],
            'persentase' => $progress['persen'],
        ];
    }
}
