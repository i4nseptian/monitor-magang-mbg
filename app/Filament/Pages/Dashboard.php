<?php

namespace App\Filament\Pages;

use App\Models\InternshipSetting;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard';

    protected static ?int $navigationSort = -1;

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\LogbookReminder::class,
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\TimelineProgress::class,
            \App\Filament\Widgets\WeeklyActivityChart::class,
            \App\Filament\Widgets\MonthlyActivityChart::class,
            \App\Filament\Widgets\MemberActivityChart::class,
            \App\Filament\Widgets\CategoryPieChart::class,
            \App\Filament\Widgets\TodayActivities::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    public function getHeader(): ?\Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        $tglMulaiStr = InternshipSetting::getValue('tanggal_mulai', '2026-06-08');
        $tglSelesaiStr = InternshipSetting::getValue('tanggal_selesai', '2026-08-28');
        $tglMulai = Carbon::parse($tglMulaiStr);
        $tglSelesai = Carbon::parse($tglSelesaiStr);
        $now = Carbon::now();

        $totalHari = $tglMulai->diffInDays($tglSelesai) + 1;
        if ($now->lt($tglMulai)) {
            $hariKe = 0;
        } elseif ($now->gt($tglSelesai)) {
            $hariKe = $totalHari;
        } else {
            $hariKe = $tglMulai->diffInDays($now) + 1;
        }

        $roleLabel = match (true) {
            $user->isAdmin() => 'Super Admin',
            $user->isMentor() => 'Mentor',
            $user->isMahasiswa() => 'Peserta Magang',
            default => 'Pengguna',
        };

        $roleColor = match (true) {
            $user->isAdmin() => 'from-purple-600 to-blue-600',
            $user->isMentor() => 'from-emerald-500 to-teal-600',
            $user->isMahasiswa() => 'from-blue-500 to-indigo-600',
            default => 'from-gray-500 to-gray-600',
        };

        return view('filament.pages.dashboard-header', [
            'user' => $user,
            'roleLabel' => $roleLabel,
            'roleColor' => $roleColor,
            'hariKe' => $hariKe,
        ]);
    }
}