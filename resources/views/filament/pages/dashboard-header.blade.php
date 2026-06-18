@php
    $hour = now()->hour;
    if ($hour < 10) { $greeting = 'Selamat Pagi'; }
    elseif ($hour < 15) { $greeting = 'Selamat Siang'; }
    elseif ($hour < 18) { $greeting = 'Selamat Sore'; }
    else { $greeting = 'Selamat Malam'; }
@endphp

<div class="mb-6 space-y-4">

    {{-- Greeting Card — Metronic clean style --}}
    <div class="rounded-xl border border-[oklch(94%_0.004_286.32)] dark:border-[oklch(22%_0.01_260)] bg-white dark:bg-[#161920] p-6 shadow-[0_1px_2px_rgb(0_0_0/0.05)]">
        <div class="flex items-center justify-between gap-5">
            <div class="min-w-0 flex-1 space-y-2">
                <h1 class="text-xl font-bold text-slate-900 dark:text-white leading-snug">
                    {{ $greeting }}, {{ $user->name }}
                </h1>
                <p class="text-sm text-slate-400 dark:text-slate-500">
                    Diskominfo Makassar &middot; {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="shrink-0">
                @if($user->member?->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->member->foto_profil))
                    <div class="h-11 w-11 rounded-full overflow-hidden ring-1 ring-slate-200 dark:ring-slate-700">
                        <img src="{{ asset('storage/' . $user->member->foto_profil) }}" alt="" class="h-full w-full object-cover">
                    </div>
                @else
                    <div class="h-11 w-11 rounded-full bg-indigo-100 dark:bg-indigo-900/60 flex items-center justify-center ring-1 ring-indigo-200 dark:ring-indigo-700">
                        <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm-7 9a7 7 0 0 1 14 0H5Z"/>
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
