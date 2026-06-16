<x-filament-panels::page>
    <div class="mx-auto max-w-3xl space-y-6">

        {{-- Header --}}
        <div class="rounded-xl border border-gray-200 bg-gradient-to-b from-white to-gray-50/50 p-8 text-center dark:border-gray-700 dark:from-gray-900 dark:to-gray-950/30">
            <img src="{{ asset('images/logo-mark.svg') }}" alt="InternTrack" class="mx-auto h-14 w-14">
            <h1 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">InternTrack</h1>
            <p class="mt-1 text-sm font-medium text-gray-500 dark:text-gray-400">Monitoring & Dokumentasi Magang · Diskominfo Makassar</p>
        </div>

        {{-- Tentang --}}
        <x-filament::section>
            <x-slot name="heading">Tentang Sistem</x-slot>
            <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                InternTrack adalah platform internal untuk mahasiswa magang Program Studi Bisnis Digital FEB UNM
                di Dinas Komunikasi dan Informatika Kota Makassar. Sistem ini memusatkan pencatatan logbook,
                dokumentasi foto, evaluasi mentor, dan pembuatan laporan akhir magang.
            </p>
        </x-filament::section>

        {{-- Fitur --}}
        <x-filament::section>
            <x-slot name="heading">Fitur Utama</x-slot>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach([
                    ['Logbook Harian', 'Catat kegiatan, jam, kategori, dan mood.'],
                    ['Dokumentasi Foto', 'Unggah bukti kegiatan magang.'],
                    ['Evaluasi Mentor', 'Feedback langsung dari pembimbing.'],
                    ['Skill Development', 'Pantau perkembangan skill dari awal hingga akhir.'],
                    ['Project Showcase', 'Dokumentasikan project yang dikerjakan.'],
                    ['Laporan PDF', 'Generate laporan harian hingga laporan akhir.'],
                    ['Dashboard Monitoring', 'Statistik dan grafik aktivitas real-time.'],
                    ['Portfolio', 'Ringkasan pencapaian setelah magang selesai.'],
                ] as [$title, $desc])
                    <div class="rounded-lg border border-gray-100 p-3 transition-all duration-200 hover:-translate-y-0.5 hover:border-primary-200 hover:shadow-md dark:border-gray-800 dark:hover:border-primary-800 dark:hover:bg-gray-900/60">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $title }}</p>
                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </x-filament::section>

        {{-- Tech --}}
        <x-filament::section>
            <x-slot name="heading">Teknologi</x-slot>
            <div class="flex flex-wrap gap-2">
                @foreach(['Laravel 12', 'Filament 3', 'MySQL', 'Tailwind CSS', 'DomPDF', 'Chart.js', 'Spatie Permission'] as $tech)
                    <span class="rounded-md border border-gray-200 bg-gray-50 px-2.5 py-1 text-xs font-medium text-gray-600 transition-all duration-200 hover:border-primary-300 hover:bg-primary-50 hover:text-primary-700 hover:shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-primary-700 dark:hover:bg-primary-950/30 dark:hover:text-primary-300">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        </x-filament::section>

        <p class="pb-4 text-center text-xs text-gray-400">
            InternTrack v1.0 · Dinas Komunikasi dan Informatika Kota Makassar
        </p>

    </div>
</x-filament-panels::page>
