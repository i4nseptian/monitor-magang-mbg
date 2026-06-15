<?php

namespace App\Filament\Pages;

use App\Models\InternshipSetting;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?string $navigationLabel = 'Pengaturan Sistem';

    protected static ?string $title = 'Pengaturan Sistem & Periode Magang';

    protected static ?string $navigationGroup = 'Sistem & Keamanan';

    protected static ?int $navigationSort = 3;

    public ?string $nama_instansi = null;
    public ?string $tanggal_mulai = null;
    public ?string $tanggal_selesai = null;

    public function mount(): void
    {
        abort_unless(Auth::user()->hasRole('super_admin'), 403);

        $this->nama_instansi = InternshipSetting::getValue('nama_instansi', 'Dinas Komunikasi dan Informatika Kota Makassar');
        $this->tanggal_mulai = InternshipSetting::getValue('tanggal_mulai', '2026-06-08');
        $this->tanggal_selesai = InternshipSetting::getValue('tanggal_selesai', '2026-08-28');
    }

    public function save(): void
    {
        InternshipSetting::setValue('nama_instansi', $this->nama_instansi);
        InternshipSetting::setValue('tanggal_mulai', $this->tanggal_mulai);
        InternshipSetting::setValue('tanggal_selesai', $this->tanggal_selesai);

        Notification::make()
            ->title('Pengaturan Berhasil Disimpan')
            ->success()
            ->send();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->hasRole('super_admin') ?? false;
    }
}
