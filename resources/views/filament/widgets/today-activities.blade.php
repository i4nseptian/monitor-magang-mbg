<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Header — Metronic clean --}}
        <div class="mb-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Aktivitas Hari Ini</h3>
            </div>
            @if (!$activities->isEmpty())
                <span class="rounded px-2 py-0.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800">
                    {{ $activities->count() }} kegiatan
                </span>
            @endif
        </div>

        @if ($activities->isEmpty())
            {{-- Empty state — Metronic minimal --}}
            <div class="rounded-lg border border-dashed border-slate-200 dark:border-slate-700 py-10 text-center">
                <div class="mx-auto mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                    <svg class="h-5 w-5 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Belum ada kegiatan hari ini</p>
                <p class="mt-0.5 text-xs text-slate-400 dark:text-slate-500">Buat entri baru melalui menu Logbook.</p>
            </div>
        @else
            {{-- Activity list — Metronic clean divide --}}
            <div class="max-h-[420px] space-y-2 overflow-y-auto pr-1">
                @foreach ($activities as $activity)
                    <div class="flex items-start gap-3 rounded-lg border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900/40 p-3 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded bg-indigo-50 dark:bg-indigo-950/40 text-xs font-semibold tabular-nums text-indigo-600 dark:text-indigo-400">
                            {{ $loop->iteration }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-col gap-1.5 sm:flex-row sm:items-start sm:justify-between">
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-medium text-slate-800 dark:text-slate-200">
                                        {{ $activity->judul_kegiatan }}
                                    </p>
                                    <div class="mt-1 flex flex-wrap items-center gap-1.5">
                                        @if (!$is_mahasiswa && $activity->user)
                                            <span class="inline-flex items-center gap-1 rounded px-2 py-0.5 text-[11px] font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800">
                                                <svg class="h-3 w-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                                {{ $activity->user->name }}
                                            </span>
                                        @endif
                                        <span class="rounded px-2 py-0.5 text-[11px] font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/30">
                                            {{ $activity->kategori_kegiatan }}
                                        </span>
                                    </div>
                                </div>
                                <span class="shrink-0 self-start rounded px-2 py-0.5 text-[11px] font-medium tabular-nums text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-800">
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
