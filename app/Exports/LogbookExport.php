<?php

namespace App\Exports;

use App\Models\Logbook;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Database\Eloquent\Builder;

class LogbookExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithStyles
{
    public function __construct(
        protected ?string $from = null,
        protected ?string $to = null,
        protected ?int $userId = null
    ) {}

    public function query(): Builder
    {
        return Logbook::with('user')
            ->when($this->userId, fn($q) => $q->where('user_id', $this->userId))
            ->when($this->from, fn($q) => $q->whereDate('tanggal', '>=', $this->from))
            ->when($this->to, fn($q) => $q->whereDate('tanggal', '<=', $this->to))
            ->orderBy('tanggal');
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Mahasiswa',
            'Tanggal',
            'Hari Ke-',
            'Judul Kegiatan',
            'Kategori',
            'Jam Mulai',
            'Jam Selesai',
            'Status',
        ];
    }

    public function map($logbook): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $logbook->user->name,
            $logbook->tanggal->format('d/m/Y'),
            $logbook->hari_ke,
            $logbook->judul_kegiatan,
            $logbook->kategori_kegiatan,
            $logbook->jam_mulai->format('H:i'),
            $logbook->jam_selesai->format('H:i'),
            $logbook->status,
        ];
    }

    public function title(): string
    {
        return 'Logbook Magang';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 11]],
        ];
    }
}
