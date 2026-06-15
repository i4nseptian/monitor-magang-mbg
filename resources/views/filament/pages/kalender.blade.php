<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header & Navigasi Bulan --}}
        <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-calendar-days" class="h-6 w-6 text-primary-500" />
                <span>{{ $currentMonthName }}</span>
            </h2>
            <div class="flex items-center gap-2">
                <x-filament::button wire:click="prevMonth" color="gray" size="sm" icon="heroicon-m-chevron-left" icon-position="before">
                    Bulan Lalu
                </x-filament::button>
                <x-filament::button wire:click="nextMonth" color="gray" size="sm" icon="heroicon-m-chevron-right" icon-position="after">
                    Bulan Depan
                </x-filament::button>
            </div>
        </div>

        {{-- Grid Kalender --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            {{-- Header Nama Hari --}}
            <div class="grid grid-cols-7 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                @foreach ($weeks as $dayName)
                    <div class="py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        {{ $dayName }}
                    </div>
                @endforeach
            </div>

            {{-- Grid Tanggal --}}
            <div class="grid grid-cols-7 auto-rows-[120px] divide-x divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($days as $day)
                    @php
                        $dayClass = 'p-2 flex flex-col justify-between transition duration-200 hover:bg-gray-50 dark:hover:bg-gray-700/30 ';
                        if (!$day['is_current_month']) {
                            $dayClass .= 'bg-gray-50/50 dark:bg-gray-900/20 text-gray-400 dark:text-gray-600';
                        } else {
                            $dayClass .= 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200';
                        }
                        if ($day['is_today']) {
                            $dayClass .= ' ring-2 ring-primary-500 ring-inset bg-primary-50/20 dark:bg-primary-950/10';
                        }
                    @endphp
                    <div class="{{ $dayClass }}">
                        {{-- Angka Tanggal --}}
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold {{ $day['is_today'] ? 'text-primary-600 dark:text-primary-400 bg-primary-100 dark:bg-primary-950 px-2 py-0.5 rounded-full' : '' }}">
                                {{ $day['date']->day }}
                            </span>
                            @if($day['logbooks']->count() > 0)
                                <span class="text-[10px] bg-green-100 dark:bg-green-950 text-green-700 dark:text-green-400 px-1.5 py-0.5 rounded font-medium">
                                    {{ $day['logbooks']->count() }} Log
                                </span>
                            @endif
                        </div>

                        {{-- Isi Kegiatan / Dokumentasi singkat --}}
                        <div class="mt-1 flex-1 overflow-y-auto space-y-1 scrollbar-none">
                            @foreach ($day['logbooks'] as $log)
                                <div class="text-[9px] truncate bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-400 px-1 py-0.5 rounded border border-blue-100 dark:border-blue-900" 
                                     title="{{ $log->judul_kegiatan }} ({{ $log->user->name }})">
                                    {{ $log->user->name }}: {{ $log->judul_kegiatan }}
                                </div>
                            @endforeach

                            @foreach ($day['documentations'] as $doc)
                                <div class="text-[9px] truncate bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-400 px-1 py-0.5 rounded border border-purple-100 dark:border-purple-900" 
                                     title="Dokumentasi: {{ $doc->judul }} ({{ $doc->user->name }})">
                                    📸 {{ $doc->judul }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Legenda --}}
        <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900/40 p-4 rounded-xl border border-gray-200 dark:border-gray-700">
            <span class="font-semibold text-gray-700 dark:text-gray-300">Keterangan:</span>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 bg-blue-100 dark:bg-blue-950 border border-blue-200 dark:border-blue-900 rounded"></span>
                <span>Logbook Kegiatan Harian</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 bg-purple-100 dark:bg-purple-950 border border-purple-200 dark:border-purple-900 rounded"></span>
                <span>Dokumentasi Kegiatan</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3.5 h-3.5 rounded-full bg-primary-100 dark:bg-primary-950 border border-primary-300 dark:border-primary-800 text-center text-[9px] text-primary-600 font-bold px-1 py-0.5">Hari ini</span>
                <span>Hari Ini</span>
            </div>
        </div>
    </div>
</x-filament-panels::page>
