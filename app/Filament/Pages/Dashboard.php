<?php

namespace App\Filament\Pages;

use App\Models\InternshipSetting;
use App\Models\Project;
use App\Models\Target;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 0;

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\TimelineProgress::class,
            \App\Filament\Widgets\LogbookReminder::class,
            \App\Filament\Widgets\WeeklyActivityChart::class,
            \App\Filament\Widgets\CategoryPieChart::class,
            \App\Filament\Widgets\MonthlyActivityChart::class,
            \App\Filament\Widgets\MemberActivityChart::class,
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

        $totalHari = (int) $tglMulai->diffInDays($tglSelesai) + 1;
        if ($now->lt($tglMulai)) {
            $hariKe = 0;
        } elseif ($now->gt($tglSelesai)) {
            $hariKe = $totalHari;
        } else {
            $hariKe = (int) $tglMulai->diffInDays($now) + 1;
        }

        $roleLabel = match (true) {
            $user->isAdmin() => 'Super Admin',
            $user->isMentor() => 'Mentor',
            $user->isMahasiswa() => 'Peserta Magang',
            default => 'Pengguna',
        };

        // Deadline data: upcoming targets & projects nearing deadline
        $hariTersisa = max(0, $totalHari - $hariKe);
        $deadlines = collect();

        if (!$user->isMahasiswa()) {
            // Mentor/Admin: ambil semua target dengan deadline
            $upcomingTargets = Target::with('user:id,name')
                ->whereNotNull('target_date')
                ->where('target_date', '>=', $now->toDateString())
                ->where('progress', '<', 100)
                ->orderBy('target_date')
                ->limit(5)
                ->get();
            $deadlines = $deadlines->merge($upcomingTargets->map(fn ($t) => [
                'type' => 'target',
                'title' => $t->target_name,
                'date' => $t->target_date,
                'user_name' => $t->user?->name,
                'remaining_days' => $now->diffInDays($t->target_date, false) + 1,
            ]));

            $upcomingProjects = Project::with('user:id,name')
                ->where('status_project', 'Sedang Dikerjakan')
                ->orderBy('created_at')
                ->limit(5)
                ->get();
            $deadlines = $deadlines->merge($upcomingProjects->map(fn ($p) => [
                'type' => 'project',
                'title' => $p->judul,
                'date' => null,
                'user_name' => $p->user?->name,
                'remaining_days' => null,
            ]));
        } else {
            $upcomingTargets = Target::where('user_id', $user->id)
                ->whereNotNull('target_date')
                ->where('target_date', '>=', $now->toDateString())
                ->where('progress', '<', 100)
                ->orderBy('target_date')
                ->limit(5)
                ->get();
            $deadlines = $deadlines->merge($upcomingTargets->map(fn ($t) => [
                'type' => 'target',
                'title' => $t->target_name,
                'date' => $t->target_date,
                'user_name' => null,
                'remaining_days' => $now->diffInDays($t->target_date, false) + 1,
            ]));

            $upcomingProjects = Project::where('user_id', $user->id)
                ->where('status_project', 'Sedang Dikerjakan')
                ->orderBy('created_at')
                ->limit(5)
                ->get();
            $deadlines = $deadlines->merge($upcomingProjects->map(fn ($p) => [
                'type' => 'project',
                'title' => $p->judul,
                'date' => null,
                'user_name' => null,
                'remaining_days' => null,
            ]));
        }

        $deadlines = $deadlines->sortBy('remaining_days')->take(5);

        return view('filament.pages.dashboard-header', [
            'user' => $user,
            'roleLabel' => $roleLabel,
            'hariKe' => $hariKe,
            'hariTersisa' => $hariTersisa,
            'totalHari' => $totalHari,
            'deadlines' => $deadlines,
        ]);
    }
}