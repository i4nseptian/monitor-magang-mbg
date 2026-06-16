<x-filament-widgets::widget>
    @if ($is_mahasiswa)
        @if (!$has_submitted_today)
            <div class="flex items-start gap-4 rounded-xl border border-amber-200 bg-amber-50/80 p-4 dark:border-amber-900/50 dark:bg-amber-950/20">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-semibold text-amber-900 dark:text-amber-300">Belum isi logbook hari ini</h4>
                    <p class="mt-0.5 text-xs text-amber-700/80 dark:text-amber-400/80">
                        Catat kegiatan magang Anda sebelum hari berakhir.
                    </p>
                    <a href="{{ \App\Filament\Resources\LogbookResource::getUrl('create') }}"
                       class="mt-3 inline-flex items-center gap-1.5 rounded-lg bg-amber-600 px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-amber-700">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Isi Logbook
                    </a>
                </div>
            </div>
        @else
            <div class="flex items-center gap-4 rounded-xl border border-emerald-200 bg-emerald-50/80 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/20">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-emerald-900 dark:text-emerald-300">Logbook hari ini sudah diisi</h4>
                    <p class="mt-0.5 text-xs text-emerald-700/80 dark:text-emerald-400/80">Bagus, pertahankan konsistensinya.</p>
                </div>
            </div>
        @endif
    @else
        @if (count($missing_students) > 0)
            <div class="flex items-start gap-4 rounded-xl border border-amber-200 bg-amber-50/80 p-4 dark:border-amber-900/50 dark:bg-amber-950/20">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-semibold text-amber-900 dark:text-amber-300">Belum mengisi logbook hari ini</h4>
                    <div class="mt-2 flex flex-wrap gap-1.5">
                        @foreach ($missing_students as $name)
                            <span class="inline-flex rounded-md bg-white/80 px-2 py-1 text-xs font-medium text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">
                                {{ $name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="flex items-center gap-4 rounded-xl border border-emerald-200 bg-emerald-50/80 p-4 dark:border-emerald-900/50 dark:bg-emerald-950/20">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-emerald-900 dark:text-emerald-300">Semua mahasiswa sudah mengisi</h4>
                    <p class="mt-0.5 text-xs text-emerald-700/80 dark:text-emerald-400/80">Logbook hari ini lengkap.</p>
                </div>
            </div>
        @endif
    @endif
</x-filament-widgets::widget>
