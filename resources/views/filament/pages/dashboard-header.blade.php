@php
    $hour = now()->hour;
    if ($hour < 10) {
        $greeting = 'Selamat Pagi';
    } elseif ($hour < 15) {
        $greeting = 'Selamat Siang';
    } elseif ($hour < 18) {
        $greeting = 'Selamat Sore';
    } else {
        $greeting = 'Selamat Malam';
    }
@endphp

<div class="mb-6 space-y-4">
    <div class="relative overflow-hidden rounded-2xl border border-primary-200/60 bg-gradient-to-br from-primary-800 via-primary-800 to-primary-900 shadow-sm before:animate-pulse before:absolute before:inset-0 before:bg-gradient-to-r before:from-transparent before:via-white/5 before:to-transparent before:-translate-x-full hover:before:translate-x-full before:transition-all before:duration-1000 dark:border-primary-800/60 dark:from-primary-950 dark:to-gray-950">
        <div class="pointer-events-none absolute -right-8 -top-8 h-40 w-40 rounded-full bg-white/5"></div>
        <div class="pointer-events-none absolute -bottom-10 right-24 h-28 w-28 rounded-full bg-sky-400/10 dark:bg-sky-400/5"></div>
        <div class="pointer-events-none absolute -left-4 top-1/2 h-16 w-16 rounded-full bg-white/[0.03] dark:bg-white/[0.02]"></div>

        <div class="relative z-10 flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-md bg-white/15 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-white backdrop-blur-sm shadow-sm dark:bg-white/10">
                        {{ $roleLabel }}
                    </span>
                    @if ($hariKe > 0)
                        <span class="inline-flex items-center rounded-md bg-sky-400/20 px-2.5 py-1 text-[11px] font-medium tabular-nums text-sky-100 ring-1 ring-sky-400/20 dark:bg-sky-700/40 dark:text-sky-200 dark:ring-sky-600/40">
                            Hari ke-{{ $hariKe }}
                        </span>
                    @endif
                    @if (isset($hariTersisa) && $hariTersisa > 0)
                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-400/20 px-2.5 py-1 text-[11px] font-medium tabular-nums text-amber-100 ring-1 ring-amber-400/20 dark:bg-amber-700/40 dark:text-amber-200 dark:ring-amber-600/40">
                            <svg class="h-3 w-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Sisa {{ $hariTersisa }} hari
                        </span>
                    @endif
                </div>
                <h1 class="mt-2 text-xl font-bold text-white sm:text-2xl">
                    {{ $greeting }}, {{ $user->name }}
                </h1>
                <p class="mt-1 text-sm font-medium text-primary-200/90 dark:text-primary-300/80">
                    Diskominfo Makassar · {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="shrink-0 self-center sm:self-auto">
                @if($user->member?->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->member->foto_profil))
                    <img src="{{ asset('storage/' . $user->member->foto_profil) }}"
                         alt="{{ $user->name }}"
                         class="mx-auto h-14 w-14 rounded-full object-cover ring-2 ring-white/30 shadow-lg transition-transform duration-300 hover:scale-105 sm:mx-0">
                @else
                    @php
                        $words = explode(' ', $user->name);
                        $initials = count($words) >= 2
                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                            : strtoupper(substr($user->name, 0, 2));
                    @endphp
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-white/15 text-lg font-bold text-white ring-2 ring-white/20 shadow-lg transition-transform duration-300 hover:scale-105 sm:mx-0">
                        {{ $initials }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Upcoming Deadlines --}}
    @if(isset($deadlines) && $deadlines->isNotEmpty())
        <div class="rounded-xl border border-amber-200/60 bg-gradient-to-br from-amber-50/80 to-white p-4 shadow-sm transition-all duration-300 hover:shadow-md dark:border-amber-900/40 dark:from-amber-950/20 dark:to-gray-900/20">
            <div class="mb-3 flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-bell-alert" class="h-4 w-4 text-amber-600 dark:text-amber-400" />
                <span class="text-xs font-semibold uppercase tracking-wider text-amber-700 dark:text-amber-400">Tenggat Mendatang</span>
            </div>
            <div class="flex flex-wrap gap-2">
                @foreach ($deadlines as $item)
                    <div class="flex items-center gap-2 rounded-lg border border-amber-200/60 bg-white/70 px-3 py-2 text-xs shadow-sm transition-all duration-200 hover:shadow-md hover:scale-[1.02] dark:border-amber-800/50 dark:bg-gray-800/60">
                        @if ($item['type'] === 'target')
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-amber-100 text-[10px] text-amber-700 ring-1 ring-amber-200 dark:bg-amber-900/40 dark:text-amber-300 dark:ring-amber-800">T</span>
                        @else
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-sky-100 text-[10px] text-sky-700 ring-1 ring-sky-200 dark:bg-sky-900/40 dark:text-sky-300 dark:ring-sky-800">P</span>
                        @endif
                        <div class="min-w-0">
                            <p class="truncate font-medium text-gray-800 dark:text-gray-200 max-w-[140px]">{{ $item['title'] }}</p>
                            <p class="text-[10px] text-gray-400 dark:text-gray-500">
                                @if ($item['remaining_days'] !== null && $item['remaining_days'] > 0)
                                    {{ $item['remaining_days'] }} hari lagi
                                @elseif ($item['remaining_days'] === 0)
                                    Hari ini!
                                @endif
                                @if ($item['user_name'])
                                    · {{ $item['user_name'] }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>