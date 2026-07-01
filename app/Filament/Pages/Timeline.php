<?php

namespace App\Filament\Pages;

use App\Models\Logbook;
use App\Models\User;
use App\Helpers\InternshipHelper;
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
    public ?string $kategoriFilter = null;
    public ?string $searchQuery = null;

    public function mount(): void
    {
        if (Auth::user()->isMahasiswa()) {
            $this->selectedUserId = Auth::id();
        }
    }

    protected function getViewData(): array
    {
        $mahasiswaList = User::mahasiswa()->get();

        [$tglMulai, $tglSelesai] = InternshipHelper::getDateRange();
        $progress = InternshipHelper::getProgress();
        $totalDays = $progress['totalHari'];
        $daysElapsed = $progress['hariBerjalan'];
        $progressPercent = $progress['persen'];

        $kategoriList = Logbook::select('kategori_kegiatan')
            ->distinct()
            ->orderBy('kategori_kegiatan')
            ->pluck('kategori_kegiatan')
            ->toArray();

        $timelineEvents = Logbook::with(['user', 'photos'])
            ->when($this->selectedUserId, fn($q) => $q->where('user_id', $this->selectedUserId))
            ->when($this->kategoriFilter, fn($q) => $q->where('kategori_kegiatan', $this->kategoriFilter))
            ->when($this->searchQuery, fn($q) => $q->where('judul_kegiatan', 'like', '%' . $this->searchQuery . '%'))
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
            'kategoriList' => $kategoriList,
        ];
    }
}
