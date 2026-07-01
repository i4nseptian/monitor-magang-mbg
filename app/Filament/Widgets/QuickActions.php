<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class QuickActions extends Widget
{
    protected static string $view = 'filament.widgets.quick-actions';

    protected static ?int $sort = 9;

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $user = Auth::user();
        $isMahasiswa = $user->isMahasiswa();
        $isAdmin = $user->isAdmin();

        $actions = [];

        if ($isMahasiswa) {
            $actions[] = ['label' => 'Buat Logbook Baru', 'icon' => 'pencil', 'url' => '/admin/logbooks/create', 'color' => 'indigo'];
            $actions[] = ['label' => 'Lihat Kalender', 'icon' => 'calendar', 'url' => '/admin/kalender', 'color' => 'emerald'];
            $actions[] = ['label' => 'Download Portfolio', 'icon' => 'document-arrow-down', 'url' => '/admin/portfolio/export', 'color' => 'amber'];
        }

        if ($user->isMentor()) {
            $actions[] = ['label' => 'Beri Catatan', 'icon' => 'chat-bubble-left-right', 'url' => '/admin/mentor-notes/create', 'color' => 'indigo'];
            $actions[] = ['label' => 'Lihat Logbook', 'icon' => 'document-text', 'url' => '/admin/logbooks', 'color' => 'emerald'];
        }

        if ($isAdmin) {
            $actions[] = ['label' => 'Tambah Mahasiswa', 'icon' => 'user-plus', 'url' => '/admin/members/create', 'color' => 'indigo'];
            $actions[] = ['label' => 'Semua Logbook', 'icon' => 'document-text', 'url' => '/admin/logbooks', 'color' => 'emerald'];
            $actions[] = ['label' => 'Export Data', 'icon' => 'arrow-down-tray', 'url' => '/admin/laporan', 'color' => 'amber'];
        }

        $actions[] = ['label' => 'Pengaturan', 'icon' => 'cog-6-tooth', 'url' => '/admin/settings', 'color' => 'slate'];

        return ['actions' => $actions];
    }
}
