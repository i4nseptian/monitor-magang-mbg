<x-filament-panels::page>
    <div class="space-y-6">
        
        {{-- Card Progress Magang --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="md:col-span-2 space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Progres Keseluruhan Magang</h3>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="text-3xl font-extrabold text-primary-600 dark:text-primary-400">{{ $progressPercent }}%</span>
                        <span class="text-xs text-gray-400 dark:text-gray-500">({{ $daysElapsed }} dari {{ $totalDays }} Hari Terlampaui)</span>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-3.5 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-full rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
                </div>

                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                    <span class="flex items-center gap-1">🚀 Mulai: {{ $tglMulai->translatedFormat('d M Y') }}</span>
                    <span class="flex items-center gap-1">🏁 Selesai: {{ $tglSelesai->translatedFormat('d M Y') }}</span>
                </div>
            </div>

            {{-- Filter Mahasiswa --}}
            @if(!auth()->user()->isMahasiswa())
                <div class="flex flex-col justify-center border-t md:border-t-0 md:border-l border-gray-200 dark:border-gray-700 md:pl-6 pt-4 md:pt-0">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pantau Mahasiswa:</label>
                    <select wire:model.live="selectedUserId"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Mahasiswa</option>
                        @foreach($mahasiswaList as $mhs)
                            <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        {{-- Stream Garis Waktu --}}
        <div class="relative border-l-2 border-gray-200 dark:border-gray-700 ml-4 md:ml-6 space-y-8 pb-10">
            @if($timelineEvents->isEmpty())
                <div class="pl-8 text-center py-10 text-gray-500 dark:text-gray-400">
                    Belum ada logbook/aktivitas yang tercatat untuk filter ini.
                </div>
            @else
                @foreach($timelineEvents as $event)
                    <div class="relative pl-8 md:pl-10">
                        {{-- Dot Indikator --}}
                        <span class="absolute -left-[9px] top-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-white dark:bg-gray-800 ring-4 ring-primary-500/20">
                            <span class="h-2 w-2 rounded-full bg-primary-500"></span>
                        </span>

                        {{-- Card Event --}}
                        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm transition duration-200 hover:shadow-md">
                            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 dark:border-gray-700 pb-3 mb-3">
                                <div class="flex items-center gap-3">
                                    {{-- Avatar Placeholder / Inisial --}}
                                    <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-950 text-primary-600 dark:text-primary-400 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($event->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm text-gray-800 dark:text-white">{{ $event->user->name }}</h4>
                                        <p class="text-[10px] text-gray-400 dark:text-gray-500">Hari ke-{{ $event->hari_ke }} • {{ $event->tanggal->translatedFormat('l, d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-0.5 rounded-full font-semibold">
                                        {{ $event->kategori_kegiatan }}
                                    </span>
                                    <span class="text-xs bg-blue-50 dark:bg-blue-950 text-blue-600 dark:text-blue-400 px-2 py-0.5 rounded-full font-semibold">
                                        {{ $event->jam_mulai->format('H:i') }} - {{ $event->jam_selesai->format('H:i') }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-base font-bold text-gray-800 dark:text-white leading-snug">
                                    {{ $event->judul_kegiatan }}
                                </h3>
                                <div class="text-sm text-gray-600 dark:text-gray-300 prose max-w-none dark:prose-invert">
                                    {!! $event->deskripsi_kegiatan !!}
                                </div>

                                {{-- Dokumentasi Foto --}}
                                @if($event->photos->isNotEmpty())
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 pt-2">
                                        @foreach($event->photos as $photo)
                                            <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank" class="block group relative overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Dokumentasi" class="object-cover w-full h-24 transition duration-300 group-hover:scale-105">
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Pagination Links --}}
                <div class="pl-8 md:pl-10 pt-4">
                    {{ $timelineEvents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
