<x-filament-panels::page>
    <div class="space-y-6 prose dark:prose-invert max-w-none">

        {{-- HERO --}}
        <div class="text-center py-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">InternTrack</h1>
            <p class="text-lg text-gray-500 dark:text-gray-400 mt-2">Sistem Monitoring & Dokumentasi Magang</p>
        </div>

        {{-- LATAR BELAKANG --}}
        <x-filament::section>
            <x-slot name="heading">Latar Belakang</x-slot>
            <p>
                InternTrack dikembangkan sebagai solusi untuk memonitoring, mendokumentasikan, dan melaporkan
                kegiatan magang mahasiswa secara digital. Sistem ini lahir dari kebutuhan mahasiswa magang
                di Dinas Komunikasi dan Informatika Kota Makassar untuk memiliki pusat dokumentasi yang
                terintegrasi, rapi, dan siap cetak kapan saja.
            </p>
            <p class="mt-2">
                Dengan InternTrack, mahasiswa dapat mencatat logbook harian, mengunggah dokumentasi foto,
                menerima evaluasi mentor, memantau perkembangan skill, dan menghasilkan laporan akhir magang
                hanya dengan satu klik.
            </p>
        </x-filament::section>

        {{-- MASALAH YANG DISELESAIKAN --}}
        <x-filament::section>
            <x-slot name="heading">Masalah yang Diselesaikan</x-slot>
            <ul>
                <li>Dokumentasi magang masih bersifat manual dan tersebar di berbagai file.</li>
                <li>Laporan akhir magang membutuhkan waktu lama untuk disusun.</li>
                <li>Tidak ada pusat data terintegrasi untuk logbook, dokumentasi, dan evaluasi.</li>
                <li>Sulit memantau perkembangan skill dan progress magang secara real-time.</li>
                <li>Data kegiatan magang rentan hilang karena tidak ada backup terpusat.</li>
            </ul>
        </x-filament::section>

        {{-- FITUR UTAMA --}}
        <x-filament::section>
            <x-slot name="heading">Fitur Utama</x-slot>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 not-prose">
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Logbook Harian</h4>
                    <p class="text-sm text-gray-500">Catat kegiatan harian dengan kategori, jam, mood, dan foto dokumentasi.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Dokumentasi & Galeri</h4>
                    <p class="text-sm text-gray-500">Upload foto kegiatan dengan caption, tampilan galeri yang rapi.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Evaluasi Mentor</h4>
                    <p class="text-sm text-gray-500">Mentor dapat memberikan catatan dan evaluasi langsung ke mahasiswa.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Skill Development</h4>
                    <p class="text-sm text-gray-500">Pantau perkembangan skill dari awal hingga akhir magang.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Project Showcase</h4>
                    <p class="text-sm text-gray-500">Tampilkan project yang dikerjakan selama magang.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Kehadiran</h4>
                    <p class="text-sm text-gray-500">Catat check-in dan check-out harian, pantau total jam kerja.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Laporan Akhir Otomatis</h4>
                    <p class="text-sm text-gray-500">Generate laporan akhir magang (PDF) dengan satu klik, lengkap cover hingga lampiran.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Dashboard Monitoring</h4>
                    <p class="text-sm text-gray-500">Pantau statistik real-time: grafik aktivitas, kategori, mood, dan progress.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Portfolio Pribadi</h4>
                    <p class="text-sm text-gray-500">Setelah magang, web bisa berubah menjadi portfolio pribadi.</p>
                </div>
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold">Export Excel & PDF</h4>
                    <p class="text-sm text-gray-500">Export data ke Excel untuk backup atau analisis lanjutan.</p>
                </div>
            </div>
        </x-filament::section>

        {{-- TECH STACK --}}
        <x-filament::section>
            <x-slot name="heading">Tech Stack</x-slot>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 not-prose">
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">Laravel 12</span>
                    <p class="text-xs text-gray-500">Framework Backend</p>
                </div>
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">MySQL</span>
                    <p class="text-xs text-gray-500">Database</p>
                </div>
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">Filament 3</span>
                    <p class="text-xs text-gray-500">Admin Panel</p>
                </div>
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">Tailwind CSS</span>
                    <p class="text-xs text-gray-500">Styling</p>
                </div>
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">Chart.js</span>
                    <p class="text-xs text-gray-500">Grafik & Visualisasi</p>
                </div>
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">SweetAlert2</span>
                    <p class="text-xs text-gray-500">Notifikasi</p>
                </div>
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">DomPDF</span>
                    <p class="text-xs text-gray-500">Generate PDF</p>
                </div>
                <div class="border rounded-lg p-3 text-center dark:border-gray-700">
                    <span class="font-semibold text-sm">Spatie</span>
                    <p class="text-xs text-gray-500">Permission & Activity Log</p>
                </div>
            </div>
        </x-filament::section>

        {{-- ARSITEKTUR --}}
        <x-filament::section>
            <x-slot name="heading">Arsitektur Database (ERD)</x-slot>
            <p class="text-sm">Berikut adalah struktur database utama InternTrack:</p>
            <div class="mt-4 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    <li><strong>users</strong> - Data pengguna (admin, mentor, mahasiswa)</li>
                    <li><strong>members</strong> - Profil lengkap mahasiswa magang</li>
                    <li><strong>logbooks</strong> - Catatan kegiatan harian + mood</li>
                    <li><strong>logbook_photos</strong> - Foto dokumentasi per logbook</li>
                    <li><strong>documentations</strong> - Dokumentasi kegiatan umum</li>
                    <li><strong>documentation_photos</strong> - Foto per dokumentasi</li>
                    <li><strong>mentor_notes</strong> - Catatan & evaluasi mentor</li>
                    <li><strong>skill_developments</strong> - Perkembangan skill</li>
                    <li><strong>achievements</strong> - Pencapaian mahasiswa</li>
                    <li><strong>projects</strong> - Project showcase</li>
                    <li><strong>weekly_summaries</strong> - Ringkasan mingguan</li>
                    <li><strong>attendances</strong> - Kehadiran harian</li>
                    <li><strong>targets</strong> - Target & progress</li>
                    <li><strong>internship_settings</strong> - Konfigurasi sistem</li>
                </ul>
            </div>
        </x-filament::section>

        {{-- FOOTER --}}
        <div class="text-center text-sm text-gray-400 dark:text-gray-600 py-6 border-t">
            <p>InternTrack v1.0 | Dibangun dengan Laravel & Filament</p>
            <p class="mt-1">Dinas Komunikasi dan Informatika Kota Makassar</p>
        </div>

    </div>
</x-filament-panels::page>
