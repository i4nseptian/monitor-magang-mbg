<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Card Progress Magang --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6 dark:border-gray-700 dark:bg-gray-900">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="space-y-4 md:col-span-2">
                    <div>
                        <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            <x-filament::icon icon="heroicon-o-chart-bar" class="h-4 w-4" />
                            Progres Magang
                        </div>
                        <div class="mt-1.5 flex items-baseline gap-2">
                            <span class="text-3xl font-bold text-primary-700 dark:text-primary-400">{{ $progressPercent }}%</span>
                            <span class="text-xs tabular-nums text-gray-400 dark:text-gray-500">({{ $daysElapsed }} / {{ $totalDays }} hari)</span>
                        </div>
                    </div>
                    <div class="relative h-2.5 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-primary-700 transition-all duration-700 ease-out dark:from-primary-400 dark:to-primary-600" style="width: {{ $progressPercent }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-xs tabular-nums text-gray-500 dark:text-gray-400">
                        <span>{{ $tglMulai->translatedFormat('d M Y') }}</span>
                        <span>{{ $tglSelesai->translatedFormat('d M Y') }}</span>
                    </div>
                </div>

                @if(!auth()->user()->isMahasiswa())
                    <div class="border-t border-gray-100 pt-4 md:border-l md:border-t-0 md:pl-6 md:pt-0 dark:border-gray-800">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Filter Mahasiswa</label>
                        <select wire:model.live="selectedUserId"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm transition focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                            <option value="">Semua Mahasiswa</option>
                            @foreach($mahasiswaList as $mhs)
                                <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>

        {{-- Timeline Stream --}}
        <div class="relative ml-4 space-y-6 border-l-2 border-gray-200 pb-8 dark:border-gray-700 md:ml-5">
            @if($timelineEvents->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 pl-8 text-center md:pl-10">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-50 dark:bg-gray-800">
                        <x-filament::icon icon="heroicon-o-clock" class="h-6 w-6 text-gray-300 dark:text-gray-600" />
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-500 dark:text-gray-400">Belum ada logbook untuk filter ini.</p>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">Pilih mahasiswa lain atau buat entri baru.</p>
                </div>
            @else
                @foreach($timelineEvents as $event)
                    <div class="relative pl-8 md:pl-10">
                        <span class="absolute -left-[9px] top-2 h-3.5 w-3.5 rounded-full border-[3px] border-white bg-primary-600 ring-2 ring-primary-100 dark:border-gray-900 dark:bg-primary-500 dark:ring-primary-900"></span>

                        <article class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md dark:border-gray-700 dark:bg-gray-900">
                            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 px-4 py-3 sm:px-5 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-50 text-xs font-bold text-primary-700 dark:bg-primary-950 dark:text-primary-300">
                                        {{ strtoupper(substr($event->user->name, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $event->user->name }}</h4>
                                        <p class="text-[11px] tabular-nums text-gray-400 dark:text-gray-500">Hari ke-{{ $event->hari_ke }} · {{ $event->tanggal->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-1.5">
                                    <span class="rounded-md bg-gray-100 px-2 py-0.5 text-[11px] font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-300">{{ $event->kategori_kegiatan }}</span>
                                    <span class="rounded-md bg-primary-50 px-2 py-0.5 text-[11px] font-medium tabular-nums text-primary-700 dark:bg-primary-950 dark:text-primary-300">{{ $event->jam_mulai->format('H:i') }}–{{ $event->jam_selesai->format('H:i') }}</span>
                                </div>
                            </div>

                            <div class="space-y-3 p-4 sm:p-5">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $event->judul_kegiatan }}</h3>
                                <div class="prose prose-sm max-w-none leading-relaxed text-gray-600 dark:prose-invert dark:text-gray-300">
                                    {!! $event->deskripsi_kegiatan !!}
                                </div>

                                @if($event->photos->isNotEmpty())
                                    <div class="grid grid-cols-2 gap-2 pt-1 sm:grid-cols-4">
                                        @foreach($event->photos as $photo)
                                            <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank" class="group block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Dokumentasi" class="h-24 w-full object-cover transition duration-300 group-hover:scale-105">
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach

                <div class="flex justify-center pl-8 pt-4 md:pl-10">
                    <div class="[&_.pagination]:gap-1">
                        {{ $timelineEvents->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
