<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-700 dark:bg-primary-950/50 dark:text-primary-300">
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
                <span class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-gray-50 px-3 py-1.5 font-medium text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $tanggal_mulai }}
                </span>
                <span class="text-gray-300 dark:text-gray-600">→</span>
                <span class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-gray-50 px-3 py-1.5 font-medium text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ $tanggal_selesai }}
                </span>
            </div>
        </div>

        <div class="mt-6">
            <div class="mb-2 flex items-center justify-between text-sm">
                <span class="font-medium text-gray-700 dark:text-gray-300">{{ $hari_berjalan }} hari berjalan</span>
                <span class="font-bold text-primary-700 dark:text-primary-400">{{ $persentase }}%</span>
                <span class="font-medium text-gray-500 dark:text-gray-400">{{ $hari_tersisa }} hari tersisa</span>
            </div>

            <div class="h-2.5 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                <div class="h-full rounded-full bg-primary-600 transition-all duration-700 ease-out dark:bg-primary-500"
                     style="width: {{ $persentase }}%"></div>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-3 gap-3">
            <div class="rounded-xl border border-gray-100 bg-gray-50/80 p-3 text-center dark:border-gray-800 dark:bg-gray-900/40">
                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $total_hari }}</p>
                <p class="mt-0.5 text-[11px] font-medium text-gray-500">Total Hari</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-gray-50/80 p-3 text-center dark:border-gray-800 dark:bg-gray-900/40">
                <p class="text-xl font-bold text-primary-700 dark:text-primary-400">{{ $hari_berjalan }}</p>
                <p class="mt-0.5 text-[11px] font-medium text-gray-500">Sudah Dilalui</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-gray-50/80 p-3 text-center dark:border-gray-800 dark:bg-gray-900/40">
                <p class="text-xl font-bold text-gray-700 dark:text-gray-300">{{ $hari_tersisa }}</p>
                <p class="mt-0.5 text-[11px] font-medium text-gray-500">Sisa Hari</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
