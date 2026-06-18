<?php

namespace App\Filament\Widgets;

use App\Models\Logbook;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TodayActivities extends Widget
{
    protected static string $view = 'filament.widgets.today-activities';

    protected static ?int $sort = 8;

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();

        $query = Logbook::whereDate('tanggal', Carbon::today())
            ->with('user:id,name')
            ->orderBy('created_at', 'desc');

        if ($isMahasiswa) {
            $query->where('user_id', $user->id);
        }

        return [
            'activities' => $query->get(),
            'is_mahasiswa' => $isMahasiswa,
        ];
    }
}
