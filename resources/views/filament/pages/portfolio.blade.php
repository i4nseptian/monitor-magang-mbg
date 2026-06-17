<x-filament-panels::page>
    <div class="space-y-6">

        <div class="overflow-hidden rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/80 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="h-28 sm:h-32 bg-gradient-to-r from-brand-700 via-brand-600 to-accent-cyan dark:from-brand-950 dark:via-brand-900 dark:to-slate-900 relative">
                <div class="absolute inset-0 opacity-[0.08] bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
            </div>
            <div class="relative px-6 pb-6">
                <div class="-mt-14 sm:-mt-16 flex flex-col items-center gap-4 md:flex-row md:items-end">
                    
                    @if($portfolioData['member'] && $portfolioData['member']->foto_profil)
                        <div class="h-24 w-24 sm:h-28 sm:w-28 shrink-0 rounded-full border-4 border-white dark:border-gray-900 shadow-lg overflow-hidden bg-slate-50 transition-transform duration-300 hover:scale-105">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($portfolioData['member']->foto_profil) }}"
                                 class="h-full w-full object-cover">
                        </div>
                    @else
                        <div class="flex h-24 w-24 sm:h-28 sm:w-28 shrink-0 items-center justify-center rounded-full border-4 border-white dark:border-gray-900 bg-gradient-to-br from-brand-500 to-brand-600 text-3xl sm:text-4xl font-bold text-white shadow-xl dark:from-brand-600 dark:to-brand-800 font-display transition-transform duration-300 hover:scale-105">
                            {{ strtoupper(substr($portfolioData['user']?->name ?? '?', 0, 1)) }}
                        </div>
                    @endif
                    
                    <div class="min-w-0 text-center md:pb-1 md:text-left flex-1 space-y-1">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white font-display">{{ $portfolioData['user']?->name ?? 'Nama Tidak Ditemukan' }}</h2>
                        @if($portfolioData['member'])
                            <p class="text-xs font-bold text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-accent-cyan dark:from-brand-400 dark:to-accent-cyan uppercase tracking-widest">{{ $portfolioData['member']->program_studi }}</p>
                            <p class="text-xs font-medium text-slate-400 dark:text-slate-500 tabular-nums">
                                NIM {{ $portfolioData['member']->nim }} · Divisi {{ $portfolioData['member']->divisi }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if(count($portfolioData['skills']) > 0)
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-arrow-trending-up" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Perkembangan Skill</span>
                </div>
            </x-slot>
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-4">
                @foreach($portfolioData['skills'] as $skill)
                <div class="space-y-2.5 group">
                    <div class="flex justify-between text-xs font-semibold">
                        <span class="text-slate-700 dark:text-slate-300 font-bold">{{ $skill->skill_name }}</span>
                        <span class="text-slate-500 dark:text-slate-400 tabular-nums">
                            <span class="text-slate-400 dark:text-slate-500">{{ $skill->nilai_awal }}%</span>
                            <span class="text-slate-300 dark:text-slate-600 mx-1">→</span>
                            <span class="text-brand-600 dark:text-brand-400 font-extrabold">{{ $skill->nilai_akhir ?? '-' }}%</span>
                        </span>
                    </div>
                    <div class="relative">
                        <div class="h-2.5 w-full overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800 shadow-inner">
                            <div class="h-full rounded-full bg-gradient-to-r from-brand-500 to-violet-600 transition-all duration-1000 ease-out" style="width: {{ $skill->nilai_akhir ?? $skill->nilai_awal }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        @if(count($portfolioData['projects']) > 0)
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-cube" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Daftar Project</span>
                </div>
            </x-slot>
            
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-4">
                @foreach($portfolioData['projects'] as $project)
                <div class="group relative rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/70 p-5 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 hover:border-brand-200 dark:hover:border-brand-900/60">
                    <div class="flex items-start justify-between gap-3">
                        <h4 class="font-bold text-slate-800 dark:text-white text-sm group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">{{ $project->judul }}</h4>
                        <span @class([
                            'shrink-0 rounded-lg px-2.5 py-1 text-[9px] font-bold uppercase tracking-wider shadow-sm',
                            'bg-emerald-50 text-emerald-700 border border-emerald-100 dark:bg-emerald-950/40 dark:border-emerald-900 dark:text-emerald-400' => $project->status_project === 'Selesai',
                            'bg-amber-50 text-amber-700 border border-amber-100 dark:bg-amber-950/40 dark:border-amber-900 dark:text-amber-400' => $project->status_project === 'Sedang Dikerjakan',
                            'bg-slate-50 text-slate-600 border border-slate-100 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400' => !in_array($project->status_project, ['Selesai', 'Sedang Dikerjakan']),
                        ])>{{ $project->status_project }}</span>
                    </div>
                    @if($project->teknologi)
                        <p class="mt-1.5 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wide">{{ $project->teknologi }}</p>
                    @endif
                    <p class="mt-3 text-xs leading-relaxed text-slate-500 dark:text-slate-400 font-light line-clamp-3">{{ Str::limit(strip_tags($project->deskripsi), 140) }}</p>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        @if(count($portfolioData['achievements']) > 0)
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-trophy" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Pencapaian & Apresiasi</span>
                </div>
            </x-slot>
            
            <div class="space-y-4 mt-4">
                @foreach($portfolioData['achievements'] as $achievement)
                    <div class="flex flex-col sm:flex-row gap-4 rounded-2xl border border-slate-200/60 dark:border-slate-800/60 bg-white dark:bg-gray-900/70 p-5 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 hover:border-brand-200 dark:hover:border-brand-900/60">
                        @if($achievement->screenshot)
                            <div class="h-20 w-32 shrink-0 rounded-xl overflow-hidden border border-slate-100 dark:border-slate-800 shadow-sm ring-1 ring-slate-100/50 dark:ring-slate-800 bg-slate-50 dark:bg-slate-950/50">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($achievement->screenshot) }}" class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                            </div>
                        @endif
                        <div class="min-w-0 flex-1 space-y-1">
                            <div class="flex items-center justify-between gap-2">
                                <h4 class="font-bold text-slate-800 dark:text-white text-sm">{{ $achievement->judul }}</h4>
                                <span class="text-[9px] font-bold text-slate-400 dark:text-slate-500 tabular-nums uppercase">{{ $achievement->tanggal?->format('d M Y') }}</span>
                            </div>
                            <p class="text-xs leading-relaxed text-slate-500 dark:text-slate-400 font-light">{{ strip_tags($achievement->deskripsi) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        @if(count($portfolioData['targets']) > 0)
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-md">
                        <x-filament::icon icon="heroicon-o-check-badge" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-slate-200">Target & Pencapaian Kerja</span>
                </div>
            </x-slot>
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-4">
                @foreach($portfolioData['targets'] as $target)
                <div class="space-y-2.5 group">
                    <div class="flex justify-between text-xs font-semibold">
                        <span class="text-slate-700 dark:text-slate-300 font-bold">{{ $target->target_name }}</span>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-400 dark:to-teal-400 font-extrabold tabular-nums">{{ $target->progress }}%</span>
                    </div>
                    <div class="relative">
                        <div class="h-2.5 w-full overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800 shadow-inner">
                            <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-500 transition-all duration-1000 ease-out shadow-sm shadow-emerald-500/20" style="width: {{ $target->progress }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

    </div>
</x-filament-panels::page>