<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between gap-4 mb-4">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-800 dark:text-white">Aktivitas Hari Ini</h3>
                @if (!$activities->isEmpty())
                    <span class="text-xs bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 px-2 py-0.5 rounded-full font-semibold">
                        {{ $activities->count() }} kegiatan
                    </span>
                @endif
            </div>
        </div>

        @if ($activities->isEmpty())
            <div class="py-8 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Belum ada kegiatan hari ini.</p>
                <p class="text-gray-400 dark:text-gray-500 text-xs mt-0.5">Catat kegiatan magang Anda melalui menu Logbook.</p>
            </div>
        @else
            <div class="flow-root max-h-[350px] overflow-y-auto pr-2 space-y-3">
                @foreach ($activities as $activity)
                    <div class="relative flex items-start gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-900/30 border border-gray-100 dark:border-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900/50 transition-colors">
                        <div class="flex-shrink-0 w-9 h-9 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                            {{ $loop->iteration }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-white leading-tight">
                                        {{ $activity->judul_kegiatan }}
                                    </p>
                                    <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                                        @if (!$is_mahasiswa && $activity->user)
                                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400 bg-gray-200 dark:bg-gray-700 px-2 py-0.5 rounded-full">
                                                {{ $activity->user->name }}
                                            </span>
                                        @endif
                                        <span class="text-xs text-gray-500 dark:text-gray-400 bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded-full">
                                            {{ $activity->kategori_kegiatan }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 text-right">
                                    <span class="text-xs font-semibold text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-lg whitespace-nowrap">
                                        {{ Carbon\Carbon::parse($activity->jam_mulai)->format('H:i') }} - {{ Carbon\Carbon::parse($activity->jam_selesai)->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
