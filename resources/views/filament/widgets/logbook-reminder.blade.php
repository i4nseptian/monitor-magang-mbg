<x-filament-widgets::widget>
    @if ($is_mahasiswa)
        @if (!$has_submitted_today)
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-950/20 dark:to-orange-950/20 border-l-4 border-amber-500 p-4 rounded-r-xl shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center text-amber-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-amber-800 dark:text-amber-400 text-sm">Pengingat Pengisian Logbook</h4>
                        <p class="text-xs text-amber-700 dark:text-amber-500 mt-0.5">
                            Anda belum mengisi logbook harian untuk hari ini. Silakan catat kegiatan magang Anda sekarang.
                        </p>
                        <div class="mt-2.5">
                            <a href="{{ \App\Filament\Resources\LogbookResource::getUrl('create') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-white bg-gradient-to-r from-amber-500 to-orange-500 px-4 py-2 rounded-lg hover:from-amber-600 hover:to-orange-600 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Isi Logbook Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-950/20 dark:to-green-950/20 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-emerald-800 dark:text-emerald-400 text-sm">Logbook Hari Ini</h4>
                        <p class="text-xs text-emerald-700 dark:text-emerald-500 mt-0.5">
                            Anda sudah mengisi logbook hari ini. Pertahankan!
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @else
        @if (count($missing_students) > 0)
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-950/20 dark:to-orange-950/20 border-l-4 border-amber-500 p-4 rounded-r-xl shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center text-amber-500 mt-0.5">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-amber-800 dark:text-amber-400 text-sm">Monitoring Pengisian Logbook</h4>
                        <p class="text-xs text-amber-700 dark:text-amber-500 mt-0.5">
                            Mahasiswa berikut <strong>belum</strong> mengisi logbook hari ini:
                        </p>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            @foreach ($missing_students as $name)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300 text-xs font-medium">
                                    {{ $name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-950/20 dark:to-green-950/20 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-emerald-800 dark:text-emerald-400 text-sm">Semua Sudah Mengisi!</h4>
                        <p class="text-xs text-emerald-700 dark:text-emerald-500 mt-0.5">
                            Seluruh mahasiswa sudah mengisi logbook hari ini.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @endif
</x-filament-widgets::widget>
