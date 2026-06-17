<x-filament-panels::layout.base :title="__('filament-panels::pages/auth/login.title')">
    <div class="flex min-h-screen">
        {{-- Left: Brand Panel --}}
        <div class="relative hidden w-1/2 flex-col items-center justify-center bg-gradient-to-br from-indigo-900 via-indigo-800 to-indigo-950 p-12 lg:flex overflow-hidden">
            <div class="absolute inset-0 opacity-[0.04] bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute -top-40 -right-40 h-80 w-80 rounded-full bg-indigo-500/10 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 h-80 w-80 rounded-full bg-cyan-500/10 blur-3xl"></div>

            <div class="relative z-10 text-center max-w-md">
                <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm ring-1 ring-white/20">
                    <img src="{{ asset('images/logo-mark.svg') }}" alt="InternTrack" class="h-10 w-10">
                </div>
                <h1 class="text-3xl font-bold text-white tracking-tight">InternTrack</h1>
                <p class="mt-2 text-indigo-200/80 text-sm font-medium">Sistem Monitoring & Dokumentasi Magang</p>

                <div class="mt-10 space-y-4 text-left">
                    <div class="flex items-start gap-3 rounded-xl bg-white/5 p-4 backdrop-blur-sm ring-1 ring-white/10">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-500/20 text-indigo-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Catat Aktivitas Harian</p>
                            <p class="text-xs text-indigo-200/70 mt-0.5">Logbook kegiatan lengkap dengan dokumentasi foto, kategori tugas, dan indikator mood</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-xl bg-white/5 p-4 backdrop-blur-sm ring-1 ring-white/10">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-cyan-500/20 text-cyan-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 7.125c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v12.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V7.125zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Pantau Perkembangan</p>
                            <p class="text-xs text-indigo-200/70 mt-0.5">Grafik skill, progres target kerja, ringkasan statistik, dan evaluasi mentor berkala</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-xl bg-white/5 p-4 backdrop-blur-sm ring-1 ring-white/10">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-500/20 text-emerald-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Generate Laporan PDF</p>
                            <p class="text-xs text-indigo-200/70 mt-0.5">Cetak laporan harian, mingguan, bulanan, dan laporan akhir magang siap kumpul</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="relative z-10 mt-10 text-xs text-indigo-300/50">Dinas Komunikasi dan Informatika Kota Makassar</p>
        </div>

        {{-- Right: Login Form --}}
        <div class="flex w-full items-center justify-center px-6 py-12 lg:w-1/2 bg-white dark:bg-[#0d121c]">
            <div class="w-full max-w-sm">
                <div class="mb-8 text-center lg:text-left">
                    <div class="mx-auto lg:mx-0 mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 dark:bg-indigo-950/50 ring-1 ring-indigo-100 dark:ring-indigo-900/50 lg:hidden">
                        <img src="{{ asset('images/logo-mark.svg') }}" alt="InternTrack" class="h-8 w-8">
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Masuk</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Silakan masuk menggunakan akun Anda</p>
                </div>

                <x-filament-panels::form id="form" wire:submit="authenticate">
                    {{ $this->form }}

                    <x-filament-panels::form.actions
                        :actions="$this->getCachedFormActions()"
                        :full-width="$this->hasFullWidthFormActions()"
                    />
                </x-filament-panels::form>

                @if (filament()->hasRegistration())
                    <p class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
                        {{ __('filament-panels::pages/auth/login.actions.register.before') }}
                        <a href="{{ filament()->getRegistrationUrl() }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                            {{ $this->registerAction }}
                        </a>
                    </p>
                @endif

                <p class="mt-8 text-center text-xs text-gray-400 dark:text-gray-500">
                    &copy; {{ date('Y') }} InternTrack &middot; Diskominfo Makassar
                </p>
            </div>
        </div>
    </div>
</x-filament-panels::layout.base>