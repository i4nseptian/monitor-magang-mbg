<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Quick Final Report Generator --}}
        <x-filament::section>
            <x-slot name="heading">Generate Laporan Akhir (Sekali Klik)</x-slot>
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/20 dark:to-indigo-950/20 rounded-xl border border-blue-200 dark:border-blue-800 p-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-blue-800 dark:text-blue-400">Laporan Akhir Magang Lengkap</h3>
                        <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">
                            Generate otomatis: Cover, Profil Instansi, Timeline Kegiatan, Rekap Logbook Mingguan,
                            Dokumentasi Foto, Grafik Aktivitas, Evaluasi Mentor, Kesimpulan, Lampiran.
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" wire:click="mountAction('generate_laporan_akhir')"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Generate Laporan Akhir
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-3 md:grid-cols-9 gap-2 mt-4 text-center text-xs">
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Cover</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Profil Instansi</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Timeline</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Rekap Logbook</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Dokumentasi</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Grafik</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Evaluasi</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Kesimpulan</span>
                    <span class="bg-white dark:bg-gray-800 rounded-lg py-2 px-1 shadow-sm">Lampiran</span>
                </div>
            </div>
        </x-filament::section>

        {{-- Form Konfigurasi --}}
        <x-filament::section>
            <x-slot name="heading">Konfigurasi Laporan</x-slot>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Laporan</label>
                    <select wire:model.live="jenis_laporan"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="harian">Laporan Harian</option>
                        <option value="mingguan">Laporan Mingguan</option>
                        <option value="bulanan">Laporan Bulanan</option>
                        <option value="akhir">Laporan Akhir Magang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dari Tanggal</label>
                    <input type="date" wire:model.live="tanggal_dari"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hingga Tanggal</label>
                    <input type="date" wire:model.live="tanggal_hingga"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                @if(!auth()->user()->isMahasiswa())
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter Mahasiswa</label>
                    <select wire:model.live="user_id"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="rounded-xl bg-blue-50 dark:bg-blue-950/30 p-4 border border-blue-100 dark:border-blue-900">
                    <p class="text-2xl font-bold text-blue-700 dark:text-blue-400">{{ $stats['totalLogbook'] }}</p>
                    <p class="text-xs text-blue-600 dark:text-blue-500 mt-1">Logbook</p>
                </div>
                <div class="rounded-xl bg-green-50 dark:bg-green-950/30 p-4 border border-green-100 dark:border-green-900">
                    <p class="text-2xl font-bold text-green-700 dark:text-green-400">{{ $stats['totalDokumentasi'] }}</p>
                    <p class="text-xs text-green-600 dark:text-green-500 mt-1">Dokumentasi</p>
                </div>
                <div class="rounded-xl bg-purple-50 dark:bg-purple-950/30 p-4 border border-purple-100 dark:border-purple-900">
                    <p class="text-2xl font-bold text-purple-700 dark:text-purple-400">{{ $stats['totalCatatanMentor'] }}</p>
                    <p class="text-xs text-purple-600 dark:text-purple-500 mt-1">Catatan Mentor</p>
                </div>
                <div class="rounded-xl bg-orange-50 dark:bg-orange-950/30 p-4 border border-orange-100 dark:border-orange-900">
                    <p class="text-2xl font-bold text-orange-700 dark:text-orange-400">{{ $stats['totalSkill'] }}</p>
                    <p class="text-xs text-orange-600 dark:text-orange-500 mt-1">Skill</p>
                </div>
                <div class="rounded-xl bg-cyan-50 dark:bg-cyan-950/30 p-4 border border-cyan-100 dark:border-cyan-900">
                    <p class="text-2xl font-bold text-cyan-700 dark:text-cyan-400">{{ $stats['totalProject'] }}</p>
                    <p class="text-xs text-cyan-600 dark:text-cyan-500 mt-1">Project</p>
                </div>
                <div class="rounded-xl bg-pink-50 dark:bg-pink-950/30 p-4 border border-pink-100 dark:border-pink-900">
                    <p class="text-2xl font-bold text-pink-700 dark:text-pink-400">{{ $stats['totalAttendance'] }}</p>
                    <p class="text-xs text-pink-600 dark:text-pink-500 mt-1">Kehadiran</p>
                </div>
            </div>
        </x-filament::section>

        {{-- Export Info --}}
        <x-filament::section>
            <x-slot name="heading">Jenis Laporan Tersedia</x-slot>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Laporan Harian</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Rekap kegiatan per tanggal beserta dokumentasi hari itu.</p>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Laporan Mingguan</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Rekap kegiatan seminggu dengan statistik dan foto dokumentasi.</p>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Laporan Bulanan</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Rekap aktivitas satu bulan lengkap dengan grafik kategori.</p>
                </div>
                <div class="rounded-xl border border-blue-200 dark:border-blue-700 p-4 bg-blue-50/50 dark:bg-blue-950/20">
                    <h4 class="font-semibold text-blue-800 dark:text-blue-400 mb-1">Laporan Akhir Magang</h4>
                    <p class="text-sm text-blue-600 dark:text-blue-500">Cover, Profil Instansi, Timeline, Rekap Logbook, Dokumentasi, Grafik, Evaluasi, Kesimpulan, Lampiran.</p>
                </div>
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>
