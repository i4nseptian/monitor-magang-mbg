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

    protected static ?int $sort = 0;

    protected int | string | array $columnSpan = 'full';

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
            $todaySubmitters = Logbook::whereDate('tanggal', Carbon::today())
                ->pluck('user_id')
                ->toArray();

            $students = User::role('mahasiswa')->get();
            foreach ($students as $student) {
                if (!in_array($student->id, $todaySubmitters)) {
                    $missingStudents[] = $student->name;
                }
            }
        }

        return [
            'is_mahasiswa' => $isMahasiswa,
            'has_submitted_today' => $hasSubmittedToday,
            'missing_students' => $missingStudents,
        ];
    }
}
