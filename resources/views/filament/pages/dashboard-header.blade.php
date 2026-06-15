<div class="mb-6">
    <div class="bg-gradient-to-r {{ $roleColor }} rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div class="text-white">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-sm font-medium bg-white/20 px-3 py-0.5 rounded-full">
                        {{ $roleLabel }}
                    </span>
                    @if ($hariKe > 0)
                        <span class="text-sm font-medium bg-white/20 px-3 py-0.5 rounded-full">
                            Hari ke-{{ $hariKe }}
                        </span>
                    @endif
                </div>
                <h1 class="text-2xl font-bold mt-2">Selamat Datang, {{ $user->name }}!</h1>
                <p class="text-white/80 text-sm mt-1">
                    Sistem Monitoring Magang Dinas Komunikasi dan Informatika Kota Makassar
                </p>
            </div>
            <div class="hidden sm:block">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>