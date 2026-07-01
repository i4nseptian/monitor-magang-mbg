<?php

namespace App\Filament\Widgets;

use App\Models\Logbook;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ActivityHeatmap extends Widget
{
    protected static string $view = 'filament.widgets.activity-heatmap';

    protected static ?int $sort = 8;

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();
        $cacheKey = 'heatmap_' . ($isMahasiswa ? 'user_' . $user->id : 'admin');

        return Cache::remember($cacheKey, 3600, function () use ($isMahasiswa, $user) {
            $driver = DB::getDriverName();
            $dateExpr = $driver === 'sqlite' ? "DATE(tanggal)" : "DATE(tanggal)";

            $rawCounts = Logbook::select($dateExpr . ' as tgl', DB::raw('count(*) as count'))
                ->where('tanggal', '>=', Carbon::today()->subDays(363))
                ->when($isMahasiswa, fn($q) => $q->where('user_id', $user->id))
                ->groupBy(DB::raw($dateExpr))
                ->pluck('count', 'tgl');

            $weeks = [];
            $start = Carbon::today()->subDays(363)->startOfWeek(Carbon::SUNDAY);
            $end = Carbon::today();

            $maxCount = max(1, $rawCounts->max() ?: 1);

            $current = $start->copy();
            while ($current->lte($end)) {
                $week = [];
                for ($d = 0; $d < 7; $d++) {
                    $dateStr = $current->format('Y-m-d');
                    $count = (int) ($rawCounts[$dateStr] ?? 0);
                    $level = $count === 0 ? 0 : min(4, (int) ceil(($count / $maxCount) * 4));
                    $week[] = [
                        'date' => $current->copy(),
                        'count' => $count,
                        'level' => $level,
                        'isToday' => $current->isToday(),
                    ];
                    $current->addDay();
                }
                $weeks[] = $week;
            }

            $months = [];
            $seenMonths = [];
            $cursor = $start->copy();
            $weekIdx = 0;
            while ($cursor->lte($end)) {
                $monthLabel = $cursor->translatedFormat('M');
                $monthKey = $cursor->format('Y-m');
                if (!in_array($monthKey, $seenMonths)) {
                    $seenMonths[] = $monthKey;
                    $months[] = ['label' => $monthLabel, 'weekIndex' => $weekIdx];
                }
                $cursor->addWeek();
                $weekIdx++;
            }

            return [
                'weeks' => $weeks,
                'months' => $months,
                'totalActiveDays' => $rawCounts->count(),
                'maxCount' => $maxCount,
            ];
        });
    }
}
