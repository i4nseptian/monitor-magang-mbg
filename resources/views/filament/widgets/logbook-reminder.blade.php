<x-filament-widgets::widget>
    @if ($is_mahasiswa)
        @if (!$has_submitted_today)
            {{-- Warning: belum isi logbook — Metronic alert style --}}
            <div class="flex items-start gap-3.5 rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-4 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 dark:bg-amber-950/30 text-amber-600 dark:text-amber-400">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Belum isi logbook hari ini</h4>
                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Catat kegiatan magang Anda sebelum hari berakhir.
                    </p>
                    <a href="{{ \App\Filament\Resources\LogbookResource::getUrl('create') }}"
                       class="mt-2.5 inline-flex items-center gap-1.5 rounded px-3 py-1.5 text-xs font-semibold text-white bg-amber-600 dark:bg-amber-600 hover:bg-amber-700 dark:hover:bg-amber-500 transition-colors">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Isi Logbook
                    </a>
                </div>
            </div>
        @else
            {{-- Success: sudah isi — Metronic clean success --}}
            <div class="flex items-center gap-3.5 rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-4 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Logbook hari ini sudah diisi</h4>
                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">Bagus, pertahankan konsistensinya.</p>
                </div>
            </div>
        @endif
    @else
        @if (count($missing_students) > 0)
            {{-- Warning: mahasiswa belum isi — Metronic list style --}}
            <div class="flex items-start gap-3.5 rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-4 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 dark:bg-amber-950/30 text-amber-600 dark:text-amber-400">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Belum mengisi logbook hari ini</h4>
                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400 tabular-nums">{{ count($missing_students) }} mahasiswa belum mengisi</p>
                    <div class="mt-2.5 flex flex-wrap gap-1.5">
                        @foreach ($missing_students as $name)
                            <span class="inline-flex items-center rounded px-2 py-1 text-xs font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800">
                                {{ $name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            {{-- Success: semua sudah isi — Metronic clean --}}
            <div class="flex items-center gap-3.5 rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-4 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Semua mahasiswa sudah mengisi logbook</h4>
                    <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">Lengkap untuk hari ini.</p>
                </div>
            </div>
        @endif
    @endif
</x-filament-widgets::widget>
