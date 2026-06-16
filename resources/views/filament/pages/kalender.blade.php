<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header & Navigasi Bulan --}}
        <div class="flex items-center justify-between rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-900">
            <h2 class="flex items-center gap-2 text-lg font-bold text-gray-900 dark:text-white">
                <x-filament::icon icon="heroicon-o-calendar-days" class="h-5 w-5 text-primary-600" />
                {{ $currentMonthName }}
            </h2>
            <div class="flex items-center gap-1">
                <x-filament::button wire:click="prevMonth" color="gray" size="sm" icon="heroicon-m-chevron-left" />
                <x-filament::button wire:click="nextMonth" color="gray" size="sm" icon="heroicon-m-chevron-right" />
            </div>
        </div>

        {{-- Grid Kalender --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">
            <div class="grid grid-cols-7 border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-950/50">
                @foreach ($weeks as $dayName)
                    <div class="py-3 text-center text-[11px] font-semibold uppercase tracking-wider text-gray-500">
                        {{ $dayName }}
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-7 auto-rows-[minmax(110px,auto)] divide-x divide-y divide-gray-100 dark:divide-gray-800">
                @foreach ($days as $day)
                    @php
                        $dayClass = 'flex flex-col p-1.5 sm:p-2 transition ';
                        if (!$day['is_current_month']) {
                            $dayClass .= 'bg-gray-50/50 text-gray-300 dark:bg-gray-950/30 dark:text-gray-600';
                        } else {
                            $dayClass .= 'bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-200';
                        }
                        if ($day['is_today']) {
                            $dayClass .= ' ring-2 ring-inset ring-primary-500/40 bg-primary-50/30 dark:bg-primary-950/10';
                        }
                    @endphp
                    <div class="{{ $dayClass }}">
                        <div class="mb-1 flex items-center justify-between">
                            <span @class([
                                'flex h-6 w-6 items-center justify-center text-xs font-bold',
                                'rounded-full bg-primary-600 text-white' => $day['is_today'],
                                '' => !$day['is_today'],
                            ])>{{ $day['date']->day }}</span>
                            @if($day['logbooks']->count() > 0)
                                <span class="rounded bg-primary-100 px-1.5 py-0.5 text-[10px] font-semibold tabular-nums text-primary-700 dark:bg-primary-950 dark:text-primary-300">
                                    {{ $day['logbooks']->count() }}
                                </span>
                            @endif
                        </div>

                        <div class="flex-1 space-y-0.5 overflow-y-auto">
                            @foreach ($day['logbooks'] as $log)
                                <div class="truncate rounded border border-primary-100 bg-primary-50/60 px-1.5 py-[2px] text-[10px] font-medium text-primary-800 dark:border-primary-900 dark:bg-primary-950/40 dark:text-primary-300"
                                     title="{{ $log->judul_kegiatan }} ({{ $log->user->name }})">
                                    {{ Str::limit($log->judul_kegiatan, 18) }}
                                </div>
                            @endforeach
                            @foreach ($day['documentations'] as $doc)
                                <div class="truncate rounded border border-gray-200 bg-gray-50 px-1.5 py-[2px] text-[10px] text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
                                     title="Dokumentasi: {{ $doc->judul }}">
                                    {{ Str::limit($doc->judul, 16) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Legenda --}}
        <div class="flex flex-wrap items-center gap-4 rounded-xl border border-gray-200 bg-gradient-to-r from-gray-50/90 to-white p-4 text-xs dark:border-gray-700 dark:from-gray-900/60 dark:to-gray-900/20">
            <span class="font-semibold text-gray-700 dark:text-gray-300">Keterangan:</span>
            <div class="flex items-center gap-1.5">
                <span class="inline-block h-2.5 w-2.5 rounded-sm bg-primary-600"></span>
                <span class="text-gray-600 dark:text-gray-400">Logbook</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="inline-block h-2.5 w-2.5 rounded-sm bg-gray-400"></span>
                <span class="text-gray-600 dark:text-gray-400">Dokumentasi</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-primary-600 text-[9px] font-bold text-white">H</span>
                <span class="text-gray-600 dark:text-gray-400">Hari ini</span>
            </div>
        </div>
    </div>
</x-filament-panels::page>
