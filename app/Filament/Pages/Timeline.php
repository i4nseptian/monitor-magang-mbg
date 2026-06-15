<?php

namespace App\Filament\Pages;

use App\Models\Logbook;
use App\Models\User;
use App\Models\InternshipSetting;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Timeline extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static string $view = 'filament.pages.timeline';

    protected static ?string $navigationLabel = 'Timeline Magang';

    protected static ?string $title = 'Timeline & Progres Magang';

    protected static ?string $navigationGroup = 'Monitoring';

    protected static ?int $navigationSort = 3;

    public ?int $selectedUserId = null;

    public function mount(): void
    {
        if (Auth::user()->isMahasiswa()) {
            $this->selectedUserId = Auth::id();
        }
    }

    protected function getViewData(): array
    {
        $mahasiswaList = User::role('mahasiswa')->get();

        $tglMulai = Carbon::parse(InternshipSetting::getValue('tanggal_mulai', '2026-06-08'));
        $tglSelesai = Carbon::parse(InternshipSetting::getValue('tanggal_selesai', '2026-08-28'));
        $totalDays = max(1, $tglMulai->diffInDays($tglSelesai) + 1);

        $now = Carbon::now();
        $daysElapsed = min($totalDays, max(0, $tglMulai->diffInDays($now) + 1));
        $progressPercent = round(($daysElapsed / $totalDays) * 100);

        // Ambil data logbook diurutkan berdasarkan tanggal terbaru
        $timelineEvents = Logbook::with(['user', 'photos'])
            ->when($this->selectedUserId, fn($q) => $q->where('user_id', $this->selectedUserId))
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->paginate(15);

        return [
            'mahasiswaList' => $mahasiswaList,
            'timelineEvents' => $timelineEvents,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
            'totalDays' => $totalDays,
            'daysElapsed' => $daysElapsed,
            'progressPercent' => $progressPercent,
        ];
    }
}
