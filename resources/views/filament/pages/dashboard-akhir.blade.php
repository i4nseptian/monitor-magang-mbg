<x-filament-panels::page>
    <div class="space-y-6">
        {{-- STATS CARDS --}}
        <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
            <x-stat-card label="Total Logbook" :value="$finalStats['total_logbook']" />
            <x-stat-card label="Foto Dokumentasi" :value="$finalStats['total_foto']" />
            <x-stat-card label="Total Project" :value="$finalStats['total_project']" />
            <x-stat-card label="Evaluasi Mentor" :value="$finalStats['total_evaluasi']" />
            <x-stat-card label="Skill Terdata" :value="$finalStats['total_skills']" />
            <x-stat-card label="Pencapaian" :value="$finalStats['total_achievements']" />
            <x-stat-card label="Total Kehadiran" :value="$finalStats['total_hadir']" />
            <x-stat-card label="Persentase Kehadiran" :value="$finalStats['persen_hadir'] . '%'" />
        </div>

        {{-- INFO --}}
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

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <x-filament::section>
                <x-slot name="heading">Perkembangan Skill</x-slot>
                <canvas id="skillChart" style="max-height:250px"></canvas>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">Distribusi Kategori</x-slot>
                <canvas id="categoryChart" style="max-height:250px"></canvas>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">Distribusi Mood</x-slot>
                <canvas id="moodChart" style="max-height:250px"></canvas>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">Tren Logbook Mingguan</x-slot>
                <canvas id="weeklyChart" style="max-height:250px"></canvas>
            </x-filament::section>
        </div>

        {{-- Kategori Distribution Table --}}
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
                        <tr>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const brandColors = ['#1e3a5f', '#486581', '#627d98', '#829ab1', '#38bdf8', '#0ea5e9', '#334e68', '#102a43'];
            const chartDefaults = { responsive: true, plugins: { legend: { labels: { boxWidth: 12, padding: 16 } } } };

            const skillCtx = document.getElementById('skillChart');
            if (skillCtx) {
                new Chart(skillCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($skillData['labels']),
                        datasets: [
                            { label: 'Awal', data: @json($skillData['awal']), backgroundColor: '#bcccdc', borderRadius: 4 },
                            { label: 'Akhir', data: @json($skillData['akhir']), backgroundColor: '#1e3a5f', borderRadius: 4 }
                        ]
                    },
                    options: { ...chartDefaults, scales: { y: { beginAtZero: true, max: 100 } } }
                });
            }

            const catCtx = document.getElementById('categoryChart');
            if (catCtx) {
                new Chart(catCtx, {
                    type: 'doughnut',
                    data: {
                        labels: @json($categoryData['labels']),
                        datasets: [{ data: @json($categoryData['values']), backgroundColor: brandColors, borderWidth: 0 }]
                    },
                    options: chartDefaults
                });
            }

            const moodCtx = document.getElementById('moodChart');
            if (moodCtx) {
                new Chart(moodCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($moodData['labels']),
                        datasets: [{ data: @json($moodData['values']), backgroundColor: ['#1e3a5f', '#486581', '#627d98', '#38bdf8'], borderWidth: 0 }]
                    },
                    options: chartDefaults
                });
            }

            const weeklyCtx = document.getElementById('weeklyChart');
            if (weeklyCtx) {
                new Chart(weeklyCtx, {
                    type: 'line',
                    data: {
                        labels: @json($weeklyLogbookData['labels']),
                        datasets: [{
                            label: 'Logbook',
                            data: @json($weeklyLogbookData['values']),
                            borderColor: '#1e3a5f',
                            backgroundColor: 'rgba(30, 58, 95, 0.08)',
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: '#1e3a5f',
                            pointRadius: 3
                        }]
                    },
                    options: { ...chartDefaults, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                });
            }
        });
    </script>
    @endpush
</x-filament-panels::page>
