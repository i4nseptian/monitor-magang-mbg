<x-filament-panels::page>
    <div class="space-y-6">

        {{-- PROFILE HEADER --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">
            <div class="h-24 bg-gradient-to-r from-primary-800 via-primary-700 to-primary-600 dark:from-primary-950 dark:via-primary-900 dark:to-primary-800"></div>
            <div class="relative px-6 pb-6">
                <div class="-mt-12 flex flex-col items-center gap-4 md:flex-row md:items-end">
                    @if($portfolioData['member'] && $portfolioData['member']->foto_profil)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($portfolioData['member']->foto_profil) }}"
                             class="h-24 w-24 shrink-0 rounded-full border-4 border-white object-cover shadow-sm dark:border-gray-900">
                    @else
                        <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-full border-4 border-white bg-primary-100 text-3xl font-bold text-primary-700 shadow-sm dark:border-gray-900 dark:bg-primary-950 dark:text-primary-300">
                            {{ strtoupper(substr($portfolioData['user']?->name ?? '?', 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0 text-center md:pb-1 md:text-left">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $portfolioData['user']?->name ?? 'Nama Tidak Ditemukan' }}</h2>
                        @if($portfolioData['member'])
                            <p class="mt-0.5 text-sm font-medium text-gray-500">{{ $portfolioData['member']->program_studi }}</p>
                            <p class="text-xs tabular-nums text-gray-400">NIM {{ $portfolioData['member']->nim }} · {{ $portfolioData['member']->divisi }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- SKILLS --}}
        @if(count($portfolioData['skills']) > 0)
        <x-filament::section>
            <x-slot name="heading">Skill</x-slot>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                @foreach($portfolioData['skills'] as $skill)
                <div>
                    <div class="mb-1.5 flex justify-between text-sm">
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $skill->skill_name }}</span>
                        <span class="text-xs tabular-nums text-gray-500">{{ $skill->nilai_awal }}% → {{ $skill->nilai_akhir ?? '-' }}%</span>
                    </div>
                    <div class="h-2 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-full rounded-full bg-primary-600 transition-all dark:bg-primary-500" style="width: {{ $skill->nilai_akhir ?? $skill->nilai_awal }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        {{-- PROJECTS --}}
        @if(count($portfolioData['projects']) > 0)
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-folder-open" class="h-5 w-5 text-primary-600" />
                    Project
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach($portfolioData['projects'] as $project)
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition hover:shadow-md dark:border-gray-700 dark:bg-gray-900">
                    <div class="flex items-start justify-between gap-2">
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $project->judul }}</h4>
                        <span @class([
                            'shrink-0 whitespace-nowrap rounded-md px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider',
                            'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' => $project->status_project === 'Selesai',
                            'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400' => $project->status_project === 'Sedang Dikerjakan',
                            'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' => !in_array($project->status_project, ['Selesai', 'Sedang Dikerjakan']),
                        ])>{{ $project->status_project }}</span>
                    </div>
                    @if($project->teknologi)
                        <p class="mt-1 text-xs font-medium text-gray-400">{{ $project->teknologi }}</p>
                    @endif
                    <p class="mt-2 text-sm leading-relaxed text-gray-600 dark:text-gray-300">{{ Str::limit(strip_tags($project->deskripsi), 120) }}</p>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        {{-- ACHIEVEMENTS --}}
        @if(count($portfolioData['achievements']) > 0)
        <x-filament::section>
            <x-slot name="heading">
                <div class="flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-trophy" class="h-5 w-5 text-amber-500" />
                    Pencapaian
                </div>
            </x-slot>
            <div class="space-y-3">
                @foreach($portfolioData['achievements'] as $achievement)
                <div class="flex gap-4 rounded-xl border border-gray-200 bg-white p-4 shadow-sm transition hover:shadow-md dark:border-gray-700 dark:bg-gray-900">
                    @if($achievement->screenshot)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($achievement->screenshot) }}" class="h-16 w-16 shrink-0 rounded-lg object-cover shadow-sm">
                    @endif
                    <div class="min-w-0">
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $achievement->judul }}</h4>
                        <p class="text-xs tabular-nums text-gray-400">{{ $achievement->tanggal?->format('d M Y') }}</p>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300">{{ strip_tags($achievement->deskripsi) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        {{-- TARGETS --}}
        @if(count($portfolioData['targets']) > 0)
        <x-filament::section>
            <x-slot name="heading">Target & Progress</x-slot>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                @foreach($portfolioData['targets'] as $target)
                <div>
                    <div class="mb-1.5 flex justify-between text-sm">
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $target->target_name }}</span>
                        <span class="text-xs tabular-nums text-gray-500">{{ $target->progress }}%</span>
                    </div>
                    <div class="h-2 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-full rounded-full bg-emerald-500" style="width: {{ $target->progress }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

    </div>
</x-filament-panels::page>
