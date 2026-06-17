<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-md">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Timeline Magang</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Diskominfo Makassar</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 text-xs">
                <span class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 py-1.5 font-semibold text-gray-600 dark:text-gray-300 shadow-sm">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $tanggal_mulai }}
                </span>
                <span class="text-gray-300 dark:text-gray-600 self-center">→</span>
                <span class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-3 py-1.5 font-semibold text-gray-600 dark:text-gray-300 shadow-sm">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ $tanggal_selesai }}
                </span>
            </div>
        </div>

        <div class="mt-6">
            <div class="mb-2 flex items-center justify-between text-sm">
                <span class="font-semibold tabular-nums text-gray-700 dark:text-gray-300">{{ $hari_berjalan }} hari berjalan</span>
                <span class="font-extrabold tabular-nums text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-brand-400 dark:from-brand-400 dark:to-brand-300">{{ $persentase }}%</span>
                <span class="font-medium tabular-nums text-gray-500 dark:text-gray-400">{{ $hari_tersisa }} hari tersisa</span>
            </div>

            <div class="relative h-3 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800 shadow-inner">
                <div class="h-full rounded-full bg-gradient-to-r from-brand-500 to-brand-700 dark:from-brand-400 dark:to-brand-600 transition-all duration-1000 ease-out shadow-lg shadow-brand-500/20"
                     style="width: {{ $persentase }}%"></div>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-3 gap-3">
            <div class="rounded-xl border border-gray-100 dark:border-gray-800 bg-gradient-to-b from-gray-50/90 to-white dark:from-gray-900/60 dark:to-gray-900/20 p-3 text-center shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                <p class="text-xl font-bold tabular-nums text-gray-900 dark:text-white">{{ $total_hari }}</p>
                <p class="mt-0.5 text-[11px] font-semibold text-gray-500 dark:text-gray-400">Total Hari</p>
            </div>
            <div class="rounded-xl border border-brand-100 dark:border-brand-900/50 bg-gradient-to-b from-brand-50/90 to-white dark:from-brand-950/40 dark:to-gray-900/20 p-3 text-center shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                <p class="text-xl font-bold tabular-nums text-brand-700 dark:text-brand-400">{{ $hari_berjalan }}</p>
                <p class="mt-0.5 text-[11px] font-semibold text-brand-600/80 dark:text-brand-400/80">Sudah Dilalui</p>
            </div>
            <div class="rounded-xl border border-gray-100 dark:border-gray-800 bg-gradient-to-b from-gray-50/90 to-white dark:from-gray-900/60 dark:to-gray-900/20 p-3 text-center shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                <p class="text-xl font-bold tabular-nums text-gray-700 dark:text-gray-300">{{ $hari_tersisa }}</p>
                <p class="mt-0.5 text-[11px] font-semibold text-gray-500 dark:text-gray-400">Sisa Hari</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>