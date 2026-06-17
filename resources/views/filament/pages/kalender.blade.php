<x-filament-panels::page>
    <div class="space-y-6">
        
        <div class="flex items-center justify-between rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <h2 class="flex items-center gap-3 text-base sm:text-lg font-bold text-slate-800 dark:text-white font-display">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-md">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                </div>
                <span class="truncate">{{ $currentMonthName }}</span>
            </h2>
            <div class="flex shrink-0 items-center gap-1.5">
                <x-filament::button wire:click="prevMonth" color="gray" size="sm" icon="heroicon-m-chevron-left" class="hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl" />
                <x-filament::button wire:click="nextMonth" color="gray" size="sm" icon="heroicon-m-chevron-right" class="hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl" />
            </div>
        </div>

        <div class="hidden overflow-hidden rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 shadow-sm sm:block">
            <div class="grid grid-cols-7 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-slate-50/80 to-white dark:from-slate-950/30 dark:to-gray-900/50">
                @foreach ($weeks as $dayName)
                    <div class="py-3.5 text-center text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-500">
                        {{ $dayName }}
                    </div>
                @endforeach
            </div>
            <div class="grid grid-cols-7 auto-rows-[minmax(110px,auto)] divide-x divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($days as $day)
                    @php
                        $dayClass = 'flex flex-col p-2.5 transition-all ';
                        if (!$day['is_current_month']) {
                            $dayClass .= 'bg-slate-50/30 text-slate-300 dark:bg-slate-950/10 dark:text-slate-600';
                        } else {
                            $dayClass .= 'bg-white text-slate-800 dark:bg-gray-900 dark:text-slate-200';
                        }
                        if ($day['is_today']) {
                            $dayClass .= ' ring-2 ring-inset ring-brand-500/40 bg-brand-50/30 dark:bg-brand-950/15';
                        }
                    @endphp
                    <div class="{{ $dayClass }} hover:bg-slate-50/40 dark:hover:bg-slate-950/20 group/day">
                        <div class="mb-1.5 flex items-center justify-between">
                            <span @class([
                                'flex h-7 w-7 items-center justify-center text-xs font-bold rounded-xl transition-all',
                                'bg-brand-600 text-white shadow-sm shadow-brand-500/20' => $day['is_today'],
                                'text-slate-400 dark:text-slate-500' => !$day['is_current_month'],
                                'text-slate-700 dark:text-slate-200' => $day['is_current_month'] && !$day['is_today'],
                            ])>{{ $day['date']->day }}</span>
                            
                            @if($day['logbooks']->count() > 0)
                                <span class="rounded-lg bg-brand-50 dark:bg-brand-950/40 border border-brand-100 dark:border-brand-900/50 px-1.5 py-0.5 text-[9px] font-bold tabular-nums text-brand-600 dark:text-brand-400 shadow-sm">
                                    {{ $day['logbooks']->count() }} Item
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex-1 space-y-1 overflow-y-auto max-h-[80px] pr-0.5 scrollbar-thin">
                            @foreach ($day['logbooks'] as $log)
                                <div class="truncate rounded-lg border border-brand-100 dark:border-brand-950 bg-brand-50/60 dark:bg-brand-950/30 px-2 py-1 text-[9px] font-semibold text-brand-700 dark:text-brand-300 transition-colors hover:border-brand-300 dark:hover:border-brand-800 hover:bg-brand-50 dark:hover:bg-brand-950/40"
                                     title="{{ $log->judul_kegiatan }} ({{ $log->user->name }})">
                                    {{ $log->judul_kegiatan }}
                                </div>
                            @endforeach
                            @foreach ($day['documentations'] as $doc)
                                <div class="truncate rounded-lg border border-emerald-100 dark:border-emerald-950 bg-emerald-50/50 dark:bg-emerald-950/20 px-2 py-1 text-[9px] font-semibold text-emerald-700 dark:text-emerald-300 transition-colors hover:border-emerald-300 dark:hover:border-emerald-800 hover:bg-emerald-50 dark:hover:bg-emerald-950/30"
                                     title="Dokumentasi: {{ $doc->judul }}">
                                    <span class="mr-0.5">📷</span>{{ $doc->judul }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-4 sm:hidden">
            @forelse ($weeksGrouped as $weekIndex => $weekDays)
                <div class="overflow-hidden rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 shadow-sm">
                    <div class="border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-slate-50/80 to-white dark:from-slate-950/30 dark:to-gray-900/50 px-4 py-3">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-450 dark:text-slate-500">
                            Minggu {{ $weekIndex + 1 }}
                            <span class="font-normal normal-case text-slate-400 dark:text-slate-500 ml-1">
                                ({{ $weekDays[0]['date']->format('d M') }} – {{ end($weekDays)['date']->format('d M') }})
                            </span>
                        </p>
                    </div>
                    <div class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($weekDays as $day)
                            <div @class([
                                'px-4 py-3.5 transition',
                                'bg-brand-50/10 dark:bg-brand-950/5' => $day['is_today'],
                            ])>
                                <div class="mb-2.5 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span @class([
                                            'flex h-7 w-7 items-center justify-center text-xs font-bold rounded-xl',
                                            'bg-brand-600 text-white shadow-sm' => $day['is_today'],
                                            'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300' => !$day['is_today'],
                                        ])>{{ $day['date']->day }}</span>
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">
                                            {{ $day['date']->translatedFormat('l') }}
                                        </span>
                                        @if(!$day['is_current_month'])
                                            <span class="text-[9px] text-slate-400 dark:text-slate-500 uppercase font-semibold">(luar bulan)</span>
                                        @endif
                                    </div>
                                    @if($day['logbooks']->count() > 0 || $day['documentations']->count() > 0)
                                        <span class="rounded-lg bg-brand-50 dark:bg-brand-950/40 border border-brand-100 dark:border-brand-900/50 px-2 py-0.5 text-[9px] font-bold text-brand-600 dark:text-brand-400">
                                            {{ $day['logbooks']->count() + $day['documentations']->count() }} Item
                                        </span>
                                    @endif
                                </div>
                                @if($day['logbooks']->isEmpty() && $day['documentations']->isEmpty())
                                    <p class="py-1 text-xs text-slate-300 dark:text-slate-600 font-medium">Tidak ada kegiatan</p>
                                @else
                                    <div class="space-y-2">
                                        @foreach ($day['logbooks'] as $log)
                                            <div class="flex items-start gap-2.5 rounded-xl border border-brand-50 dark:border-brand-950/40 bg-brand-50/30 dark:bg-brand-950/20 p-2.5">
                                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-brand-600"></span>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200">{{ $log->judul_kegiatan }}</p>
                                                    <p class="text-[9px] font-semibold text-slate-400 dark:text-slate-500 mt-0.5">{{ $log->user->name }} · {{ $log->jam_mulai->format('H:i') }}–{{ $log->jam_selesai->format('H:i') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach ($day['documentations'] as $doc)
                                            <div class="flex items-start gap-2.5 rounded-xl border border-emerald-50 dark:border-emerald-950/30 bg-emerald-50/20 dark:bg-emerald-950/10 p-2.5">
                                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-500"></span>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200">📷 {{ $doc->judul }}</p>
                                                    <p class="text-[9px] font-semibold text-slate-400 dark:text-slate-500 mt-0.5">{{ $doc->user->name }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-800 py-16 text-center">
                    <div class="h-12 w-12 mx-auto mb-3 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                        <svg class="h-6 w-6 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Tidak ada data untuk bulan ini.</p>
                </div>
            @endforelse
        </div>

        <div class="flex flex-wrap items-center gap-4 sm:gap-6 rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-gradient-to-r from-slate-50/90 to-white dark:from-gray-900/50 dark:to-gray-900/10 p-4 text-xs shadow-sm">
            <span class="font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Keterangan:</span>
            <div class="flex items-center gap-1.5">
                <span class="inline-block h-3 w-3 rounded-md bg-brand-600 shadow-sm"></span>
                <span class="font-semibold text-slate-600 dark:text-slate-400">Logbook</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="inline-block h-3 w-3 rounded-md bg-emerald-500 shadow-sm"></span>
                <span class="font-semibold text-slate-600 dark:text-slate-400">Dokumentasi</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-brand-600 text-[9px] font-bold text-white shadow-sm">H</span>
                <span class="font-semibold text-slate-600 dark:text-slate-400">Hari ini</span>
            </div>
        </div>
    </div>
</x-filament-panels::page>