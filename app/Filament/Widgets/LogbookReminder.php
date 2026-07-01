<?php

namespace App\Filament\Widgets;

use App\Models\Logbook;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LogbookReminder extends Widget
{
    protected static string $view = 'filament.widgets.logbook-reminder';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'default' => 'full',
        'lg' => 5,
    ];

    protected function getViewData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();
        $hasSubmittedToday = false;
        $missingStudents = [];

        if ($isMahasiswa) {
            $hasSubmittedToday = Logbook::where('user_id', $user->id)
                ->whereDate('tanggal', Carbon::today())
                ->exists();
        } else {
            $missingStudents = User::mahasiswa()
                ->whereNotIn('id', function ($q) {
                    $q->select('user_id')
                        ->from('logbooks')
                        ->whereDate('tanggal', Carbon::today());
                })
                ->pluck('name')
                ->toArray();
        }

        return [
            'is_mahasiswa' => $isMahasiswa,
            'has_submitted_today' => $hasSubmittedToday,
            'missing_students' => $missingStudents,
        ];
    }
}
