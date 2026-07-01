<x-filament-panels::page>
    <div class="space-y-6">

        <div class="rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="space-y-4 md:col-span-2">
                    <div>
                        <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-500">
                            <div class="flex h-5 w-5 items-center justify-center rounded-md bg-gradient-to-br from-brand-500 to-brand-600 text-white">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                                </svg>
                            </div>
                            Progres Pelaksanaan Magang
                        </div>
                        <div class="mt-2 flex items-baseline gap-2">
                            <span class="text-3xl sm:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-brand-400 dark:from-brand-400 dark:to-brand-300 font-display">{{ $progressPercent }}%</span>
                            <span class="text-xs font-semibold text-slate-400 dark:text-slate-500 tabular-nums">({{ $daysElapsed }} / {{ $totalDays }} Hari Berjalan)</span>
                        </div>
                    </div>
                    
                    <div class="relative h-3.5 w-full overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800 shadow-inner">
                        <div class="h-full rounded-full bg-gradient-to-r from-brand-500 via-brand-400 to-accent-cyan transition-all duration-1000 ease-out shadow-lg shadow-brand-500/20" style="width: {{ $progressPercent }}%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 tabular-nums">
                        <span class="flex items-center gap-1.5">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $tglMulai->translatedFormat('d M Y') }}
                        </span>
                        <span class="h-px w-8 bg-slate-200 dark:bg-slate-700"></span>
                        <span class="flex items-center gap-1.5">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ $tglSelesai->translatedFormat('d M Y') }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-slate-100 dark:border-slate-800 pt-5 md:border-l md:border-t-0 md:pl-6 md:pt-0 space-y-3">
                    @if(!auth()->user()->isMahasiswa())
                        <div>
                            <label class="mb-1.5 block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Filter Mahasiswa</label>
                            <select wire:model.live="selectedUserId"
                                class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-slate-800 dark:text-white shadow-sm transition-all focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                                <option value="">Semua Mahasiswa</option>
                                @foreach($mahasiswaList as $mhs)
                                    <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div>
                        <label class="mb-1.5 block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Filter Kategori</label>
                        <select wire:model.live="kategoriFilter"
                            class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-slate-800 dark:text-white shadow-sm transition-all focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori }}">{{ $kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Cari Kegiatan</label>
                        <input type="text" wire:model.live.debounce.300ms="searchQuery" placeholder="Cari judul kegiatan..."
                            class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-gray-800 px-3.5 py-2.5 text-sm font-semibold text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 shadow-sm transition-all focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                    </div>
                </div>
            </div>
        </div>

        <div class="relative ml-3 sm:ml-5 space-y-6 border-l-2 border-slate-200 dark:border-slate-700 pb-8 md:ml-6">
            @if($timelineEvents->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 pl-6 text-center sm:pl-8 md:pl-10">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 shadow-sm">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-sm font-semibold text-slate-700 dark:text-slate-300">Belum ada logbook untuk filter ini.</p>
                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Pilih mahasiswa lain atau buat entri logbook baru.</p>
                </div>
            @else
                @foreach($timelineEvents as $event)
                    <div class="relative pl-6 sm:pl-8 md:pl-10 group" style="animation: fadeInUp 0.4s ease-out {{ $loop->index * 0.05 }}s both;">
                        
                        <span class="absolute -left-[9px] top-5 h-4 w-4 rounded-full border-4 border-white dark:border-gray-900 bg-brand-600 dark:bg-brand-500 shadow-sm ring-4 ring-brand-50 dark:ring-brand-950/40 transition-transform duration-300 group-hover:scale-125"></span>

                        <article class="overflow-hidden rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 shadow-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 hover:border-slate-300 dark:hover:border-slate-700">
                            
                            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800/80 px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @php
                                        $words = explode(' ', $event->user->name);
                                        $initials = count($words) >= 2
                                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                                            : strtoupper(substr($event->user->name, 0, 2));
                                    @endphp
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-xs font-bold text-white shadow-md">
                                        {{ $initials }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-bold text-slate-800 dark:text-white">{{ $event->user->name }}</h4>
                                        <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-1.5 mt-0.5 uppercase tracking-wide">
                                            <span>Hari ke-{{ $event->hari_ke }}</span>
                                            <span class="text-slate-300 dark:text-slate-600">·</span>
                                            <span>{{ $event->tanggal->translatedFormat('d M Y') }}</span>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="rounded-lg bg-slate-100 dark:bg-slate-800 px-3 py-1 text-[10px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">{{ $event->kategori_kegiatan }}</span>
                                    <span class="rounded-lg bg-gradient-to-r from-brand-50 to-brand-50/80 dark:from-brand-950/50 dark:to-brand-950/30 px-3 py-1 text-[10px] font-bold text-brand-700 dark:text-brand-400 uppercase tracking-wider tabular-nums">{{ $event->jam_mulai->format('H:i') }} – {{ $event->jam_selesai->format('H:i') }}</span>
                                    @if(isset($event->mood))
                                        <span class="text-sm" title="Mood: {{ $event->mood }}">
                                            @php
                                                $moodEmoji = match($event->mood) {
                                                    'Senang' => '😊',
                                                    'Biasa' => '😐',
                                                    'Lelah' => '😴',
                                                    'Sedih' => '😢',
                                                    default => '📝'
                                                };
                                            @endphp
                                            {{ $moodEmoji }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-4 p-5">
                                <h3 class="font-bold text-slate-900 dark:text-white text-base font-display">{{ $event->judul_kegiatan }}</h3>
                                <div class="prose prose-sm max-w-none leading-relaxed text-slate-600 dark:prose-invert dark:text-slate-400 font-light">
                                    {!! $event->deskripsi_kegiatan !!}
                                </div>

                                @if($event->photos->isNotEmpty())
                                    <div class="grid grid-cols-2 gap-3 pt-2 sm:grid-cols-4 lg:grid-cols-6">
                                        @foreach($event->photos as $photo)
                                            <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank" class="group block overflow-hidden rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm transition-all duration-300 hover:scale-[1.03] hover:shadow-lg">
                                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Dokumentasi" class="h-28 w-full object-cover transition duration-300 group-hover:opacity-90">
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach

                <div class="flex justify-center pl-6 pt-6 sm:pl-8 md:pl-10">
                    <div class="[&_.pagination]:gap-1">
                        {{ $timelineEvents->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>