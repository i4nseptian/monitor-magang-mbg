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
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-information-circle" class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                    Ringkasan Magang
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-4 text-sm sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl border border-gray-100 bg-gradient-to-br from-gray-50 to-white p-4 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 dark:border-gray-800 dark:from-gray-900/60 dark:to-gray-900/20">
                    <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400">
                        <x-filament::icon icon="heroicon-o-calendar-days" class="h-4 w-4" />
                        Periode
                    </div>
                    <p class="mt-1.5 text-sm font-semibold tabular-nums text-gray-900 dark:text-white">{{ $finalStats['tgl_mulai']->format('d M Y') }} – {{ $finalStats['tgl_selesai']->format('d M Y') }}</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-gradient-to-br from-gray-50 to-white p-4 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 dark:border-gray-800 dark:from-gray-900/60 dark:to-gray-900/20">
                    <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400">
                        <x-filament::icon icon="heroicon-o-clock" class="h-4 w-4" />
                        Total Hari
                    </div>
                    <p class="mt-1.5 text-sm font-semibold tabular-nums text-gray-900 dark:text-white">{{ $finalStats['total_hari'] }} hari</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-gradient-to-br from-gray-50 to-white p-4 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 dark:border-gray-800 dark:from-gray-900/60 dark:to-gray-900/20">
                    <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400">
                        <x-filament::icon icon="heroicon-o-tag" class="h-4 w-4" />
                        Kategori Terbanyak
                    </div>
                    <p class="mt-1.5 text-sm font-semibold text-gray-900 dark:text-white">{{ $finalStats['top_category'] }}</p>
                    <p class="text-[11px] text-gray-400 tabular-nums dark:text-gray-500">{{ $finalStats['top_category_count'] }} kegiatan</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-gradient-to-br from-gray-50 to-white p-4 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 dark:border-gray-800 dark:from-gray-900/60 dark:to-gray-900/20">
                    <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400">
                        <x-filament::icon icon="heroicon-o-photo" class="h-4 w-4" />
                        Total Dokumentasi
                    </div>
                    <p class="mt-1.5 text-sm font-semibold tabular-nums text-gray-900 dark:text-white">{{ $finalStats['total_dokumentasi'] }}</p>
                </div>
            </div>
        </x-filament::section>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-chart-bar-square" class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                        Perkembangan Skill
                    </div>
                </x-slot>
                <div class="relative flex items-center justify-center" style="height:250px">
                    <canvas id="skillChart" class="max-h-full max-w-full"></canvas>
                </div>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-chart-pie" class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                        Distribusi Kategori
                    </div>
                </x-slot>
                <div class="relative flex items-center justify-center" style="height:250px">
                    <canvas id="categoryChart" class="max-h-full max-w-full"></canvas>
                </div>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-face-smile" class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                        Distribusi Mood
                    </div>
                </x-slot>
                <div class="relative flex items-center justify-center" style="height:250px">
                    <canvas id="moodChart" class="max-h-full max-w-full"></canvas>
                </div>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-chart-bar" class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                        Tren Logbook Mingguan
                    </div>
                </x-slot>
                <div class="relative flex items-center justify-center" style="height:250px">
                    <canvas id="weeklyChart" class="max-h-full max-w-full"></canvas>
                </div>
            </x-filament::section>
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-list-bullet" class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                        Detail Kategori Pekerjaan
                </div>
            </x-slot>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Kategori</th>
                            <th class="py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($finalStats['category_distribution'] as $cat)
                        <tr class="transition-all duration-200 hover:bg-gray-50 hover:scale-[1.005] dark:hover:bg-gray-900/40">
                            <td class="py-3 text-gray-800 dark:text-gray-200">{{ $cat['kategori_kegiatan'] }}</td>
                            <td class="py-3 text-right font-bold tabular-nums text-gray-900 dark:text-white">{{ $cat['total'] }}</td>
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
            function isDark() { return document.documentElement.classList.contains('dark'); }

            const darkBrand = ['#60a5fa', '#818cf8', '#a5b4fc', '#c7d2fe', '#38bdf8', '#0ea5e9', '#93c5fd', '#7dd3fc'];
            const lightBrand = ['#1e3a5f', '#486581', '#627d98', '#829ab1', '#38bdf8', '#0ea5e9', '#334e68', '#102a43'];

            function renderCharts() {
                const dark = isDark();
                const brandColors = dark ? darkBrand : lightBrand;
                const gridColor = dark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';
                const tickColor = dark ? '#9ca3af' : '#6b7280';
                const fontColor = dark ? '#d1d5db' : '#374151';

                const defaults = {
                    responsive: true, maintainAspectRatio: true,
                    plugins: {
                        legend: { labels: { boxWidth: 12, padding: 16, font: { size: 11, color: fontColor } } }
                    },
                    animation: { duration: 800, easing: 'easeOutQuart' },
                    scales: { x: { grid: { color: gridColor }, ticks: { color: tickColor } }, y: { grid: { color: gridColor }, ticks: { color: tickColor } } }
                };

                const skillLabels = @json($skillData['labels']);
                const skillChart = Chart.getChart('skillChart');
                if (skillChart) skillChart.destroy();
                if (skillLabels.length) {
                    new Chart(document.getElementById('skillChart'), {
                        type: 'bar',
                        data: {
                            labels: skillLabels,
                            datasets: [
                                { label: 'Awal', data: @json($skillData['awal']), backgroundColor: dark ? '#4b7a9e' : '#bcccdc', borderRadius: 4 },
                                { label: 'Akhir', data: @json($skillData['akhir']), backgroundColor: dark ? '#93c5fd' : '#1e3a5f', borderRadius: 4 }
                            ]
                        },
                        options: { ...defaults, scales: { ...defaults.scales, y: { ...defaults.scales.y, beginAtZero: true, max: 100 } } }
                    });
                }

                const catLabels = @json($categoryData['labels']);
                const catChart = Chart.getChart('categoryChart');
                if (catChart) catChart.destroy();
                if (catLabels.length) {
                    new Chart(document.getElementById('categoryChart'), {
                        type: 'doughnut',
                        data: { labels: catLabels, datasets: [{ data: @json($categoryData['values']), backgroundColor: brandColors, borderWidth: 0 }] },
                        options: { ...defaults, scales: undefined }
                    });
                }

                const moodLabels = @json($moodData['labels']);
                const moodChart = Chart.getChart('moodChart');
                if (moodChart) moodChart.destroy();
                if (moodLabels.length) {
                    new Chart(document.getElementById('moodChart'), {
                        type: 'pie',
                        data: { labels: moodLabels, datasets: [{ data: @json($moodData['values']), backgroundColor: brandColors.slice(0,4), borderWidth: 0 }] },
                        options: { ...defaults, scales: undefined }
                    });
                }

                const weeklyLabels = @json($weeklyLogbookData['labels']);
                const weeklyChart = Chart.getChart('weeklyChart');
                if (weeklyChart) weeklyChart.destroy();
                if (weeklyLabels.length) {
                    new Chart(document.getElementById('weeklyChart'), {
                        type: 'line',
                        data: {
                            labels: weeklyLabels,
                            datasets: [{
                                label: 'Logbook',
                                data: @json($weeklyLogbookData['values']),
                                borderColor: dark ? '#93c5fd' : '#1e3a5f',
                                backgroundColor: dark ? 'rgba(147, 197, 253, 0.12)' : 'rgba(30, 58, 95, 0.08)',
                                fill: true, tension: 0.35,
                                pointBackgroundColor: dark ? '#93c5fd' : '#1e3a5f',
                                pointRadius: 3, pointHoverRadius: 6
                            }]
                        },
                        options: { ...defaults, scales: { ...defaults.scales, y: { ...defaults.scales.y, beginAtZero: true, ticks: { stepSize: 1 } } } }
                    });
                }
            }

            renderCharts();
            const observer = new MutationObserver(() => renderCharts());
            observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        });
    </script>
    @endpush
</x-filament-panels::page>