<?php

namespace App\Filament\Widgets;

use App\Models\Logbook;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MoodAnalytics extends Widget
{
    protected static string $view = 'filament.widgets.mood-analytics';

    protected static ?int $sort = 10;

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();
        $cacheKey = 'mood_analytics_' . ($isMahasiswa ? 'user_' . $user->id : 'admin');

        return Cache::remember($cacheKey, 3600, function () use ($isMahasiswa, $user) {
            $query = Logbook::whereNotNull('mood')
                ->when($isMahasiswa, fn($q) => $q->where('user_id', $user->id));

            $totals = (clone $query)
                ->select('mood', DB::raw('count(*) as total'))
                ->groupBy('mood')
                ->pluck('total', 'mood');

            $grandTotal = $totals->sum();
            $denominator = max($grandTotal, 1);

            $series = [];
            $labels = [];
            $percentages = [];
            $moodOrder = ['😀 Mudah', '🙂 Normal', '😐 Cukup Sulit', '😵 Sangat Sulit'];

            foreach ($moodOrder as $m) {
                $count = (int) ($totals[$m] ?? 0);
                $series[] = $count;
                $labels[] = $m;
                $percentages[] = round(($count / $denominator) * 100);
            }

            return [
                'series' => $series,
                'labels' => $labels,
                'percentages' => $percentages,
                'total' => $grandTotal,
            ];
        });
    }
}
