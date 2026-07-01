<div class="rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-4 sm:p-5 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center gap-2">
            <div class="h-2.5 w-2.5 rounded-full bg-emerald-500"></div>
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Aktivitas Harian</h3>
        </div>
        <span class="text-xs text-slate-400 dark:text-slate-500">{{ $totalActiveDays }} hari aktif</span>
    </div>

    <div class="overflow-x-auto -mx-1 pb-1">
        <div class="inline-flex flex-col min-w-0">
            <div class="flex gap-0.5 ml-0">
                @foreach($weeks as $weekIdx => $week)
                    @php
                        $monthHere = collect($months)->firstWhere('weekIndex', $weekIdx);
                    @endphp
                    <div class="h-3 @if($monthHere) w-3 @else w-3 @endif flex items-end justify-center">
                        @if($monthHere)
                            <span class="text-[8px] font-medium text-slate-400 dark:text-slate-500 leading-none">{{ $monthHere['label'] }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="flex gap-0.5 mt-0.5">
                @foreach($weeks as $weekIdx => $week)
                    <div class="flex flex-col gap-0.5">
                        @foreach($week as $day)
                            @php
                                $colorMap = ['bg-gray-100 dark:bg-slate-800', 'bg-emerald-200 dark:bg-emerald-900', 'bg-emerald-400 dark:bg-emerald-700', 'bg-emerald-500 dark:bg-emerald-500', 'bg-emerald-700 dark:bg-emerald-400'];
                                $todayClass = $day['isToday'] ? 'ring-2 ring-indigo-400 dark:ring-indigo-500' : '';
                            @endphp
                            <div class="h-3 w-3 rounded-sm {{ $colorMap[$day['level']] }} {{ $todayClass }}"
                                 title="{{ $day['date']->format('d M Y') }}: {{ $day['count'] }} logbook">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-1.5 mt-2">
        <span class="text-[10px] text-slate-400 dark:text-slate-500">Kurang</span>
        @foreach(range(0, 4) as $lvl)
            <div class="h-2.5 w-2.5 rounded-sm {{ ['bg-gray-100 dark:bg-slate-800', 'bg-emerald-200 dark:bg-emerald-900', 'bg-emerald-400 dark:bg-emerald-700', 'bg-emerald-500 dark:bg-emerald-500', 'bg-emerald-700 dark:bg-emerald-400'][$lvl] }}"></div>
        @endforeach
        <span class="text-[10px] text-slate-400 dark:text-slate-500">Banyak</span>
    </div>
</div>
