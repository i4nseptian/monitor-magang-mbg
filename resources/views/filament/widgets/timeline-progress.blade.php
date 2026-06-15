<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Timeline Magang</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Dinas Komunikasi dan Informatika Kota Makassar
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 text-xs font-semibold">
                <div class="px-3 py-1.5 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 text-blue-700 dark:text-blue-300 rounded-lg border border-blue-200 dark:border-blue-800">
                    <svg class="inline w-3.5 h-3.5 mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $tanggal_mulai }}
                </div>
                <div class="px-3 py-1.5 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 text-green-700 dark:text-green-300 rounded-lg border border-green-200 dark:border-green-800">
                    <svg class="inline w-3.5 h-3.5 mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ $tanggal_selesai }}
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex justify-between text-sm mb-3 font-semibold">
                <span class="text-blue-600 dark:text-blue-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    {{ $hari_berjalan }} Hari Berjalan
                </span>
                <span class="text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2.5 py-0.5 rounded-full text-xs">{{ $persentase }}%</span>
                <span class="text-orange-600 dark:text-orange-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $hari_tersisa }} Hari Tersisa
                </span>
            </div>

            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-5 overflow-hidden shadow-inner">
                <div class="h-full rounded-full transition-all duration-1000 ease-out relative"
                     style="width: {{ $persentase }}%; background: linear-gradient(90deg, #3b82f6, #6366f1, #8b5cf6);">
                    <span class="absolute inset-0 flex items-center justify-end pr-2 text-xs font-bold text-white drop-shadow-md">
                        {{ $persentase }}%
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-3 gap-4">
            <div class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-900/30">
                <p class="font-bold text-xl text-blue-700 dark:text-blue-300">{{ $total_hari }}</p>
                <p class="text-xs text-blue-600 dark:text-blue-400 font-medium mt-0.5">Total Hari</p>
            </div>
            <div class="text-center p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl border border-emerald-100 dark:border-emerald-900/30">
                <p class="font-bold text-xl text-emerald-700 dark:text-emerald-300">{{ $hari_berjalan }}</p>
                <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium mt-0.5">Sudah Dilalui</p>
            </div>
            <div class="text-center p-3 bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-100 dark:border-amber-900/30">
                <p class="font-bold text-xl text-amber-700 dark:text-amber-300">{{ $hari_tersisa }}</p>
                <p class="text-xs text-amber-600 dark:text-amber-400 font-medium mt-0.5">Sisa Hari</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
