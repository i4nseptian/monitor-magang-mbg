@php
    $hour = now()->hour;
    if ($hour < 10) { $greeting = 'Selamat Pagi'; $greetingIcon = 'heroicon-m-sun'; }
    elseif ($hour < 15) { $greeting = 'Selamat Siang'; $greetingIcon = 'heroicon-m-sun'; }
    elseif ($hour < 18) { $greeting = 'Selamat Sore'; $greetingIcon = 'heroicon-m-sun'; }
    else { $greeting = 'Selamat Malam'; $greetingIcon = 'heroicon-m-moon'; }
@endphp

<div class="mb-6 space-y-5">

    <!-- Greeting Card -->
    <div class="rounded-xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-[#0d121c] p-5 sm:p-6 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-800 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:text-gray-400 border border-gray-100 dark:border-gray-700">
                        {{ $roleLabel }}
                    </span>
                    @if ($hariKe > 0)
                        <span class="inline-flex items-center rounded-md bg-indigo-50 dark:bg-indigo-950/40 px-2.5 py-0.5 text-xs font-medium text-indigo-700 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50">
                            Hari ke-{{ $hariKe }}
                        </span>
                    @endif
                    @if (isset($hariTersisa) && $hariTersisa > 0)
                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 dark:bg-amber-950/40 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:text-amber-400 border border-amber-100 dark:border-amber-900/50">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                            Sisa {{ $hariTersisa }} Hari
                        </span>
                    @endif
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $greeting }}, {{ $user->name }}
                </h1>
                <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">
                    Diskominfo Makassar · {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="shrink-0">
                @if($user->member?->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->member->foto_profil))
                    <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-full overflow-hidden ring-2 ring-gray-50 dark:ring-gray-800">
                        <img src="{{ asset('storage/' . $user->member->foto_profil) }}" alt="" class="h-full w-full object-cover">
                    </div>
                @else
                    <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-full bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center ring-2 ring-gray-50 dark:ring-gray-800">
                        <svg class="h-6 w-6 sm:h-7 sm:w-7 text-indigo-400 dark:text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Deadlines -->
    @if(isset($deadlines) && $deadlines->isNotEmpty())
        <div class="rounded-xl border border-amber-100 dark:border-amber-900/50 bg-amber-25 dark:bg-amber-950/10 p-4 sm:p-5">
            <div class="flex items-center gap-2 mb-4">
                <div class="h-7 w-7 rounded-md bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center">
                    <svg class="h-4 w-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-amber-800 dark:text-amber-300">Tenggat Waktu Mendatang</span>
                <span class="text-xs text-amber-600 dark:text-amber-500 ml-1">({{ $deadlines->count() }} item)</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($deadlines as $item)
                    <div class="flex items-start gap-3 rounded-lg border border-amber-100 dark:border-amber-900/40 bg-white dark:bg-[#0d121c] p-3 transition-all hover:border-amber-200 dark:hover:border-amber-800 hover:shadow-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md text-xs font-bold 
                            {{ $item['type'] === 'target' ? 'bg-indigo-50 dark:bg-indigo-950/50 text-indigo-700 dark:text-indigo-400' : 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400' }}">
                            {{ $item['type'] === 'target' ? 'T' : 'P' }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item['title'] }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                                @if ($item['remaining_days'] !== null && $item['remaining_days'] > 0)
                                    <span class="font-semibold text-amber-600 dark:text-amber-400">{{ $item['remaining_days'] }} hari lagi</span>
                                @elseif ($item['remaining_days'] === 0)
                                    <span class="font-semibold text-red-600 dark:text-red-400">Hari ini!</span>
                                @else
                                    Project
                                @endif
                                @if ($item['user_name'])
                                    <span class="mx-1">·</span>
                                    <span>{{ $item['user_name'] }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>