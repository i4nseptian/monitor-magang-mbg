<?php

namespace App\Filament\Pages;

use App\Models\Logbook;
use App\Models\SkillDevelopment;
use App\Services\ReportService;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
    public array $weeklyLogbookData = [];

    public function mount(): void
    {
        $userId = Auth::user()->isMahasiswa() ? Auth::id() : null;
        $cacheKey = 'dashboard_akhir_' . ($userId ?? 'all');

        $cached = Cache::remember($cacheKey, 3600, function () use ($userId) {
            $reportService = new ReportService();
            $finalStats = $reportService->getFinalStats($userId);

            $base = $userId ? [['user_id', '=', $userId]] : [];

            $skills = SkillDevelopment::where($base)->get(['skill_name', 'nilai_awal', 'nilai_akhir']);
            $skillData = [
                'labels' => $skills->pluck('skill_name')->toArray(),
                'awal' => $skills->pluck('nilai_awal')->toArray(),
                'akhir' => $skills->pluck('nilai_akhir')->map(fn ($v) => $v ?? 0)->toArray(),
            ];

            $categories = Logbook::where($base)
                ->select('kategori_kegiatan', DB::raw('count(*) as total'))
                ->groupBy('kategori_kegiatan')
                ->orderByDesc('total')
                ->get();
            $categoryData = [
                'labels' => $categories->pluck('kategori_kegiatan')->toArray(),
                'values' => $categories->pluck('total')->toArray(),
            ];

            $moods = Logbook::where($base)
                ->select('mood', DB::raw('count(*) as total'))
                ->whereNotNull('mood')
                ->groupBy('mood')
                ->get();
            $moodData = [
                'labels' => $moods->pluck('mood')->toArray(),
                'values' => $moods->pluck('total')->toArray(),
            ];

            $weeklyLogs = Logbook::where($base)
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
            $weeklyLogbookData = [
                'labels' => $weeklyLabels,
                'values' => $weeklyValues,
            ];

            return compact('finalStats', 'skillData', 'categoryData', 'moodData', 'weeklyLogbookData');
        });

        $this->finalStats = $cached['finalStats'];
        $this->skillData = $cached['skillData'];
        $this->categoryData = $cached['categoryData'];
        $this->moodData = $cached['moodData'];
        $this->weeklyLogbookData = $cached['weeklyLogbookData'];
    }
}
