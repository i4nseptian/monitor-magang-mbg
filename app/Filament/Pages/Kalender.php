<?php

namespace App\Filament\Pages;

use App\Models\Logbook;
use App\Models\Documentation;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Kalender extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.pages.kalender';

    protected static ?string $navigationLabel = 'Kalender Kegiatan';

    protected static ?string $title = 'Kalender Kegiatan Magang';

    protected static ?string $navigationGroup = 'Monitoring';

    protected static ?int $navigationSort = 2;

    public int $currentMonth;
    public int $currentYear;
    public string $currentMonthName;

    public function mount(): void
    {
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
        $this->updateMonthName();
    }

    public function prevMonth(): void
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->updateMonthName();
    }

    public function nextMonth(): void
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->updateMonthName();
    }

    protected function updateMonthName(): void
    {
        $this->currentMonthName = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)
            ->translatedFormat('F Y');
    }

    protected function getViewData(): array
    {
        $startOfMonth = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->endOfMonth();

        // Cari tanggal pertama dan terakhir grid kalender (termasuk offset hari di minggu sebelumnya/setelahnya)
        $startOfWeek = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $endOfMonth->copy()->endOfWeek(Carbon::SUNDAY);

        $days = [];
        $currentDay = $startOfWeek->copy();

        // Ambil data logbook & dokumentasi untuk bulan ini
        $userId = Auth::user()->isMahasiswa() ? Auth::id() : null;

        $logbooks = Logbook::with('user')
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->whereBetween('tanggal', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->get()
            ->groupBy(fn($l) => $l->tanggal->format('Y-m-d'));

        $documentations = Documentation::with('user')
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->whereBetween('tanggal', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->get()
            ->groupBy(fn($d) => $d->tanggal->format('Y-m-d'));

        while ($currentDay->lte($endOfWeek)) {
            $dateStr = $currentDay->format('Y-m-d');
            $isCurrentMonth = $currentDay->month === $this->currentMonth;

            $days[] = [
                'date' => $currentDay->copy(),
                'is_current_month' => $isCurrentMonth,
                'is_today' => $currentDay->isToday(),
                'logbooks' => $logbooks->get($dateStr, collect()),
                'documentations' => $documentations->get($dateStr, collect()),
            ];
            $currentDay->addDay();
        }

        // Group days by week (for mobile agenda view)
        $weeksGrouped = [];
        $currentWeek = [];
        foreach ($days as $i => $day) {
            $currentWeek[] = $day;
            if ($day['date']->dayOfWeek === Carbon::SUNDAY || $i === count($days) - 1) {
                if (!empty($currentWeek)) {
                    $weeksGrouped[] = $currentWeek;
                    $currentWeek = [];
                }
            }
        }

        return [
            'days' => $days,
            'weeksGrouped' => $weeksGrouped,
            'weeks' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        ];
    }
}
