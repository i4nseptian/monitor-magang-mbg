<x-filament-panels::page>
    <div class="space-y-6">
        
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-8">
            <x-stat-card label="Total Logbook" :value="$finalStats['total_logbook']" color="primary" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.232.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>' />
            <x-stat-card label="Foto Dokumentasi" :value="$finalStats['total_foto']" color="warning" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/></svg>' />
            <x-stat-card label="Total Project" :value="$finalStats['total_project']" color="success" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18m-18 0v-7.5A2.25 2.25 0 014.25 3.5h15.5A2.25 2.25 0 0122 5.75v7.5m-18 0v5.25c0 .621.504 1.125 1.125 1.125h13.5c.621 0 1.125-.504 1.125-1.125v-5.25"/></svg>' />
            <x-stat-card label="Evaluasi Mentor" :value="$finalStats['total_evaluasi']" color="info" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3h9m-9 3h9m-16.5 5.25h15.75a2.25 2.25 0 002.25-2.25V4.5A2.25 2.25 0 0017.25 2.25H3.75A2.25 2.25 0 001.5 4.5v12.75a2.25 2.25 0 002.25 2.25z"/></svg>' />
            <x-stat-card label="Skill Terdata" :value="$finalStats['total_skills']" color="primary" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21l8.904-4.43c2.32-.477 4.1-2.4 4.093-4.771V6.518c0-.987-.777-1.802-1.76-1.849a48.514 48.514 0 00-6.19-.24c-2.42 0-4.8.31-7.098.913a1.875 1.875 0 00-1.397 1.826v6.096c0 .882.35 1.728.974 2.353l3.93 3.93A1.875 1.875 0 009.813 15.904z"/></svg>' />
            <x-stat-card label="Pencapaian" :value="$finalStats['total_achievements']" color="success" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.75V10.5h1.5a.75.75 0 00.75-.75V6.75a.75.75 0 00-.75-.75h-6a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h1.5v3.375h-.75c-.621 0-1.125.504-1.125 1.125v3.375m9 0h-9"/></svg>' />
            <x-stat-card label="Total Kehadiran" :value="$finalStats['total_hadir']" color="info" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/></svg>' />
            <x-stat-card label="Rasio Kehadiran" :value="$finalStats['persen_hadir'] . '%'" color="warning" 
                icon='<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"/></svg>' />
        </div>

        <div class="rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="border-b border-slate-100 dark:border-slate-800 px-6 py-4">
                <h3 class="flex items-center gap-2 text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-sm">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 111.063.852l-.708 2.836a.75.75 0 001.063.852l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>
                    Ringkasan Magang
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4 transition-all duration-200 hover:shadow-sm">
                        <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Periode Magang</p>
                        <p class="mt-2 text-sm font-bold text-slate-800 dark:text-slate-200 tabular-nums">
                            {{ $finalStats['tgl_mulai']->format('d M Y') }} – {{ $finalStats['tgl_selesai']->format('d M Y') }}
                        </p>
                    </div>
                    <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4 transition-all duration-200 hover:shadow-sm">
                        <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Total Hari</p>
                        <p class="mt-2 text-sm font-bold text-slate-800 dark:text-slate-200 tabular-nums">
                            {{ $finalStats['total_hari'] }} Hari Kerja
                        </p>
                    </div>
                    <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4 transition-all duration-200 hover:shadow-sm">
                        <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Kategori Terbanyak</p>
                        <p class="mt-2 text-sm font-bold text-slate-800 dark:text-slate-200">
                            {{ $finalStats['top_category'] }}
                        </p>
                        <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 mt-0.5 tabular-nums">
                            {{ $finalStats['top_category_count'] }} Kegiatan
                        </p>
                    </div>
                    <div class="rounded-xl border border-slate-100 dark:border-slate-800 bg-gradient-to-br from-slate-50/50 to-white dark:from-slate-950/30 dark:to-gray-900/50 p-4 transition-all duration-200 hover:shadow-sm">
                        <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Total Dokumentasi</p>
                        <p class="mt-2 text-sm font-bold text-slate-800 dark:text-slate-200 tabular-nums">
                            {{ $finalStats['total_dokumentasi'] }} Berkas
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            
            <div class="rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <h4 class="mb-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-brand-500"></span>
                    Perkembangan Skill
                </h4>
                <div class="relative flex items-center justify-center h-[260px]">
                    <canvas id="skillChart" class="max-h-full max-w-full"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <h4 class="mb-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                    Distribusi Kategori
                </h4>
                <div class="relative flex items-center justify-center h-[260px]">
                    <canvas id="categoryChart" class="max-h-full max-w-full"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <h4 class="mb-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Distribusi Mood
                </h4>
                <div class="relative flex items-center justify-center h-[260px]">
                    <canvas id="moodChart" class="max-h-full max-w-full"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <h4 class="mb-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                    Tren Logbook Mingguan
                </h4>
                <div class="relative flex items-center justify-center h-[260px]">
                    <canvas id="weeklyChart" class="max-h-full max-w-full"></canvas>
                </div>
            </div>

            <div class="md:col-span-2 rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 p-5 shadow-sm hover:shadow-md transition-all duration-300">
                <h4 class="mb-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-violet-500"></span>
                    Detail Kategori Pekerjaan
                </h4>
                <div class="overflow-hidden rounded-xl border border-slate-100 dark:border-slate-800">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-50/70 to-white border-b border-slate-200 dark:from-slate-950/30 dark:to-gray-900/50 dark:border-slate-800">
                                <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Nama Kategori</th>
                                <th class="px-4 py-3.5 text-right text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Jumlah Kontribusi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($finalStats['category_distribution'] as $cat)
                                <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-950/30">
                                    <td class="px-4 py-3.5 font-medium text-slate-700 dark:text-slate-300">
                                        {{ $cat['kategori_kegiatan'] }}
                                    </td>
                                    <td class="px-4 py-3.5 text-right font-extrabold tabular-nums text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-brand-400 dark:from-brand-400 dark:to-brand-300">
                                        {{ $cat['total'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function isDark() { return document.documentElement.classList.contains('dark'); }

            const darkBrand = ['#818cf8', '#6366f1', '#4f46e5', '#38bdf8', '#06b6d4', '#10b981', '#f59e0b', '#fb7185'];
            const lightBrand = ['#4f46e5', '#6366f1', '#818cf8', '#06b6d4', '#38bdf8', '#10b981', '#f59e0b', '#f43f5e'];

            function renderCharts() {
                const dark = isDark();
                const brandColors = dark ? darkBrand : lightBrand;
                const gridColor = dark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.05)';
                const tickColor = dark ? '#64748b' : '#94a3b8';
                const fontColor = dark ? '#cbd5e1' : '#475569';

                const defaults = {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { labels: { boxWidth: 10, padding: 12, font: { size: 10, weight: '600' }, color: fontColor } }
                    },
                    animation: { duration: 1000, easing: 'easeOutQuart' },
                    scales: { 
                        x: { grid: { color: gridColor }, ticks: { color: tickColor, font: { size: 10 } } }, 
                        y: { grid: { color: gridColor }, ticks: { color: tickColor, font: { size: 10 } } } 
                    }
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
                                { label: 'Awal', data: @json($skillData['awal']), backgroundColor: dark ? '#312e81' : '#e0e7ff', borderRadius: 6 },
                                { label: 'Akhir', data: @json($skillData['akhir']), backgroundColor: dark ? '#6366f1' : '#4f46e5', borderRadius: 6 }
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
                        data: { labels: moodLabels, datasets: [{ data: @json($moodData['values']), backgroundColor: brandColors.slice(2,6), borderWidth: 0 }] },
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
                                borderColor: '#6366f1',
                                backgroundColor: 'rgba(99, 102, 241, 0.08)',
                                fill: true, tension: 0.4,
                                pointBackgroundColor: '#6366f1',
                                pointRadius: 4, pointHoverRadius: 6
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