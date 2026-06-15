<x-filament-panels::page>
    <div class="space-y-6">
        {{-- STATS CARDS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="rounded-xl bg-blue-50 dark:bg-blue-950/30 p-4 border border-blue-100 dark:border-blue-900">
                <p class="text-2xl font-bold text-blue-700 dark:text-blue-400">{{ $finalStats['total_logbook'] }}</p>
                <p class="text-xs text-blue-600 dark:text-blue-500 mt-1">Total Logbook</p>
            </div>
            <div class="rounded-xl bg-green-50 dark:bg-green-950/30 p-4 border border-green-100 dark:border-green-900">
                <p class="text-2xl font-bold text-green-700 dark:text-green-400">{{ $finalStats['total_foto'] }}</p>
                <p class="text-xs text-green-600 dark:text-green-500 mt-1">Total Foto Dokumentasi</p>
            </div>
            <div class="rounded-xl bg-purple-50 dark:bg-purple-950/30 p-4 border border-purple-100 dark:border-purple-900">
                <p class="text-2xl font-bold text-purple-700 dark:text-purple-400">{{ $finalStats['total_project'] }}</p>
                <p class="text-xs text-purple-600 dark:text-purple-500 mt-1">Total Project</p>
            </div>
            <div class="rounded-xl bg-orange-50 dark:bg-orange-950/30 p-4 border border-orange-100 dark:border-orange-900">
                <p class="text-2xl font-bold text-orange-700 dark:text-orange-400">{{ $finalStats['total_evaluasi'] }}</p>
                <p class="text-xs text-orange-600 dark:text-orange-500 mt-1">Evaluasi Mentor</p>
            </div>
            <div class="rounded-xl bg-cyan-50 dark:bg-cyan-950/30 p-4 border border-cyan-100 dark:border-cyan-900">
                <p class="text-2xl font-bold text-cyan-700 dark:text-cyan-400">{{ $finalStats['total_skills'] }}</p>
                <p class="text-xs text-cyan-600 dark:text-cyan-500 mt-1">Skill Terdata</p>
            </div>
            <div class="rounded-xl bg-pink-50 dark:bg-pink-950/30 p-4 border border-pink-100 dark:border-pink-900">
                <p class="text-2xl font-bold text-pink-700 dark:text-pink-400">{{ $finalStats['total_achievements'] }}</p>
                <p class="text-xs text-pink-600 dark:text-pink-500 mt-1">Pencapaian</p>
            </div>
            <div class="rounded-xl bg-indigo-50 dark:bg-indigo-950/30 p-4 border border-indigo-100 dark:border-indigo-900">
                <p class="text-2xl font-bold text-indigo-700 dark:text-indigo-400">{{ $finalStats['total_hadir'] }}</p>
                <p class="text-xs text-indigo-600 dark:text-indigo-500 mt-1">Total Kehadiran</p>
            </div>
            <div class="rounded-xl bg-teal-50 dark:bg-teal-950/30 p-4 border border-teal-100 dark:border-teal-900">
                <p class="text-2xl font-bold text-teal-700 dark:text-teal-400">{{ $finalStats['persen_hadir'] }}%</p>
                <p class="text-xs text-teal-600 dark:text-teal-500 mt-1">Persentase Kehadiran</p>
            </div>
        </div>

        {{-- INFO --}}
        <x-filament::section>
            <x-slot name="heading">Info Magang</x-slot>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div><span class="text-gray-500">Periode:</span> <span class="font-semibold">{{ $finalStats['tgl_mulai']->format('d M Y') }} - {{ $finalStats['tgl_selesai']->format('d M Y') }}</span></div>
                <div><span class="text-gray-500">Total Hari:</span> <span class="font-semibold">{{ $finalStats['total_hari'] }} Hari</span></div>
                <div><span class="text-gray-500">Kategori Terbanyak:</span> <span class="font-semibold">{{ $finalStats['top_category'] }} ({{ $finalStats['top_category_count'] }})</span></div>
                <div><span class="text-gray-500">Total Dokumentasi:</span> <span class="font-semibold">{{ $finalStats['total_dokumentasi'] }}</span></div>
            </div>
        </x-filament::section>

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Skill Chart --}}
            <x-filament::section>
                <x-slot name="heading">Perkembangan Skill</x-slot>
                <canvas id="skillChart" style="max-height:250px"></canvas>
            </x-filament::section>

            {{-- Category Chart --}}
            <x-filament::section>
                <x-slot name="heading">Distribusi Kategori Kegiatan</x-slot>
                <canvas id="categoryChart" style="max-height:250px"></canvas>
            </x-filament::section>

            {{-- Mood Chart --}}
            <x-filament::section>
                <x-slot name="heading">Distribusi Mood/Tingkat Kesulitan</x-slot>
                <canvas id="moodChart" style="max-height:250px"></canvas>
            </x-filament::section>

            {{-- Weekly Logbook Trend --}}
            <x-filament::section>
                <x-slot name="heading">Tren Logbook per Minggu</x-slot>
                <canvas id="weeklyChart" style="max-height:250px"></canvas>
            </x-filament::section>
        </div>

        {{-- Kategori Distribution Table --}}
        <x-filament::section>
            <x-slot name="heading">Detail Kategori Pekerjaan</x-slot>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">Kategori</th>
                        <th class="text-right py-2">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finalStats['category_distribution'] as $cat)
                    <tr class="border-b">
                        <td class="py-1.5">{{ $cat['kategori_kegiatan'] }}</td>
                        <td class="text-right py-1.5">{{ $cat['total'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-filament::section>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Skill Chart
            const skillCtx = document.getElementById('skillChart');
            if (skillCtx) {
                new Chart(skillCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($skillData['labels']),
                        datasets: [
                            {
                                label: 'Awal Magang',
                                data: @json($skillData['awal']),
                                backgroundColor: 'rgba(234, 179, 8, 0.7)',
                                borderColor: 'rgb(234, 179, 8)',
                                borderWidth: 1
                            },
                            {
                                label: 'Akhir Magang',
                                data: @json($skillData['akhir']),
                                backgroundColor: 'rgba(34, 197, 94, 0.7)',
                                borderColor: 'rgb(34, 197, 94)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: { y: { beginAtZero: true, max: 100 } }
                    }
                });
            }

            // Category Pie Chart
            const catCtx = document.getElementById('categoryChart');
            if (catCtx) {
                new Chart(catCtx, {
                    type: 'doughnut',
                    data: {
                        labels: @json($categoryData['labels']),
                        datasets: [{
                            data: @json($categoryData['values']),
                            backgroundColor: [
                                '#3b82f6', '#22c55e', '#f59e0b', '#ef4444',
                                '#8b5cf6', '#ec4899', '#14b8a6', '#f97316', '#6366f1'
                            ]
                        }]
                    }
                });
            }

            // Mood Chart
            const moodCtx = document.getElementById('moodChart');
            if (moodCtx) {
                new Chart(moodCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($moodData['labels']),
                        datasets: [{
                            data: @json($moodData['values']),
                            backgroundColor: ['#22c55e', '#3b82f6', '#f59e0b', '#ef4444']
                        }]
                    }
                });
            }

            // Weekly Logbook Trend
            const weeklyCtx = document.getElementById('weeklyChart');
            if (weeklyCtx) {
                new Chart(weeklyCtx, {
                    type: 'line',
                    data: {
                        labels: @json($weeklyLogbookData['labels']),
                        datasets: [{
                            label: 'Jumlah Logbook',
                            data: @json($weeklyLogbookData['values']),
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                    }
                });
            }
        });
    </script>
    @endpush
</x-filament-panels::page>
