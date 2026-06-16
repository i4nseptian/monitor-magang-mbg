<x-filament-widgets::widget>
    <x-filament::section>
        <div class="mb-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-50 text-primary-700 dark:bg-primary-950/50 dark:text-primary-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Aktivitas Hari Ini</h3>
            </div>
            @if (!$activities->isEmpty())
                <span class="rounded-md bg-primary-50 px-2 py-0.5 text-xs font-semibold text-primary-700 dark:bg-primary-950/50 dark:text-primary-300">
                    {{ $activities->count() }} kegiatan
                </span>
            @endif
        </div>

        @if ($activities->isEmpty())
            <div class="rounded-xl border border-dashed border-gray-200 py-10 text-center dark:border-gray-700">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-50 dark:bg-gray-800">
                    <svg class="h-6 w-6 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada kegiatan hari ini</p>
                <p class="mt-0.5 text-xs text-gray-400">Buat entri baru melalui menu Logbook.</p>
            </div>
        @else
            <div class="max-h-[350px] space-y-2 overflow-y-auto pr-1">
                @foreach ($activities as $activity)
                    <div class="flex items-start gap-3 rounded-xl border border-gray-100 p-3 transition hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-900/40">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-xs font-bold text-primary-700 dark:bg-primary-950/50 dark:text-primary-300">
                            {{ $loop->iteration }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $activity->judul_kegiatan }}
                                    </p>
                                    <div class="mt-1.5 flex flex-wrap items-center gap-1.5">
                                        @if (!$is_mahasiswa && $activity->user)
                                            <span class="rounded-md bg-gray-100 px-2 py-0.5 text-[11px] font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                                {{ $activity->user->name }}
                                            </span>
                                        @endif
                                        <span class="rounded-md bg-primary-50 px-2 py-0.5 text-[11px] font-medium text-primary-700 dark:bg-primary-950/40 dark:text-primary-300">
                                            {{ $activity->kategori_kegiatan }}
                                        </span>
                                    </div>
                                </div>
                                <span class="shrink-0 rounded-md bg-gray-50 px-2 py-1 text-[11px] font-semibold tabular-nums text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    {{ Carbon\Carbon::parse($activity->jam_mulai)->format('H:i') }}–{{ Carbon\Carbon::parse($activity->jam_selesai)->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
