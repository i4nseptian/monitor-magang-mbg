<div class="mb-6">
    <div class="relative overflow-hidden rounded-2xl border border-primary-200/60 bg-gradient-to-br from-primary-800 via-primary-800 to-primary-900 p-6 shadow-sm dark:border-primary-800 dark:from-primary-950 dark:to-gray-950">
        {{-- Decorative circles --}}
        <div class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/5"></div>
        <div class="pointer-events-none absolute -bottom-6 right-20 h-20 w-20 rounded-full bg-sky-400/10"></div>

        <div class="relative flex items-center justify-between gap-4">
            <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-md bg-white/15 px-2.5 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                        {{ $roleLabel }}
                    </span>
                    @if ($hariKe > 0)
                        <span class="inline-flex items-center rounded-md bg-sky-400/20 px-2.5 py-1 text-xs font-medium text-sky-100">
                            Hari ke-{{ $hariKe }}
                        </span>
                    @endif
                </div>
                <h1 class="mt-3 truncate text-xl font-bold text-white sm:text-2xl">
                    Halo, {{ $user->name }}
                </h1>
                <p class="mt-1 text-sm text-primary-200">
                    Diskominfo Makassar · {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>

            <div class="hidden shrink-0 sm:block">
                @if($user->member?->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->member->foto_profil))
                    <img src="{{ asset('storage/' . $user->member->foto_profil) }}"
                         alt="{{ $user->name }}"
                         class="h-14 w-14 rounded-full object-cover ring-2 ring-white/30">
                @else
                    @php
                        $words = explode(' ', $user->name);
                        $initials = count($words) >= 2
                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                            : strtoupper(substr($user->name, 0, 2));
                    @endphp
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/15 text-lg font-bold text-white ring-2 ring-white/20">
                        {{ $initials }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
