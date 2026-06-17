<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InternTrack — Monitoring Magang Diskominfo Makassar</title>
    <link rel="icon" href="{{ asset('images/logo-mark.svg') }}" type="image/svg+xml">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc',
                            400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca',
                            800: '#3730a3', 900: '#312e81', 950: '#1e1b4b',
                        },
                        gray: {
                            25: '#fcfcfd', 50: '#f9fafb', 100: '#f0f1f3', 200: '#dcdfe4',
                            300: '#b9bec6', 400: '#8a94a6', 500: '#667085', 600: '#4b5565',
                            700: '#364152', 800: '#202939', 900: '#121926', 950: '#0d121c',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0px 1px 2px rgba(16, 24, 40, 0.05)',
                        'card-hover': '0px 4px 6px -2px rgba(16, 24, 40, 0.05), 0px 12px 16px -4px rgba(16, 24, 40, 0.1)',
                        'badge': '0px 1px 2px rgba(16, 24, 40, 0.05)',
                    }
                }
            }
        }
    </script>
    <style>
        body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        .section-fade { opacity: 0; transform: translateY(24px); transition: all 0.7s ease-out; }
        .section-fade.visible { opacity: 1; transform: translateY(0); }
        .stat-number { font-variant-numeric: tabular-nums; }
        .nav-blur { backdrop-filter: blur(12px) saturate(180%); -webkit-backdrop-filter: blur(12px) saturate(180%); }
        .gradient-border { position: relative; }
        .gradient-border::before {
            content: '';
            position: absolute; inset: 0; border-radius: inherit;
            padding: 1px; background: linear-gradient(135deg, #6366f1, #06b6d4);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
        }
        .hover-lift { transition: all 0.2s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0px 4px 6px -2px rgba(16, 24, 40, 0.05), 0px 12px 16px -4px rgba(16, 24, 40, 0.1); }
    </style>
</head>
<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 nav-blur border-b border-gray-100" style="background: rgba(255,255,255,0.8);">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6 lg:px-8">
            <a href="/" class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo-mark.svg') }}" alt="InternTrack" class="h-8 w-8">
                <div class="flex flex-col leading-tight">
                    <span class="text-lg font-bold text-gray-900 tracking-tight">InternTrack</span>
                    <span class="text-[10px] font-medium text-gray-400 tracking-wide">Diskominfo Makassar</span>
                </div>
            </a>
            <div class="flex items-center gap-3">
                <a href="#features" class="hidden sm:inline-flex text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors px-3 py-2">Fitur</a>
                <a href="#mahasiswa-section" class="hidden sm:inline-flex text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors px-3 py-2">Peserta</a>
                <a href="/admin" class="inline-flex items-center gap-1.5 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800 transition-all shadow-sm hover:shadow-md">
                    Masuk Panel
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    @php
        $mahasiswaList = \App\Models\User::role('mahasiswa')->with('member')->get();
        $totalMahasiswa = $mahasiswaList->count();
        $totalLogbooksCount = \App\Models\Logbook::count();
        $totalProjectsCount = \App\Models\Project::count();
    @endphp

    <!-- Hero -->
    <section class="relative pt-24 pb-16 sm:pt-32 sm:pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-brand-50/60 via-white to-cyan-50/30 pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.04] bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:20px_20px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] bg-[linear-gradient(to_right,#f0f1f3_1px,transparent_1px),linear-gradient(to_bottom,#f0f1f3_1px,transparent_1px)] [background-size:60px_60px] pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-brand-50/40 to-transparent pointer-events-none"></div>
        <div class="absolute -top-40 -right-32 w-96 h-96 rounded-full bg-brand-300/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-cyan-300/15 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/4 w-64 h-64 rounded-full bg-violet-300/10 blur-3xl pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 relative">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full bg-brand-50 border border-brand-100 px-4 py-1.5 mb-6">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>
                    <span class="text-sm font-medium text-brand-700">Magang Bisnis Digital · FEB UNM</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 leading-[1.08]">
                    Pantau magang,<br>
                    <span class="text-brand-600">dokumentasi rapi.</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-gray-500 leading-relaxed max-w-2xl mx-auto">
                    Sistem monitoring internal Dinas Komunikasi dan Informatika Makassar. 
                    Membantu peserta mencatat logbook harian, mengunggah dokumentasi, 
                    melacak progres target, dan menyusun laporan akhir magang secara terintegrasi.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="/admin" class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-6 py-3 text-sm font-semibold text-white hover:bg-gray-800 transition-all shadow-sm hover:shadow-md w-full sm:w-auto justify-center">
                        Buka Dashboard
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                    <a href="#features" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 hover:border-gray-300 hover:text-gray-900 transition-all w-full sm:w-auto justify-center">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="border-y border-gray-100 bg-gray-25/50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-gray-900 stat-number">{{ $totalMahasiswa }}</p>
                    <p class="mt-1.5 text-sm font-medium text-gray-500">Peserta Magang</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-gray-900 stat-number">{{ $totalLogbooksCount }}</p>
                    <p class="mt-1.5 text-sm font-medium text-gray-500">Kegiatan Dicatat</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-gray-900 stat-number">{{ $totalProjectsCount }}</p>
                    <p class="mt-1.5 text-sm font-medium text-gray-500">Project Showcase</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-bold text-gray-900 stat-number">1</p>
                    <p class="mt-1.5 text-sm font-medium text-gray-500">Platform Terpusat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="relative py-20 sm:py-28 section-fade overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-indigo-25/40 to-white pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.025] bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.015] bg-[linear-gradient(to_right,#eef2ff_1px,transparent_1px),linear-gradient(to_bottom,#eef2ff_1px,transparent_1px)] [background-size:80px_80px] pointer-events-none"></div>
        <div class="absolute -top-20 left-0 w-72 h-72 rounded-full bg-brand-200/25 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/3 -right-32 w-96 h-96 rounded-full bg-cyan-200/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 right-1/4 w-64 h-64 rounded-full bg-violet-200/20 blur-3xl pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 relative">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-semibold text-brand-600 tracking-wide uppercase">Fitur Unggulan</span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">Semua yang Anda Butuhkan untuk Monitoring Magang</h2>
                <p class="mt-4 text-lg text-gray-500">Platform all-in-one yang dirancang khusus untuk administrasi dan monitoring mahasiswa magang di lingkungan pemerintahan.</p>
            </div>
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="rounded-xl border border-gray-100 bg-white p-6 hover-lift">
                    <div class="h-10 w-10 rounded-lg bg-brand-50 flex items-center justify-center">
                        <svg class="h-5 w-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.232.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Logbook Harian</h3>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Catat detail kegiatan harian dengan kategori tugas, jam kerja, dan indikator mood. Dilengkapi fitur unggah foto dokumentasi langsung dari form logbook.</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white p-6 hover-lift">
                    <div class="h-10 w-10 rounded-lg bg-brand-50 flex items-center justify-center">
                        <svg class="h-5 w-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Dokumentasi Foto</h3>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Unggah bukti autentik pelaksanaan tugas lapangan langsung dari dalam sistem. Setiap foto terorganisir berdasarkan tanggal dan kegiatan.</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white p-6 hover-lift">
                    <div class="h-10 w-10 rounded-lg bg-brand-50 flex items-center justify-center">
                        <svg class="h-5 w-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Evaluasi & Progress</h3>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Mentor dapat memberikan review, komentar bimbingan, dan evaluasi berkala. Fitur skill development memonitor perkembangan hardskill/softskill.</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white p-6 hover-lift">
                    <div class="h-10 w-10 rounded-lg bg-brand-50 flex items-center justify-center">
                        <svg class="h-5 w-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-gray-900">Export Laporan PDF</h3>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Otomatisasi cetak berkas laporan magang harian, mingguan, bulanan, hingga laporan akhir lengkap dengan cover resmi dan grafik performa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="relative py-20 sm:py-28 bg-gray-25/80 border-y border-gray-100 section-fade overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,#eef2ff,transparent_70%)] pointer-events-none opacity-70"></div>
        <div class="absolute inset-0 opacity-[0.025] bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:22px_22px] pointer-events-none"></div>
        <div class="absolute -top-20 right-1/3 w-80 h-80 rounded-full bg-brand-300/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 left-1/4 w-72 h-72 rounded-full bg-cyan-300/15 blur-3xl pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 relative">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-semibold text-brand-600 tracking-wide uppercase">Alur Kerja</span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">Bagaimana InternTrack Bekerja</h2>
                <p class="mt-4 text-lg text-gray-500">Proses sederhana dari pencatatan hingga pelaporan akhir magang.</p>
            </div>
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center">
                    <div class="mx-auto h-14 w-14 rounded-full bg-brand-50 flex items-center justify-center border border-brand-100">
                        <span class="text-xl font-bold text-brand-600">1</span>
                    </div>
                    <h3 class="mt-5 font-semibold text-gray-900">Catat Kegiatan Harian</h3>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Peserta mencatat logbook harian lengkap dengan jam kerja, kategori tugas, deskripsi kegiatan, dan dokumentasi foto pendukung.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto h-14 w-14 rounded-full bg-brand-50 flex items-center justify-center border border-brand-100">
                        <span class="text-xl font-bold text-brand-600">2</span>
                    </div>
                    <h3 class="mt-5 font-semibold text-gray-900">Monitoring & Evaluasi</h3>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Mentor memantau perkembangan peserta secara real-time, memberikan catatan evaluasi, dan melacak progres target kerja.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto h-14 w-14 rounded-full bg-brand-50 flex items-center justify-center border border-brand-100">
                        <span class="text-xl font-bold text-brand-600">3</span>
                    </div>
                    <h3 class="mt-5 font-semibold text-gray-900">Hasilkan Laporan Akhir</h3>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">Sistem otomatis menyusun laporan akhir magang lengkap dengan cover, timeline, rekap kegiatan, grafik, dan evaluasi mentor.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mahasiswa Directory -->
    <section id="mahasiswa-section" class="relative py-20 sm:py-28 section-fade overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-indigo-25/30 to-white pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:28px_28px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.015] bg-[linear-gradient(to_right,#eef2ff_1px,transparent_1px),linear-gradient(to_bottom,#eef2ff_1px,transparent_1px)] [background-size:100px_100px] pointer-events-none"></div>
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-brand-200/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-cyan-200/20 blur-3xl pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 relative">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
                <div class="max-w-xl">
                    <span class="text-sm font-semibold text-brand-600 tracking-wide uppercase">Direktori Magang</span>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">Mahasiswa Universitas Negeri Makassar</h2>
                    <p class="mt-3 text-gray-500 leading-relaxed">Daftar lengkap peserta program magang dari FEB UNM yang sedang melaksanakan praktik kerja lapangan di Dinas Komunikasi & Informatika Kota Makassar.</p>
                </div>
                <div class="w-full md:max-w-sm">
                    <div class="relative">
                        <input type="text" id="search-input" placeholder="Cari nama mahasiswa..." class="w-full rounded-lg border border-gray-200 bg-white pl-10 pr-4 py-2.5 text-sm placeholder-gray-400 focus:border-brand-300 focus:outline-none focus:ring-2 focus:ring-brand-500/10 transition shadow-sm">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $divisions = $mahasiswaList->map(fn($m) => $m->member?->divisi)->filter()->unique()->values();
            @endphp
            <div class="flex flex-wrap gap-2 mb-8">
                <button onclick="filterDivisi('all')" class="divisi-pill active rounded-lg bg-gray-900 text-white px-4 py-1.5 text-sm font-medium shadow-sm hover:bg-gray-800 transition-all">
                    Semua
                </button>
                @foreach($divisions as $div)
                    <button onclick="filterDivisi('{{ $div }}')" class="divisi-pill rounded-lg border border-gray-200 bg-white text-gray-600 px-4 py-1.5 text-sm font-medium hover:border-gray-300 hover:text-gray-900 transition-all">
                        {{ $div }}
                    </button>
                @endforeach
            </div>

            <div id="mahasiswa-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
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
                    <article class="mahasiswa-card group rounded-xl border border-gray-100 bg-white p-6 transition-all hover:border-gray-200 hover:shadow-card-hover"
                             data-name="{{ strtolower($mhs->name) }}"
                             data-division="{{ $divisi }}">
                        <div class="text-center">
                            <div class="relative mx-auto mb-4 h-16 w-16">
                                @if($foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($foto))
                                    <img src="{{ asset('storage/' . $foto) }}" alt="{{ $mhs->name }}" class="h-16 w-16 rounded-full object-cover ring-2 ring-gray-50">
                                @else
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-50 text-lg font-bold text-brand-600 ring-2 ring-gray-50">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <span class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                            </div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-brand-600 transition-colors">{{ $mhs->name }}</h3>
                            <p class="text-sm text-gray-400 mt-0.5">NIM {{ $nim }}</p>
                            <div class="mt-4">
                                <span class="inline-flex items-center rounded-lg bg-brand-50 px-3 py-1 text-xs font-medium text-brand-700">
                                    {{ $divisi }}
                                </span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-16 text-center border border-gray-100 rounded-xl bg-white">
                        <div class="h-12 w-12 mx-auto mb-4 rounded-full bg-gray-50 flex items-center justify-center">
                            <svg class="h-6 w-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada data mahasiswa terdaftar.</p>
                    </div>
                @endforelse
            </div>

            <div id="no-results" class="hidden py-16 text-center border border-gray-100 rounded-xl bg-white">
                <p class="text-gray-500 font-medium">Tidak ada mahasiswa yang cocok dengan pencarian Anda.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 sm:py-28 bg-gray-900 section-fade overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.02] bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] [background-size:80px_80px] pointer-events-none"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8 relative text-center">
            <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white">Siap Memulai Monitoring Magang?</h2>
            <p class="mt-4 text-lg text-gray-300 max-w-2xl mx-auto">Akses panel dashboard untuk mulai mencatat kegiatan, memonitor progres, dan menyusun laporan magang secara terstruktur.</p>
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/admin" class="inline-flex items-center gap-2 rounded-lg bg-white px-6 py-3 text-sm font-semibold text-gray-900 hover:bg-gray-50 transition-all shadow-sm w-full sm:w-auto justify-center">
                    Buka Dashboard
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
                <a href="#features" class="inline-flex items-center gap-2 rounded-lg border border-gray-600 px-6 py-3 text-sm font-semibold text-gray-200 hover:border-gray-500 transition-all w-full sm:w-auto justify-center">
                    Lihat Fitur
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-100 bg-white py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-mark.svg') }}" alt="InternTrack" class="h-8 w-8">
                <div>
                    <p class="text-sm font-semibold text-gray-900">InternTrack</p>
                    <p class="text-xs text-gray-400">Dinas Komunikasi dan Informatika Kota Makassar</p>
                </div>
            </div>
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} InternTrack FEB UNM. All rights reserved.</p>
        </div>
    </footer>

    <script>
        let currentDivision = 'all';
        const searchInput = document.getElementById('search-input');
        const cards = document.querySelectorAll('.mahasiswa-card');
        const noResults = document.getElementById('no-results');
        const grid = document.getElementById('mahasiswa-grid');

        if (searchInput) searchInput.addEventListener('input', runFilter);

        function filterDivisi(div) {
            currentDivision = div;
            const pills = document.querySelectorAll('.divisi-pill');
            pills.forEach(pill => {
                const text = pill.textContent.trim();
                const isActive = (div === 'all' && text === 'Semua') || (text === div);
                if (isActive) {
                    pill.classList.add('bg-gray-900', 'text-white', 'shadow-sm');
                    pill.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                } else {
                    pill.classList.remove('bg-gray-900', 'text-white', 'shadow-sm');
                    pill.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                }
            });
            runFilter();
        }

        function runFilter() {
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            let matches = 0;
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const division = card.getAttribute('data-division');
                if (name.includes(query) && (currentDivision === 'all' || division === currentDivision)) {
                    card.style.display = '';
                    matches++;
                } else {
                    card.style.display = 'none';
                }
            });
            if (matches === 0) { noResults.classList.remove('hidden'); grid.classList.add('hidden'); }
            else { noResults.classList.add('hidden'); grid.classList.remove('hidden'); }
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Intersection Observer for fade-in sections
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));
    </script>

</body>
</html>