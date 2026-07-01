<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Header — Metronic clean header --}}
        <div class="flex flex-col gap-3.5 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Timeline Magang</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Diskominfo Makassar</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 text-xs">
                <span class="inline-flex items-center gap-1.5 rounded px-2.5 py-1 font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $tanggal_mulai }}
                </span>
                <span class="text-slate-300 dark:text-slate-600 self-center">→</span>
                <span class="inline-flex items-center gap-1.5 rounded px-2.5 py-1 font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                    {{ $tanggal_selesai }}
                </span>
            </div>
        </div>

        {{-- Progress bar — Metronic clean bar --}}
        <div class="mt-5">
            <div class="mb-2 flex items-center justify-between gap-1 text-xs sm:text-sm">
                <span class="font-medium text-slate-600 dark:text-slate-400 tabular-nums">{{ $hari_berjalan }} hari berjalan</span>
                <span class="font-semibold text-indigo-600 dark:text-indigo-400 tabular-nums">{{ $persentase }}%</span>
                <span class="font-medium text-slate-400 dark:text-slate-500 tabular-nums">{{ $hari_tersisa }} hari tersisa</span>
            </div>

            <div class="relative h-2 w-full overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                <div class="h-full rounded-full bg-indigo-500 dark:bg-indigo-400 transition-all duration-700 ease-out"
                     style="width: {{ $persentase }}%"></div>
            </div>
        </div>

        {{-- Stat boxes — Metronic clean grid --}}
        <div class="mt-5 grid grid-cols-3 gap-2 sm:gap-3">
            <div class="rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30 p-2 sm:p-3 text-center">
                <p class="text-base sm:text-lg font-semibold tabular-nums text-slate-800 dark:text-slate-200">{{ $total_hari }}</p>
                <p class="mt-0.5 text-xs font-medium text-slate-400 dark:text-slate-500">Total Hari</p>
            </div>
            <div class="rounded-lg border border-indigo-100 dark:border-indigo-900/40 bg-indigo-50/50 dark:bg-indigo-950/20 p-2 sm:p-3 text-center">
                <p class="text-base sm:text-lg font-semibold tabular-nums text-indigo-600 dark:text-indigo-400">{{ $hari_berjalan }}</p>
                <p class="mt-0.5 text-xs font-medium text-indigo-500/70 dark:text-indigo-400/70">Sudah Dilalui</p>
            </div>
            <div class="rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30 p-2 sm:p-3 text-center">
                <p class="text-base sm:text-lg font-semibold tabular-nums text-slate-600 dark:text-slate-300">{{ $hari_tersisa }}</p>
                <p class="mt-0.5 text-xs font-medium text-slate-400 dark:text-slate-500">Sisa Hari</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
