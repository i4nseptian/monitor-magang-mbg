<x-filament-panels::page>
    <div class="space-y-6">

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-document-arrow-down" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Generate Laporan Akhir</span>
                </div>
            </x-slot>
            <x-slot name="description">Satu klik untuk mengunduh dokumen laporan akhir magang lengkap dalam format PDF.</x-slot>

            <div class="mt-4 rounded-2xl border border-brand-200/40 dark:border-brand-950/40 bg-gradient-to-br from-brand-50/50 via-white to-white dark:from-brand-950/15 dark:to-gray-900/30 p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
                    <div class="max-w-2xl space-y-1.5">
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                            <span class="flex h-5 w-5 items-center justify-center rounded-md bg-brand-100 dark:bg-brand-950/50 text-brand-600 dark:text-brand-400 text-[9px] font-extrabold">PDF</span>
                            Laporan Lengkap & Terstruktur
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                            Mencakup lembar cover resmi, profil instansi Diskominfo, timeline progres, rekapitulasi seluruh logbook kegiatan, foto-foto dokumentasi, grafik performa, lembar evaluasi mentor, serta kesimpulan akhir.
                        </p>
                    </div>
                    <x-filament::button wire:click="mountAction('generate_laporan_akhir')" icon="heroicon-o-arrow-down-tray" size="lg" class="shadow-md hover:shadow-lg hover:scale-[1.02] transition-all shrink-0">
                        Unduh Laporan Akhir
                    </x-filament::button>
                </div>
                <div class="mt-5 flex flex-wrap gap-2">
                    @foreach(['Cover Resmi', 'Profil Instansi', 'Timeline Magang', 'Rekap Logbook', 'Foto Kegiatan', 'Grafik Statistik', 'Evaluasi Mentor', 'Lampiran'] as $section)
                        <span class="rounded-lg border border-brand-100 dark:border-brand-900/40 bg-white dark:bg-gray-900/60 px-3 py-1.5 text-[10px] font-bold text-brand-600 dark:text-brand-400 shadow-sm transition-all hover:scale-105 hover:shadow-md hover:border-brand-300 dark:hover:border-brand-800">
                            {{ $section }}
                        </span>
                    @endforeach
                </div>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-slate-600 to-slate-700 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-adjustments-horizontal" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Konfigurasi Export Laporan</span>
                </div>
            </x-slot>
            
            <div class="grid grid-cols-1 gap-5 md:grid-cols-4 mt-4">
                <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4">
                    <label class="mb-2 block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Jenis Laporan</label>
                    <select wire:model.live="jenis_laporan"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-slate-800 dark:text-white shadow-sm transition-all focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                        <option value="harian">Laporan Harian</option>
                        <option value="mingguan">Laporan Mingguan</option>
                        <option value="bulanan">Laporan Bulanan</option>
                        <option value="akhir">Laporan Akhir Magang</option>
                    </select>
                </div>
                <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4">
                    <label class="mb-2 block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Dari Tanggal</label>
                    <input type="date" wire:model.live="tanggal_dari"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-slate-800 dark:text-white shadow-sm transition-all focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:[color-scheme:dark]">
                </div>
                <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4">
                    <label class="mb-2 block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Hingga Tanggal</label>
                    <input type="date" wire:model.live="tanggal_hingga"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-slate-800 dark:text-white shadow-sm transition-all focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:[color-scheme:dark]">
                </div>
                @if(!auth()->user()->isMahasiswa())
                <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4">
                    <label class="mb-2 block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Filter Mahasiswa</label>
                    <select wire:model.live="user_id"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-slate-800 dark:text-white shadow-sm transition-all focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                        <option value="">Semua Mahasiswa</option>
                        @foreach($mahasiswaList as $mhs)
                        <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-eye" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Preview Data Terpilih</span>
                </div>
            </x-slot>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6 mt-4">
                <x-stat-card label="Logbook" :value="$stats['totalLogbook']" color="primary" />
                <x-stat-card label="Dokumentasi" :value="$stats['totalDokumentasi']" color="warning" />
                <x-stat-card label="Catatan Mentor" :value="$stats['totalCatatanMentor']" color="info" />
                <x-stat-card label="Skill" :value="$stats['totalSkill']" color="success" />
                <x-stat-card label="Project" :value="$stats['totalProject']" color="danger" />
                <x-stat-card label="Kehadiran" :value="$stats['totalAttendance']" color="primary" />
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-document-text" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Jenis Dokumen Tersedia</span>
                </div>
            </x-slot>
            
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-4">
                @foreach([
                    ['title' => 'Laporan Harian', 'desc' => 'Daftar kegiatan per tanggal lengkap dengan status jam masuk/pulang serta deskripsi singkat.', 'icon' => 'heroicon-o-document-text'],
                    ['title' => 'Laporan Mingguan', 'desc' => 'Rangkuman aktivitas mingguan beserta evaluasi, total jam kontribusi, dan rekap tugas.', 'icon' => 'heroicon-o-document-duplicate'],
                    ['title' => 'Laporan Bulanan', 'desc' => 'Dashboard aktivitas bulanan dengan rekap absensi, grafik perkembangan divisi, dan foto unggahan.', 'icon' => 'heroicon-o-calendar'],
                    ['title' => 'Laporan Akhir Magang', 'desc' => 'Bundling berkas laporan akhir magang lengkap, terstruktur, siap cetak/kumpul ke dosen pembimbing.', 'icon' => 'heroicon-o-document-check', 'highlight' => true],
                ] as $type)
                    <div @class([
                        'rounded-2xl border p-5 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5',
                        'border-brand-200 bg-gradient-to-br from-brand-50/40 via-white to-white dark:border-brand-900/60 dark:from-brand-950/20 dark:to-gray-900/30' => $type['highlight'] ?? false,
                        'border-slate-200 bg-white hover:border-brand-200 dark:border-slate-800 dark:bg-gray-900/70 dark:hover:border-brand-900/60' => !($type['highlight'] ?? false),
                    ])>
                        <div class="flex items-start gap-4">
                            <div @class([
                                'flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border shadow-sm',
                                'bg-brand-50 border-brand-100 text-brand-600 dark:bg-brand-950 dark:border-brand-900 dark:text-brand-400' => $type['highlight'] ?? false,
                                'bg-slate-50 border-slate-100 text-slate-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400' => !($type['highlight'] ?? false),
                            ])>
                                <x-filament::icon icon="{{ $type['icon'] }}" class="h-5 w-5" />
                            </div>
                            <div class="space-y-1">
                                <h4 @class([
                                    'text-sm font-bold',
                                    'text-brand-800 dark:text-brand-300' => $type['highlight'] ?? false,
                                    'text-slate-800 dark:text-white' => !($type['highlight'] ?? false),
                                ])>{{ $type['title'] }}</h4>
                                <p class="text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $type['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>