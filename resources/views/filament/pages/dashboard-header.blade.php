@php
    $hour = now()->hour;
    if ($hour < 10) { $greeting = 'Selamat Pagi'; }
    elseif ($hour < 15) { $greeting = 'Selamat Siang'; }
    elseif ($hour < 18) { $greeting = 'Selamat Sore'; }
    else { $greeting = 'Selamat Malam'; }
@endphp

<div class="mb-6 space-y-4">

    {{-- Greeting Card — Metronic clean style --}}
    <div class="rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-5 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
        <div class="flex items-center justify-between gap-4">
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2 mb-2.5">
                    <span class="inline-flex items-center rounded px-2 py-0.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800">
                        {{ $roleLabel }}
                    </span>
                    @if ($hariKe > 0)
                        <span class="inline-flex items-center rounded px-2 py-0.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/40">
                            Hari ke-{{ $hariKe }}
                        </span>
                    @endif
                    @if (isset($hariTersisa) && $hariTersisa > 0)
                        <span class="inline-flex items-center gap-1.5 rounded px-2 py-0.5 text-xs font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/30">
                            <span class="kt-dot kt-dot-warning"></span>
                            {{ $hariTersisa }} hari tersisa
                        </span>
                    @endif
                </div>
                <h1 class="text-lg font-semibold text-slate-900 dark:text-white leading-tight">
                    {{ $greeting }}, {{ $user->name }}
                </h1>
                <p class="mt-1 text-sm text-slate-400 dark:text-slate-500 font-medium">
                    Diskominfo Makassar &middot; {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="shrink-0">
                @if($user->member?->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->member->foto_profil))
                    <div class="h-11 w-11 rounded-full overflow-hidden ring-1 ring-slate-200 dark:ring-slate-700">
                        <img src="{{ asset('storage/' . $user->member->foto_profil) }}" alt="" class="h-full w-full object-cover">
                    </div>
                @else
                    <div class="h-11 w-11 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center ring-1 ring-slate-200 dark:ring-slate-700">
                        <svg class="h-5 w-5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Deadlines — Metronic list style --}}
    @if(isset($deadlines) && $deadlines->isNotEmpty())
        <div class="rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
            <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2">
                    <div class="h-2 w-2 rounded-full bg-amber-500"></div>
                    <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">Tenggat Waktu Mendatang</span>
                </div>
                <span class="text-xs font-medium text-slate-400 dark:text-slate-500">{{ $deadlines->count() }} item</span>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($deadlines as $item)
                    <div class="flex items-center gap-3.5 px-5 py-3 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/40">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded text-xs font-bold
                            {{ $item['type'] === 'target' ? 'bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400' : 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400' }}">
                            {{ $item['type'] === 'target' ? 'T' : 'P' }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-slate-800 dark:text-slate-200">{{ $item['title'] }}</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                                @if ($item['remaining_days'] !== null && $item['remaining_days'] > 0)
                                    <span class="font-semibold text-amber-600 dark:text-amber-400">{{ $item['remaining_days'] }} hari lagi</span>
                                @elseif ($item['remaining_days'] === 0)
                                    <span class="font-semibold text-red-600 dark:text-red-400">Hari ini!</span>
                                @else
                                    Project aktif
                                @endif
                                @if ($item['user_name'])
                                    <span class="mx-1">&middot;</span>
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
