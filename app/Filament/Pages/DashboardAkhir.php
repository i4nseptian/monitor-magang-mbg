<?php

namespace App\Filament\Pages;

use App\Models\Achievement;
use App\Models\Attendance;
use App\Models\Documentation;
use App\Models\InternshipSetting;
use App\Models\Logbook;
use App\Models\MentorNote;
use App\Models\Project;
use App\Models\SkillDevelopment;
use App\Models\Target;
use App\Models\User;
use App\Services\ReportService;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardAkhir extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.dashboard-akhir';

    protected static ?string $navigationLabel = 'Dashboard Akhir';

    protected static ?string $title = 'Dashboard Akhir Magang';

    protected static ?string $navigationGroup = 'Monitoring';

    protected static ?int $navigationSort = 4;

    public array $finalStats = [];
    public array $skillData = [];
    public array $categoryData = [];
    public array $moodData = [];
    public array $attendanceData = [];
    public array $weeklyLogbookData = [];
    public array $topLogbooks = [];

    public function mount(): void
    {
        $userId = Auth::user()->isMahasiswa() ? Auth::id() : null;

        $reportService = new ReportService();
        $this->finalStats = $reportService->getFinalStats($userId);

        // Skill chart data (nilai_awal vs nilai_akhir)
        $skills = SkillDevelopment::when($userId, fn ($q) => $q->where('user_id', $userId))->get();
        $this->skillData = [
            'labels' => $skills->pluck('skill_name')->toArray(),
            'awal' => $skills->pluck('nilai_awal')->toArray(),
            'akhir' => $skills->pluck('nilai_akhir')->map(fn ($v) => $v ?? 0)->toArray(),
        ];

        // Category chart data
        $categories = Logbook::when($userId, fn ($q) => $q->where('user_id', $userId))
            ->select('kategori_kegiatan', DB::raw('count(*) as total'))
            ->groupBy('kategori_kegiatan')
            ->orderByDesc('total')
            ->get();
        $this->categoryData = [
            'labels' => $categories->pluck('kategori_kegiatan')->toArray(),
            'values' => $categories->pluck('total')->toArray(),
        ];

        // Mood chart data
        $moods = Logbook::when($userId, fn ($q) => $q->where('user_id', $userId))
            ->select('mood', DB::raw('count(*) as total'))
            ->whereNotNull('mood')
            ->groupBy('mood')
            ->get();
        $this->moodData = [
            'labels' => $moods->pluck('mood')->toArray(),
            'values' => $moods->pluck('total')->toArray(),
        ];

        // Weekly logbook trend
        $weeklyLogs = Logbook::when($userId, fn ($q) => $q->where('user_id', $userId))
            ->select('hari_ke', DB::raw('count(*) as total'))
            ->groupBy('hari_ke')
            ->orderBy('hari_ke')
            ->get()
            ->groupBy(fn ($item) => ceil($item->hari_ke / 7));
        $weeklyLabels = [];
        $weeklyValues = [];
        foreach ($weeklyLogs as $week => $items) {
            $weeklyLabels[] = "Minggu ke-$week";
            $weeklyValues[] = $items->sum('total');
        }
        $this->weeklyLogbookData = [
            'labels' => $weeklyLabels,
            'values' => $weeklyValues,
        ];

        // Top recent logbooks
        $this->topLogbooks = Logbook::when($userId, fn ($q) => $q->where('user_id', $userId))
            ->with('user')
            ->orderByDesc('tanggal')
            ->limit(10)
            ->get()
            ->toArray();
    }
}
