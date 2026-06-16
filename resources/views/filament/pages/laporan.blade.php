<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Quick Final Report Generator --}}
        <x-filament::section>
            <x-slot name="heading">Generate Laporan Akhir</x-slot>
            <x-slot name="description">Satu klik untuk menghasilkan laporan akhir magang lengkap dalam format PDF.</x-slot>

            <div class="mt-4 rounded-xl border border-primary-200/60 bg-primary-50/50 p-6 dark:border-primary-900 dark:bg-primary-950/20">
                <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
                    <div class="max-w-xl">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Mencakup cover, profil instansi, timeline, rekap logbook, dokumentasi foto,
                            grafik aktivitas, evaluasi mentor, kesimpulan, dan lampiran.
                        </p>
                    </div>
                    <x-filament::button wire:click="mountAction('generate_laporan_akhir')" icon="heroicon-o-arrow-down-tray">
                        Generate PDF
                    </x-filament::button>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach(['Cover', 'Profil', 'Timeline', 'Logbook', 'Dokumentasi', 'Grafik', 'Evaluasi', 'Kesimpulan', 'Lampiran'] as $section)
                        <span class="rounded-md border border-gray-200 bg-white px-2.5 py-1 text-[11px] font-medium text-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            {{ $section }}
                        </span>
                    @endforeach
                </div>
            </div>
        </x-filament::section>

        {{-- Form Konfigurasi --}}
        <x-filament::section>
            <x-slot name="heading">Konfigurasi Laporan</x-slot>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Laporan</label>
                    <select wire:model.live="jenis_laporan"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        <option value="harian">Laporan Harian</option>
                        <option value="mingguan">Laporan Mingguan</option>
                        <option value="bulanan">Laporan Bulanan</option>
                        <option value="akhir">Laporan Akhir Magang</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                    <input type="date" wire:model.live="tanggal_dari"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Hingga Tanggal</label>
                    <input type="date" wire:model.live="tanggal_hingga"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                </div>
                @if(!auth()->user()->isMahasiswa())
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Filter Mahasiswa</label>
                    <select wire:model.live="user_id"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        <option value="">Semua Mahasiswa</option>
                        @foreach($mahasiswaList as $mhs)
                        <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
        </x-filament::section>

        {{-- Preview Stats --}}
        <x-filament::section>
            <x-slot name="heading">Preview Data</x-slot>
            <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-6">
                <x-stat-card label="Logbook" :value="$stats['totalLogbook']" />
                <x-stat-card label="Dokumentasi" :value="$stats['totalDokumentasi']" />
                <x-stat-card label="Catatan Mentor" :value="$stats['totalCatatanMentor']" />
                <x-stat-card label="Skill" :value="$stats['totalSkill']" />
                <x-stat-card label="Project" :value="$stats['totalProject']" />
                <x-stat-card label="Kehadiran" :value="$stats['totalAttendance']" />
            </div>
        </x-filament::section>

        {{-- Export Info --}}
        <x-filament::section>
            <x-slot name="heading">Jenis Laporan</x-slot>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                @foreach([
                    ['title' => 'Laporan Harian', 'desc' => 'Rekap kegiatan per tanggal beserta dokumentasi hari itu.'],
                    ['title' => 'Laporan Mingguan', 'desc' => 'Rekap kegiatan seminggu dengan statistik dan foto.'],
                    ['title' => 'Laporan Bulanan', 'desc' => 'Rekap aktivitas satu bulan lengkap dengan grafik.'],
                    ['title' => 'Laporan Akhir Magang', 'desc' => 'Dokumen lengkap dari cover hingga lampiran.', 'highlight' => true],
                ] as $type)
                    <div @class([
                        'rounded-xl border p-4',
                        'border-primary-200 bg-primary-50/40 dark:border-primary-900 dark:bg-primary-950/20' => $type['highlight'] ?? false,
                        'border-gray-200 dark:border-gray-700' => !($type['highlight'] ?? false),
                    ])>
                        <h4 @class([
                            'font-semibold',
                            'text-primary-800 dark:text-primary-300' => $type['highlight'] ?? false,
                            'text-gray-800 dark:text-white' => !($type['highlight'] ?? false),
                        ])>{{ $type['title'] }}</h4>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $type['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>
