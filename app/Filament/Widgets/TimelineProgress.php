<?php

namespace App\Filament\Widgets;

use App\Models\InternshipSetting;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class TimelineProgress extends Widget
{
    protected static string $view = 'filament.widgets.timeline-progress';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $tglMulaiStr = InternshipSetting::getValue('tanggal_mulai', '2026-06-08');
        $tglSelesaiStr = InternshipSetting::getValue('tanggal_selesai', '2026-08-28');

        $tglMulai = Carbon::parse($tglMulaiStr);
        $tglSelesai = Carbon::parse($tglSelesaiStr);
        $tglSekarang = Carbon::now();

        $totalHari = $tglMulai->diffInDays($tglSelesai) + 1;

        if ($tglSekarang->lt($tglMulai)) {
            $hariBerjalan = 0;
            $hariTersisa = $totalHari;
            $persen = 0;
        } elseif ($tglSekarang->gt($tglSelesai)) {
            $hariBerjalan = $totalHari;
            $hariTersisa = 0;
            $persen = 100;
        } else {
            $hariBerjalan = $tglMulai->diffInDays($tglSekarang) + 1;
            $hariTersisa = $totalHari - $hariBerjalan;
            $persen = round(($hariBerjalan / $totalHari) * 100);
        }

        return [
            'tanggal_mulai' => $tglMulai->translatedFormat('d F Y'),
            'tanggal_selesai' => $tglSelesai->translatedFormat('d F Y'),
            'total_hari' => $totalHari,
            'hari_berjalan' => $hariBerjalan,
            'hari_tersisa' => $hariTersisa,
            'persentase' => $persen,
        ];
    }
}
