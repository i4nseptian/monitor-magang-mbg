<x-filament-panels::page>
    <div class="space-y-6">
        <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
            <x-stat-card label="Total Logbook" :value="$finalStats['total_logbook']" color="primary" />
            <x-stat-card label="Foto Dokumentasi" :value="$finalStats['total_foto']" color="warning" />
            <x-stat-card label="Total Project" :value="$finalStats['total_project']" color="success" />
            <x-stat-card label="Evaluasi Mentor" :value="$finalStats['total_evaluasi']" color="info" />
            <x-stat-card label="Skill Terdata" :value="$finalStats['total_skills']" color="primary" />
            <x-stat-card label="Pencapaian" :value="$finalStats['total_achievements']" color="success" />
            <x-stat-card label="Total Kehadiran" :value="$finalStats['total_hadir']" color="info" />
            <x-stat-card label="Persentase Kehadiran" :value="$finalStats['persen_hadir'] . '%'" color="warning" />
        </div>

        <x-filament::section>
            <x-slot name="heading">Ringkasan Magang</x-slot>
            <div class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-lg border border-gray-100 bg-gray-50/80 p-4 dark:border-gray-800 dark:bg-gray-900/40">
                    <p class="text-xs font-medium text-gray-500">Periode</p>
                    <p class="mt-1 font-semibold text-gray-900 dark:text-white">{{ $finalStats['tgl_mulai']->format('d M Y') }} – {{ $finalStats['tgl_selesai']->format('d M Y') }}</p>
                </div>
                <div class="rounded-lg border border-gray-100 bg-gray-50/80 p-4 dark:border-gray-800 dark:bg-gray-900/40">
                    <p class="text-xs font-medium text-gray-500">Total Hari</p>
                    <p class="mt-1 font-semibold text-gray-900 dark:text-white">{{ $finalStats['total_hari'] }} hari</p>
                </div>
                <div class="rounded-lg border border-gray-100 bg-gray-50/80 p-4 dark:border-gray-800 dark:bg-gray-900/40">
                    <p class="text-xs font-medium text-gray-500">Kategori Terbanyak</p>
                    <p class="mt-1 font-semibold text-gray-900 dark:text-white">{{ $finalStats['top_category'] }} ({{ $finalStats['top_category_count'] }})</p>
                </div>
                <div class="rounded-lg border border-gray-100 bg-gray-50/80 p-4 dark:border-gray-800 dark:bg-gray-900/40">
                    <p class="text-xs font-medium text-gray-500">Total Dokumentasi</p>
                    <p class="mt-1 font-semibold text-gray-900 dark:text-white">{{ $finalStats['total_dokumentasi'] }}</p>
                </div>
            </div>
        </x-filament::section>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <x-filament::section>
                <x-slot name="heading">Perkembangan Skill</x-slot>
                <div class="relative" style="max-height:250px">
                    <canvas id="skillChart"></canvas>
                </div>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">Distribusi Kategori</x-slot>
                <div class="relative" style="max-height:250px">
                    <canvas id="categoryChart"></canvas>
                </div>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">Distribusi Mood</x-slot>
                <div class="relative" style="max-height:250px">
                    <canvas id="moodChart"></canvas>
                </div>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">Tren Logbook Mingguan</x-slot>
                <div class="relative" style="max-height:250px">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </x-filament::section>
        </div>

        <x-filament::section>
            <x-slot name="heading">Detail Kategori Pekerjaan</x-slot>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="py-2.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Kategori</th>
                            <th class="py-2.5 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($finalStats['category_distribution'] as $cat)
                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-900/40">
                            <td class="py-2.5 text-gray-800 dark:text-gray-200">{{ $cat['kategori_kegiatan'] }}</td>
                            <td class="py-2.5 text-right font-semibold tabular-nums text-gray-900 dark:text-white">{{ $cat['total'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-filament::section>
    </div>

    @push('scripts')
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const brandColors = ['#1e3a5f', '#486581', '#627d98', '#829ab1', '#38bdf8', '#0ea5e9', '#334e68', '#102a43'];
            const defaults = { responsive: true, maintainAspectRatio: true, plugins: { legend: { labels: { boxWidth: 12, padding: 16, font: { size: 11 } } } } };

            const skillLabels = @json($skillData['labels']);
            if (skillLabels.length) {
                new Chart(document.getElementById('skillChart'), {
                    type: 'bar',
                    data: {
                        labels: skillLabels,
                        datasets: [
                            { label: 'Awal', data: @json($skillData['awal']), backgroundColor: '#bcccdc', borderRadius: 4 },
                            { label: 'Akhir', data: @json($skillData['akhir']), backgroundColor: '#1e3a5f', borderRadius: 4 }
                        ]
                    },
                    options: { ...defaults, scales: { y: { beginAtZero: true, max: 100 } } }
                });
            }

            const catLabels = @json($categoryData['labels']);
            if (catLabels.length) {
                new Chart(document.getElementById('categoryChart'), {
                    type: 'doughnut',
                    data: { labels: catLabels, datasets: [{ data: @json($categoryData['values']), backgroundColor: brandColors, borderWidth: 0 }] },
                    options: defaults
                });
            }

            const moodLabels = @json($moodData['labels']);
            if (moodLabels.length) {
                new Chart(document.getElementById('moodChart'), {
                    type: 'pie',
                    data: { labels: moodLabels, datasets: [{ data: @json($moodData['values']), backgroundColor: ['#1e3a5f','#486581','#627d98','#38bdf8'], borderWidth: 0 }] },
                    options: defaults
                });
            }

            const weeklyLabels = @json($weeklyLogbookData['labels']);
            if (weeklyLabels.length) {
                new Chart(document.getElementById('weeklyChart'), {
                    type: 'line',
                    data: {
                        labels: weeklyLabels,
                        datasets: [{
                            label: 'Logbook',
                            data: @json($weeklyLogbookData['values']),
                            borderColor: '#1e3a5f',
                            backgroundColor: 'rgba(30, 58, 95, 0.08)',
                            fill: true, tension: 0.35,
                            pointBackgroundColor: '#1e3a5f', pointRadius: 3
                        }]
                    },
                    options: { ...defaults, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                });
            }
        });
    </script>
    @endpush
</x-filament-panels::page>
