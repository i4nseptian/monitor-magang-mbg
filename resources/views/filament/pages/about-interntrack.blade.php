<x-filament-panels::page>
    <div class="mx-auto max-w-4xl space-y-6">

        <div class="rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-gradient-to-b from-white via-slate-50/30 to-white dark:from-gray-900 dark:to-gray-950/50 p-8 text-center shadow-sm hover:shadow-md transition-all duration-300">
            <div class="relative mx-auto h-16 w-16 p-1 rounded-2xl bg-white dark:bg-gray-800 shadow-lg transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('images/logo-mark.svg') }}" alt="InternTrack" class="h-full w-full">
            </div>
            <h1 class="mt-5 text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-display">InternTrack</h1>
            <p class="mt-1.5 text-xs font-bold text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-accent-cyan dark:from-brand-400 dark:to-accent-cyan uppercase tracking-widest">Sistem Monitoring & Dokumentasi Magang</p>
            <p class="text-xs font-medium text-slate-400 dark:text-slate-500 mt-1">Dinas Komunikasi dan Informatika Kota Makassar</p>
        </div>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-information-circle" class="h-4 w-4" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Tentang Sistem</span>
                </div>
            </x-slot>
            <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-400 font-light mt-2">
                InternTrack dirancang khusus untuk mempermudah tata kelola administrasi dan monitoring mahasiswa magang program studi <strong class="font-bold text-slate-800 dark:text-slate-200">Bisnis Digital FEB Universitas Negeri Makassar (UNM)</strong> yang sedang melaksanakan praktik kerja lapangan di <strong class="font-bold text-slate-800 dark:text-slate-200">Dinas Komunikasi dan Informatika Kota Makassar</strong>. Platform ini mengintegrasikan seluruh pencatatan dari aktivitas harian hingga finalisasi berkas.
            </p>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-list-bullet" class="h-4 w-4" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Modul & Fitur Utama</span>
                </div>
            </x-slot>
            
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mt-4">
                @foreach([
                    ['Logbook Harian', 'Catat detail kegiatan harian, kategori tugas, total jam kerja, serta indikator mood.', 'heroicon-o-pencil-square'],
                    ['Dokumentasi Foto', 'Unggah bukti autentik pelaksanaan tugas lapangan langsung di dalam logbook.', 'heroicon-o-camera'],
                    ['Evaluasi Mentor', 'Dapatkan review, komentar bimbingan, dan evaluasi berkala langsung dari mentor.', 'heroicon-o-chat-bubble-left-right'],
                    ['Skill Development', 'Monitoring grafik progres perkembangan hardskill/softskill dari awal hingga akhir periode.', 'heroicon-o-arrow-trending-up'],
                    ['Project Showcase', 'Pendataan dan dokumentasi project atau produk digital yang berhasil diselesaikan.', 'heroicon-o-cube'],
                    ['Export Laporan PDF', 'Otomatisasi cetak berkas laporan magang harian, mingguan, bulanan, dan laporan akhir.', 'heroicon-o-document-arrow-down'],
                    ['Kalender Monitoring', 'Visualisasi agenda bulanan yang merangkum data kehadiran serta logbook harian.', 'heroicon-o-calendar'],
                    ['Portfolio Cetak', 'Ringkasan visual berisi seluruh pencapaian mahasiswa setelah masa magang selesai.', 'heroicon-o-user-circle'],
                ] as [$title, $desc, $icon])
                    <div class="group flex items-start gap-3 rounded-xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/50 p-4 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 hover:border-brand-200 dark:hover:border-brand-900/60">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-brand-50 to-brand-100 text-brand-600 dark:from-brand-950 dark:to-brand-900 dark:text-brand-400 shadow-sm transition-transform duration-300 group-hover:scale-110">
                            <x-filament::icon icon="{{ $icon }}" class="h-5 w-5" />
                        </div>
                        <div class="space-y-1">
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">{{ $title }}</p>
                            <p class="text-[11px] leading-relaxed text-slate-500 dark:text-slate-400 font-light">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-slate-600 to-slate-700 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-code-bracket" class="h-4 w-4" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Teknologi Pendukung</span>
                </div>
            </x-slot>
            
            <div class="flex flex-wrap gap-2 mt-4">
                @foreach(['Laravel 12', 'Filament v3', 'Tailwind CSS v4', 'Vite Bundler', 'DomPDF Engine', 'Chart.js Visual', 'MySQL DB', 'AlpineJS Framework', 'Spatie Shield'] as $tech)
                    <span class="rounded-lg border border-slate-200 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-gray-800 dark:to-gray-900/50 px-3.5 py-1.5 text-xs font-bold text-slate-600 dark:text-slate-400 shadow-sm transition-all duration-200 hover:border-brand-300 hover:bg-brand-50/50 hover:text-brand-700 hover:-translate-y-0.5 hover:shadow-md dark:hover:border-brand-900 dark:hover:bg-brand-950/20 dark:hover:text-brand-400">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        </x-filament::section>

        <p class="pb-6 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
            InternTrack v1.2 · Dinas Komunikasi dan Informatika Kota Makassar
        </p>

    </div>
</x-filament-panels::page>