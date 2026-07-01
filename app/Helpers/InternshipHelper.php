<?php

namespace App\Helpers;

use App\Models\InternshipSetting;
use Illuminate\Support\Carbon;

class InternshipHelper
{
    public static function getDateRange(): array
    {
        $mulai = InternshipSetting::getValue('tanggal_mulai', config('intern.default_tanggal_mulai'));
        $selesai = InternshipSetting::getValue('tanggal_selesai', config('intern.default_tanggal_selesai'));
        return [
            Carbon::parse($mulai),
            Carbon::parse($selesai),
        ];
    }

    public static function getProgress(): array
    {
        [$tglMulai, $tglSelesai] = self::getDateRange();
        $now = Carbon::now();
        $totalHari = (int) $tglMulai->diffInDays($tglSelesai) + 1;

        if ($now->lt($tglMulai)) {
            return [
                'hariKe' => 0,
                'hariBerjalan' => 0,
                'hariTersisa' => $totalHari,
                'totalHari' => $totalHari,
                'persen' => 0,
            ];
        }

        if ($now->gt($tglSelesai)) {
            return [
                'hariKe' => $totalHari,
                'hariBerjalan' => $totalHari,
                'hariTersisa' => 0,
                'totalHari' => $totalHari,
                'persen' => 100,
            ];
        }

        $hariKe = (int) $tglMulai->diffInDays($now) + 1;
        return [
            'hariKe' => $hariKe,
            'hariBerjalan' => $hariKe,
            'hariTersisa' => $totalHari - $hariKe,
            'totalHari' => $totalHari,
            'persen' => round(($hariKe / $totalHari) * 100),
        ];
    }

    public static function getAppVersion(): string
    {
        return config('intern.version', '1.0');
    }
}
