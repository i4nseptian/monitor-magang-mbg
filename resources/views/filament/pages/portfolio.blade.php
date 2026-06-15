<x-filament-panels::page>
    <div class="space-y-6">

        {{-- PROFILE HEADER --}}
        <x-filament::section>
            <div class="flex flex-col md:flex-row items-center gap-6">
                @if($portfolioData['member'] && $portfolioData['member']->foto_profil)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($portfolioData['member']->foto_profil) }}"
                         class="w-28 h-28 rounded-full object-cover border-4 border-blue-100 dark:border-blue-900">
                @else
                    <div class="w-28 h-28 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-4xl text-blue-600 dark:text-blue-400">
                        {{ substr($portfolioData['user']?->name ?? '?', 0, 1) }}
                    </div>
                @endif
                <div class="text-center md:text-left">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $portfolioData['user']?->name ?? 'Nama Tidak Ditemukan' }}</h2>
                    @if($portfolioData['member'])
                        <p class="text-gray-500 dark:text-gray-400">{{ $portfolioData['member']->program_studi }}</p>
                        <p class="text-gray-500 dark:text-gray-400">NIM: {{ $portfolioData['member']->nim }} | Divisi: {{ $portfolioData['member']->divisi }}</p>
                    @endif
                </div>
            </div>
        </x-filament::section>

        {{-- SKILLS --}}
        @if(count($portfolioData['skills']) > 0)
        <x-filament::section>
            <x-slot name="heading">Skill</x-slot>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($portfolioData['skills'] as $skill)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>{{ $skill->skill_name }}</span>
                        <span class="text-gray-500">{{ $skill->nilai_awal }}% → {{ $skill->nilai_akhir ?? '-' }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $skill->nilai_akhir ?? $skill->nilai_awal }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        {{-- PROJECTS --}}
        @if(count($portfolioData['projects']) > 0)
        <x-filament::section>
            <x-slot name="heading">Project yang Dikerjakan</x-slot>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($portfolioData['projects'] as $project)
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-800 dark:text-white">{{ $project->judul }}</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $project->teknologi }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{!! nl2br(e(Str::limit($project->deskripsi, 100))) !!}</p>
                    <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full
                        @if($project->status_project === 'Selesai') bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400
                        @elseif($project->status_project === 'Sedang Dikerjakan') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                        @else bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400
                        @endif">
                        {{ $project->status_project }}
                    </span>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

        {{-- ACHIEVEMENTS --}}
        @if(count($portfolioData['achievements']) > 0)
        <x-filament::section>
            <x-slot name="heading">Pencapaian</x-slot>
            <div class="space-y-3">
                @foreach($portfolioData['achievements'] as $achievement)
                <div class="border rounded-lg p-4 dark:border-gray-700 flex gap-4 items-start">
                    @if($achievement->screenshot)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($achievement->screenshot) }}" class="w-20 h-20 rounded object-cover flex-shrink-0">
                    @endif
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-white">{{ $achievement->judul }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $achievement->tanggal?->format('d M Y') }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ strip_tags($achievement->deskripsi) }}</p>
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($portfolioData['targets'] as $target)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>{{ $target->target_name }}</span>
                        <span>{{ $target->progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $target->progress }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </x-filament::section>
        @endif

    </div>
</x-filament-panels::page>
