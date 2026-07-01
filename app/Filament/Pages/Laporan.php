<?php

namespace App\Filament\Pages;

use App\Exports\LogbookExport;
use App\Models\Logbook;
use App\Models\User;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class Laporan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static string $view = 'filament.pages.laporan';

    protected static ?string $navigationLabel = 'Export Laporan';

    protected static ?string $title = 'Generate & Export Laporan';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 1;

    public ?string $jenis_laporan = 'harian';
    public ?string $tanggal_dari = null;
    public ?string $tanggal_hingga = null;
    public ?int $user_id = null;

    public function mount(): void
    {
        $this->tanggal_dari = Carbon::now()->startOfMonth()->toDateString();
        $this->tanggal_hingga = Carbon::now()->toDateString();
        if (Auth::user()->isMahasiswa()) {
            $this->user_id = Auth::id();
        }
    }

    public function generateLaporanAkhir(): mixed
    {
        $this->jenis_laporan = 'akhir';
        $this->tanggal_dari = Carbon::parse(\App\Models\InternshipSetting::getValue('tanggal_mulai', config('intern.default_tanggal_mulai')))->toDateString();
        $this->tanggal_hingga = Carbon::parse(\App\Models\InternshipSetting::getValue('tanggal_selesai', config('intern.default_tanggal_selesai')))->toDateString();
        return $this->exportPdf();
    }

    public function exportPdf(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $reportService = new ReportService();

        if ($this->jenis_laporan === 'akhir') {
            $settings = \App\Models\InternshipSetting::all()->keyBy('key');
            $this->tanggal_dari = $settings->get('tanggal_mulai')?->value ?? config('intern.default_tanggal_mulai');
            $this->tanggal_hingga = $settings->get('tanggal_selesai')?->value ?? config('intern.default_tanggal_selesai');
        }

        $data = $reportService->getData($this->jenis_laporan, $this->tanggal_dari, $this->tanggal_hingga, $this->user_id);

        $view = match ($this->jenis_laporan) {
            'harian' => 'reports.laporan-harian',
            'mingguan' => 'reports.laporan-mingguan',
            'bulanan' => 'reports.laporan-bulanan',
            'akhir' => 'reports.laporan-akhir',
            default => 'reports.laporan-harian',
        };

        $pdf = Pdf::loadView($view, $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isPhpEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'defaultFont' => 'sans-serif',
            ]);

        $filename = 'interntrack-' . $this->jenis_laporan . '-' . now()->format('Y-m-d') . '.pdf';

        return response()->streamDownload(
            fn() => print($pdf->output()),
            $filename
        );
    }

    public function exportExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $filename = 'logbook-' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new LogbookExport($this->tanggal_dari, $this->tanggal_hingga, $this->user_id), $filename);
    }

    protected function getViewData(): array
    {
        $mahasiswaList = User::mahasiswa()->get();

        // Preview stats
        $reportService = new ReportService();
        $stats = $reportService->getQuickStats($this->user_id);

        return [
            'mahasiswaList' => $mahasiswaList,
            'stats' => $stats,
        ];
    }
}
