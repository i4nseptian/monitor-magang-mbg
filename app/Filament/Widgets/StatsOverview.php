<?php

namespace App\Filament\Widgets;

use App\Models\Documentation;
use App\Models\Logbook;
use App\Models\Member;
use App\Helpers\InternshipHelper;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = null;

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();
        $cacheKey = 'stats_overview_' . ($isMahasiswa ? 'user_' . $user->id : 'admin');

        return Cache::remember($cacheKey, 3600, function () use ($isMahasiswa, $user) {
            $progress = InternshipHelper::getProgress();
            $hariKe = $progress['hariKe'];
            $totalHariMagang = $progress['totalHari'];
            $progresPercent = $progress['persen'];

            $totalKegiatan = Logbook::when($isMahasiswa, fn($q) => $q->where('user_id', $user->id))->count();
            $totalDokumentasi = Documentation::when($isMahasiswa, fn($q) => $q->where('user_id', $user->id))->count();
            $totalAnggota = Member::count();
            $totalHariIni = Logbook::whereDate('tanggal', Carbon::today())
                ->when($isMahasiswa, fn($q) => $q->where('user_id', $user->id))
                ->count();

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
        });
    }
}
