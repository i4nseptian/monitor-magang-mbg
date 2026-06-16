<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Quick Final Report Generator --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-document-text" class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                    Generate Laporan Akhir
                </div>
            </x-slot>
            <x-slot name="description">Satu klik untuk menghasilkan laporan akhir magang lengkap dalam format PDF.</x-slot>

            <div class="mt-4 rounded-xl border border-primary-200/60 bg-gradient-to-br from-primary-50/80 to-white p-6 shadow-sm transition-all duration-300 hover:shadow-md dark:border-primary-900 dark:from-primary-950/30 dark:to-gray-900/30">
                <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
                    <div class="max-w-xl">
                        <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                            Mencakup cover, profil instansi, timeline, rekap logbook, dokumentasi foto,
                            grafik aktivitas, evaluasi mentor, kesimpulan, dan lampiran.
                        </p>
                    </div>
                    <x-filament::button wire:click="mountAction('generate_laporan_akhir')" icon="heroicon-o-arrow-down-tray">
                        Generate PDF
                    </x-filament::button>
                </div>
                <div class="mt-4 flex flex-wrap gap-1.5">
                    @foreach(['Cover', 'Profil', 'Timeline', 'Logbook', 'Dokumentasi', 'Grafik', 'Evaluasi', 'Kesimpulan', 'Lampiran'] as $section)
                        <span class="rounded-md border border-primary-200/50 bg-white/80 px-2.5 py-1 text-[11px] font-medium text-primary-700 shadow-sm transition-all duration-200 hover:shadow hover:scale-105 dark:border-primary-800 dark:bg-gray-900/60 dark:text-primary-300">
                            {{ $section }}
                        </span>
                    @endforeach
                </div>
            </div>
        </x-filament::section>

        {{-- Form Konfigurasi --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-adjustments-horizontal" class="h-5 w-5 text-gray-500 dark:text-gray-400" />
                    Konfigurasi Laporan
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Laporan</label>
                    <select wire:model.live="jenis_laporan"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 transition-all duration-200 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        <option value="harian">Laporan Harian</option>
                        <option value="mingguan">Laporan Mingguan</option>
                        <option value="bulanan">Laporan Bulanan</option>
                        <option value="akhir">Laporan Akhir Magang</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                    <input type="date" wire:model.live="tanggal_dari"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 transition-all duration-200 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Hingga Tanggal</label>
                    <input type="date" wire:model.live="tanggal_hingga"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 transition-all duration-200 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                </div>
                @if(!auth()->user()->isMahasiswa())
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Filter Mahasiswa</label>
                    <select wire:model.live="user_id"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 transition-all duration-200 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
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
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-eye" class="h-5 w-5 text-gray-500 dark:text-gray-400" />
                    Preview Data
                </div>
            </x-slot>
            <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-6">
                <x-stat-card label="Logbook" :value="$stats['totalLogbook']" color="primary" />
                <x-stat-card label="Dokumentasi" :value="$stats['totalDokumentasi']" color="warning" />
                <x-stat-card label="Catatan Mentor" :value="$stats['totalCatatanMentor']" color="info" />
                <x-stat-card label="Skill" :value="$stats['totalSkill']" color="success" />
                <x-stat-card label="Project" :value="$stats['totalProject']" color="danger" />
                <x-stat-card label="Kehadiran" :value="$stats['totalAttendance']" color="primary" />
            </div>
        </x-filament::section>

        {{-- Export Info --}}
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-document" class="h-5 w-5 text-gray-500 dark:text-gray-400" />
                    Jenis Laporan
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                @foreach([
                    ['title' => 'Laporan Harian', 'desc' => 'Rekap kegiatan per tanggal beserta dokumentasi hari itu.', 'icon' => 'heroicon-o-document-text'],
                    ['title' => 'Laporan Mingguan', 'desc' => 'Rekap kegiatan seminggu dengan statistik dan foto.', 'icon' => 'heroicon-o-document-duplicate'],
                    ['title' => 'Laporan Bulanan', 'desc' => 'Rekap aktivitas satu bulan lengkap dengan grafik.', 'icon' => 'heroicon-o-calendar'],
                    ['title' => 'Laporan Akhir Magang', 'desc' => 'Dokumen lengkap dari cover hingga lampiran.', 'icon' => 'heroicon-o-document-check', 'highlight' => true],
                ] as $type)
                    <div @class([
                        'rounded-xl border p-4 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5',
                        'border-primary-200 bg-gradient-to-br from-primary-50/60 to-white dark:border-primary-900 dark:from-primary-950/30 dark:to-gray-900/30' => $type['highlight'] ?? false,
                        'border-gray-200 bg-white hover:border-primary-200 dark:border-gray-700 dark:bg-gray-900 dark:hover:border-primary-800' => !($type['highlight'] ?? false),
                    ])>
                        <div class="flex items-start gap-3">
                            <div @class([
                                'flex h-8 w-8 shrink-0 items-center justify-center rounded-lg',
                                'bg-primary-100 text-primary-700 dark:bg-primary-950 dark:text-primary-300' => $type['highlight'] ?? false,
                                'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400' => !($type['highlight'] ?? false),
                            ])>
                                <x-filament::icon icon="{{ $type['icon'] }}" class="h-4 w-4" />
                            </div>
                            <div>
                                <h4 @class([
                                    'font-semibold',
                                    'text-primary-800 dark:text-primary-300' => $type['highlight'] ?? false,
                                    'text-gray-800 dark:text-white' => !($type['highlight'] ?? false),
                                ])>{{ $type['title'] }}</h4>
                                <p class="mt-1 text-sm leading-relaxed text-gray-500 dark:text-gray-400">{{ $type['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>