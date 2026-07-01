<div class="rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-4 sm:p-5 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <div class="h-2.5 w-2.5 rounded-full bg-amber-500"></div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Analisis Mood</h3>
        </div>
        <span class="text-xs text-slate-400 dark:text-slate-500">{{ $total }} entri</span>
    </div>

    @if($total > 0 && count($series) > 0)
    <div class="flex items-center gap-6">
        <div class="relative h-28 w-28 shrink-0">
            <canvas id="moodDonut"></canvas>
        </div>
        <div class="flex-1 min-w-0 space-y-1.5">
            @foreach($labels as $i => $label)
                @php
                    $colors = ['#10b981', '#6366f1', '#f59e0b', '#ef4444'];
                    $icons = ['😀', '🙂', '😐', '😵'];
                @endphp
                <div class="flex items-center gap-2">
                    <span class="text-sm">{{ $icons[$i] ?? '?' }}</span>
                    <span class="text-xs text-slate-600 dark:text-slate-400 flex-1 truncate">{{ $label }}</span>
                    <span class="text-xs font-semibold text-slate-800 dark:text-slate-200 tabular-nums">{{ $series[$i] }}</span>
                    <div class="h-1.5 w-16 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                        <div class="h-full rounded-full transition-all" style="width: {{ $percentages[$i] }}%; background: {{ $colors[$i] }}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @else
    <p class="text-sm text-slate-400 dark:text-slate-500 text-center py-4">Belum ada data mood.</p>
    @endif
</div>

@if($total > 0)
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('moodDonut');
    if (!canvas) return;
    if (typeof Chart === 'undefined') return;
    const existing = Chart.getChart(canvas);
    if (existing) existing.destroy();
    new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: @json($labels),
            datasets: [{
                data: @json($series),
                backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#ef4444'],
                borderWidth: 2,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '70%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            return ctx.label + ': ' + ctx.parsed + ' entri';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endif
