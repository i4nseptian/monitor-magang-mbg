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

<div class="mb-6">
    <div class="relative overflow-hidden rounded-2xl border border-primary-200/60 bg-gradient-to-br from-primary-800 via-primary-800 to-primary-900 shadow-sm dark:border-primary-800 dark:from-primary-950 dark:to-gray-950">
        <div class="pointer-events-none absolute -right-8 -top-8 h-40 w-40 rounded-full bg-white/5"></div>
        <div class="pointer-events-none absolute -bottom-10 right-24 h-28 w-28 rounded-full bg-sky-400/10"></div>
        <div class="pointer-events-none absolute -left-4 top-1/2 h-16 w-16 rounded-full bg-white/[0.03]"></div>

        <div class="relative flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-md bg-white/15 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-white backdrop-blur-sm">
                        {{ $roleLabel }}
                    </span>
                    @if ($hariKe > 0)
                        <span class="inline-flex items-center rounded-md bg-sky-400/20 px-2.5 py-1 text-[11px] font-medium tabular-nums text-sky-100">
                            Hari ke-{{ $hariKe }}
                        </span>
                    @endif
                </div>
                <h1 class="mt-2 text-xl font-bold text-white sm:text-2xl">
                    {{ $greeting }}, {{ $user->name }}
                </h1>
                <p class="mt-1 text-sm font-medium text-primary-200/90">
                    Diskominfo Makassar · {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="shrink-0 self-center sm:self-auto">
                @if($user->member?->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->member->foto_profil))
                    <img src="{{ asset('storage/' . $user->member->foto_profil) }}"
                         alt="{{ $user->name }}"
                         class="mx-auto h-14 w-14 rounded-full object-cover ring-2 ring-white/30 sm:mx-0">
                @else
                    @php
                        $words = explode(' ', $user->name);
                        $initials = count($words) >= 2
                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                            : strtoupper(substr($user->name, 0, 2));
                    @endphp
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-white/15 text-lg font-bold text-white ring-2 ring-white/20 sm:mx-0">
                        {{ $initials }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
