<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InternTrack — Monitoring Magang Diskominfo Makassar</title>
    <link rel="icon" href="{{ asset('images/logo-mark.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f4f8',
                            100: '#d9e2ec',
                            200: '#bcccdc',
                            300: '#9fb3c8',
                            400: '#829ab1',
                            500: '#627d98',
                            600: '#486581',
                            700: '#334e68',
                            800: '#1e3a5f',
                            900: '#102a43',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-color: #f0f4f8;
            background-image:
                radial-gradient(at 80% 20%, rgba(30, 58, 95, 0.06) 0px, transparent 50%),
                radial-gradient(at 20% 80%, rgba(56, 189, 248, 0.08) 0px, transparent 50%);
        }
        .card-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(30, 58, 95, 0.15);
        }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased font-sans">

    {{-- Navbar --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-6">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-mark.svg') }}" alt="InternTrack" class="h-9 w-9">
                <div>
                    <p class="text-base font-bold tracking-tight text-brand-800">InternTrack</p>
                    <p class="text-[10px] font-medium uppercase tracking-widest text-slate-400">Diskominfo Makassar</p>
                </div>
            </a>
            <a href="/admin" class="inline-flex items-center gap-2 rounded-lg bg-brand-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-900">
                Masuk Panel
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </header>

    {{-- Hero --}}
    <section class="hero-pattern border-b border-slate-200/60">
        <div class="mx-auto grid max-w-6xl gap-12 px-6 py-20 lg:grid-cols-2 lg:items-center lg:py-28">
            <div>
                <p class="mb-4 inline-flex items-center gap-2 rounded-full border border-brand-200 bg-white px-3 py-1 text-xs font-semibold text-brand-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-sky-400"></span>
                    Magang Prodi Bisnis Digital · FEB UNM
                </p>
                <h1 class="text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-900 lg:text-5xl">
                    Pantau magang,<br>
                    <span class="text-brand-800">dokumentasi rapi.</span>
                </h1>
                <p class="mt-5 max-w-lg text-base leading-relaxed text-slate-600">
                    Platform internal untuk mahasiswa magang mencatat logbook harian, mengunggah dokumentasi,
                    dan menyiapkan laporan akhir — semua terpusat di satu tempat.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="/admin" class="rounded-lg bg-brand-800 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-900">
                        Buka Dashboard
                    </a>
                    <a href="#mahasiswa" class="rounded-lg border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-brand-300 hover:text-brand-800">
                        Lihat Peserta
                    </a>
                </div>
            </div>

            {{-- Feature list (not generic 4-card grid) --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Yang bisa dilakukan</p>
                <ul class="mt-5 space-y-4">
                    @foreach([
                        ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Logbook Harian', 'desc' => 'Catat kegiatan, jam, kategori, dan mood setiap hari.'],
                        ['icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'title' => 'Dokumentasi Foto', 'desc' => 'Unggah bukti kegiatan langsung dari logbook.'],
                        ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'title' => 'Statistik & Grafik', 'desc' => 'Pantau progres magang lewat dashboard visual.'],
                        ['icon' => 'M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Export Laporan PDF', 'desc' => 'Generate laporan harian hingga laporan akhir magang.'],
                    ] as $feature)
                        <li class="flex gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-brand-50 text-brand-700">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $feature['title'] }}</p>
                                <p class="text-xs text-slate-500">{{ $feature['desc'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Stats strip --}}
    @php
        $mahasiswaList = \App\Models\User::role('mahasiswa')->with('member')->get();
        $totalMahasiswa = $mahasiswaList->count();
    @endphp
    <section class="border-b border-slate-100 bg-brand-800 py-10 text-white">
        <div class="mx-auto grid max-w-6xl grid-cols-2 gap-6 px-6 md:grid-cols-4">
            <div class="text-center md:text-left">
                <p class="text-3xl font-bold">{{ $totalMahasiswa }}</p>
                <p class="mt-1 text-sm text-brand-200">Peserta Magang</p>
            </div>
            <div class="text-center md:text-left">
                <p class="text-3xl font-bold">3</p>
                <p class="mt-1 text-sm text-brand-200">Bulan Periode</p>
            </div>
            <div class="text-center md:text-left">
                <p class="text-3xl font-bold">4</p>
                <p class="mt-1 text-sm text-brand-200">Jenis Laporan</p>
            </div>
            <div class="text-center md:text-left">
                <p class="text-3xl font-bold">1</p>
                <p class="mt-1 text-sm text-brand-200">Platform Terpusat</p>
            </div>
        </div>
    </section>

    {{-- Mahasiswa --}}
    <section id="mahasiswa" class="py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 max-w-xl">
                <p class="text-xs font-bold uppercase tracking-wider text-brand-600">Tim Magang</p>
                <h2 class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $totalMahasiswa }} Mahasiswa Bisnis Digital
                </h2>
                <p class="mt-3 text-slate-600">
                    Program magang di Dinas Komunikasi dan Informatika Kota Makassar.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($mahasiswaList as $mhs)
                    @php
                        $nim = $mhs->member?->nim ?? '-';
                        $divisi = $mhs->member?->divisi ?? 'Magang';
                        $foto = $mhs->member?->foto_profil;
                        $words = explode(' ', $mhs->name);
                        $initials = count($words) >= 2
                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                            : strtoupper(substr($mhs->name, 0, 2));
                    @endphp
                    <article class="card-lift overflow-hidden rounded-xl border border-slate-200 bg-white">
                        <div class="h-1.5 bg-brand-800"></div>
                        <div class="p-6 text-center">
                            @if($foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($foto))
                                <img src="{{ asset('storage/' . $foto) }}" alt="{{ $mhs->name }}" class="mx-auto h-20 w-20 rounded-full object-cover ring-2 ring-brand-100">
                            @else
                                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-brand-800 text-xl font-bold text-white">
                                    {{ $initials }}
                                </div>
                            @endif
                            <h3 class="mt-4 font-bold text-slate-900">{{ $mhs->name }}</h3>
                            <p class="mt-1 text-xs text-slate-400">NIM {{ $nim }}</p>
                            <span class="mt-3 inline-block rounded-md bg-brand-50 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-brand-700">
                                {{ $divisi }}
                            </span>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full py-8 text-center text-slate-500">Belum ada data mahasiswa terdaftar.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 bg-slate-50 py-10">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-6 md:flex-row">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-mark.svg') }}" alt="" class="h-8 w-8 opacity-80">
                <div>
                    <p class="text-sm font-semibold text-slate-800">InternTrack</p>
                    <p class="text-xs text-slate-500">Dinas Komunikasi dan Informatika Kota Makassar</p>
                </div>
            </div>
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} InternTrack. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
