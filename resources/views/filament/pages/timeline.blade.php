<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Card Progress Magang --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Progres Magang</p>
                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-3xl font-bold text-primary-700 dark:text-primary-400">{{ $progressPercent }}%</span>
                            <span class="text-xs text-gray-400">({{ $daysElapsed }} / {{ $totalDays }} hari)</span>
                        </div>
                    </div>
                    <div class="h-2 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-full rounded-full bg-primary-600 transition-all duration-500 dark:bg-primary-500" style="width: {{ $progressPercent }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>{{ $tglMulai->translatedFormat('d M Y') }}</span>
                        <span>{{ $tglSelesai->translatedFormat('d M Y') }}</span>
                    </div>
                </div>

                @if(!auth()->user()->isMahasiswa())
                    <div class="border-t border-gray-100 pt-4 md:border-l md:border-t-0 md:pl-6 md:pt-0 dark:border-gray-800">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">Filter Mahasiswa</label>
                        <select wire:model.live="selectedUserId"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
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
        <div class="relative ml-3 space-y-6 border-l-2 border-gray-200 pb-8 dark:border-gray-700 md:ml-5">
            @if($timelineEvents->isEmpty())
                <div class="py-12 pl-8 text-center">
                    <p class="text-sm text-gray-500">Belum ada logbook untuk filter ini.</p>
                </div>
            @else
                @foreach($timelineEvents as $event)
                    <div class="relative pl-8 md:pl-10">
                        <span class="absolute -left-[7px] top-2 h-3 w-3 rounded-full border-2 border-white bg-primary-600 ring-2 ring-primary-100 dark:border-gray-900 dark:ring-primary-900"></span>

                        <article class="overflow-hidden rounded-xl border border-gray-200 bg-white transition hover:shadow-sm dark:border-gray-700 dark:bg-gray-900">
                            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 px-5 py-3 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-50 text-xs font-bold text-primary-700 dark:bg-primary-950 dark:text-primary-300">
                                        {{ strtoupper(substr($event->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $event->user->name }}</h4>
                                        <p class="text-[11px] text-gray-400">Hari ke-{{ $event->hari_ke }} · {{ $event->tanggal->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded-md bg-gray-100 px-2 py-0.5 text-[11px] font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-300">{{ $event->kategori_kegiatan }}</span>
                                    <span class="rounded-md bg-primary-50 px-2 py-0.5 text-[11px] font-medium tabular-nums text-primary-700 dark:bg-primary-950 dark:text-primary-300">{{ $event->jam_mulai->format('H:i') }}–{{ $event->jam_selesai->format('H:i') }}</span>
                                </div>
                            </div>

                            <div class="space-y-3 p-5">
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $event->judul_kegiatan }}</h3>
                                <div class="prose prose-sm max-w-none text-gray-600 dark:prose-invert dark:text-gray-300">
                                    {!! $event->deskripsi_kegiatan !!}
                                </div>

                                @if($event->photos->isNotEmpty())
                                    <div class="grid grid-cols-2 gap-2 pt-1 sm:grid-cols-4">
                                        @foreach($event->photos as $photo)
                                            <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank" class="group block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Dokumentasi" class="h-24 w-full object-cover transition group-hover:scale-105">
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach

                <div class="pl-8 md:pl-10">
                    {{ $timelineEvents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
