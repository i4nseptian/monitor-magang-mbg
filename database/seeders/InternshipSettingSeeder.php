<?php

namespace Database\Seeders;

use App\Models\InternshipSetting;
use Illuminate\Database\Seeder;

class InternshipSettingSeeder extends Seeder
{
    public function run(): void
    {
        InternshipSetting::setValue('tanggal_mulai', '2026-06-08', 'Tanggal mulai magang');
        InternshipSetting::setValue('tanggal_selesai', '2026-08-28', 'Tanggal selesai magang');
        InternshipSetting::setValue('instansi_nama', 'Dinas Komunikasi dan Informatika Kota Makassar', 'Nama Instansi Tempat Magang');
    }
}
