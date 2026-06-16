<?php

namespace App\Filament\Widgets;

use App\Models\Documentation;
use App\Models\InternshipSetting;
use App\Models\Logbook;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = '60s';

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();

        $tglMulaiStr = InternshipSetting::getValue('tanggal_mulai', '2026-06-08');
        $tglSelesaiStr = InternshipSetting::getValue('tanggal_selesai', '2026-08-28');

        $tglMulai = Carbon::parse($tglMulaiStr);
        $tglSelesai = Carbon::parse($tglSelesaiStr);
        $tglSekarang = Carbon::now();

        $totalHariMagang = $tglMulai->diffInDays($tglSelesai) + 1;

        if ($tglSekarang->lt($tglMulai)) {
            $hariKe = 0;
            $progresPercent = 0;
        } elseif ($tglSekarang->gt($tglSelesai)) {
            $hariKe = $totalHariMagang;
            $progresPercent = 100;
        } else {
            $hariKe = $tglMulai->diffInDays($tglSekarang) + 1;
            $progresPercent = round(($hariKe / $totalHariMagang) * 100);
        }

        $logbookQuery = Logbook::query();
        if ($isMahasiswa) {
            $logbookQuery->where('user_id', $user->id);
        }
        $totalKegiatan = $logbookQuery->count();

        $docQuery = Documentation::query();
        if ($isMahasiswa) {
            $docQuery->where('user_id', $user->id);
        }
        $totalDokumentasi = $docQuery->count();

        $totalAnggota = Member::count();

        $logbookHariIni = Logbook::whereDate('tanggal', Carbon::today());
        if ($isMahasiswa) {
            $logbookHariIni->where('user_id', $user->id);
        }
        $totalHariIni = $logbookHariIni->count();

        $mingguKe = $hariKe > 0 ? ceil($hariKe / 7) : 0;
        $hariTersisa = max(0, $totalHariMagang - $hariKe);

        $todayIcon = $totalHariIni > 0 ? 'heroicon-m-check-badge' : 'heroicon-m-clock';
        $todayColor = $totalHariIni > 0 ? 'success' : 'warning';

        return [
            Stat::make('Hari Magang', "Hari ke-{$hariKe}")
                ->description("Minggu ke-{$mingguKe} dari {$totalHariMagang} hari")
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary')
                ->chart([max(0, $hariKe - 6), max(0, $hariKe - 5), max(0, $hariKe - 4), max(0, $hariKe - 3), max(0, $hariKe - 2), max(0, $hariKe - 1), $hariKe]),

            Stat::make('Progres Waktu', "{$progresPercent}%")
                ->description($hariTersisa > 0 ? "{$hariTersisa} hari tersisa" : 'Selesai')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([10, 30, $progresPercent])
                ->color(match (true) {
                    $progresPercent >= 100 => 'success',
                    $progresPercent >= 75 => 'warning',
                    $progresPercent >= 50 => 'info',
                    default => 'primary',
                }),

            Stat::make('Total Kegiatan', $totalKegiatan)
                ->description($isMahasiswa ? 'Logbook pribadi Anda' : 'Logbook seluruh mahasiswa')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Kegiatan Hari Ini', "{$totalHariIni} Input")
                ->description($totalHariIni > 0 ? 'Sudah mengisi logbook hari ini' : 'Belum ada logbook hari ini')
                ->descriptionIcon($todayIcon)
                ->color($todayColor),

            Stat::make('Total Dokumentasi', $totalDokumentasi)
                ->description($isMahasiswa ? 'Dokumentasi terunggah' : 'Galeri dokumentasi tim')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning'),

            Stat::make('Total Anggota', "{$totalAnggota} Mahasiswa")
                ->description('Bisnis Digital FEB UNM')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
