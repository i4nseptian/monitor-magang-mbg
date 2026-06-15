<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InternTrack - Monitoring Magang Diskominfo Makassar</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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
                            800: '#1e3a5f', // Warna utama biru tua
                            900: '#102a43',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 w-full glassmorphism border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="p-2 bg-brand-800 text-white rounded-xl shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </span>
                <span class="text-xl font-bold tracking-tight text-brand-800">InternTrack</span>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="/admin" class="px-5 py-2.5 bg-brand-800 hover:bg-brand-900 text-white text-sm font-semibold rounded-xl transition duration-200 shadow-lg shadow-brand-800/20 flex items-center gap-1.5">
                    <span>Masuk ke Panel</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative overflow-hidden pt-20 pb-28 bg-gradient-to-b from-brand-50 to-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-brand-100 text-brand-800 rounded-full text-xs font-semibold tracking-wide">
                    📌 Dinas Komunikasi dan Informatika Kota Makassar
                </span>
                <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Sistem Monitoring & <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-800 to-indigo-600">Dokumentasi Magang</span>
                </h1>
                <p class="text-lg text-slate-600 max-w-2xl leading-relaxed">
                    InternTrack membantu memantau kegiatan harian, pencatatan logbook secara real-time, 
                    dokumentasi foto, serta memfasilitasi penyusunan laporan akhir bagi mahasiswa magang 
                    Program Studi Bisnis Digital FEB Universitas Negeri Makassar.
                </p>
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="/admin" class="px-6 py-3 bg-brand-800 hover:bg-brand-900 text-white font-semibold rounded-xl shadow-xl shadow-brand-800/30 transition duration-200">
                        Mulai Sekarang
                    </a>
                    <a href="#mahasiswa" class="px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 font-semibold border border-slate-200 rounded-xl transition duration-200">
                        Lihat Anggota
                    </a>
                </div>
            </div>

            {{-- Stat Cards / Ilustrasi --}}
            <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-md flex flex-col justify-between h-40 transform hover:-translate-y-1 transition duration-200">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">📝</div>
                    <div>
                        <h4 class="text-2xl font-bold text-slate-900">Real-Time</h4>
                        <p class="text-xs text-slate-500 mt-1">Pengisian Logbook Harian</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-md flex flex-col justify-between h-40 transform hover:-translate-y-1 transition duration-200">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-lg">📸</div>
                    <div>
                        <h4 class="text-2xl font-bold text-slate-900">Dokumentasi</h4>
                        <p class="text-xs text-slate-500 mt-1">Upload Foto Kegiatan</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-md flex flex-col justify-between h-40 transform hover:-translate-y-1 transition duration-200">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg">📊</div>
                    <div>
                        <h4 class="text-2xl font-bold text-slate-900">Dashboard</h4>
                        <p class="text-xs text-slate-500 mt-1">Statistik & Chart Visual</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-md flex flex-col justify-between h-40 transform hover:-translate-y-1 transition duration-200">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center font-bold text-lg">📄</div>
                    <div>
                        <h4 class="text-2xl font-bold text-slate-900">Auto PDF</h4>
                        <p class="text-xs text-slate-500 mt-1">Export Laporan Akhir</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Section Anggota Mahasiswa --}}
    <section id="mahasiswa" class="py-24 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center space-y-4 mb-16">
                <span class="text-xs font-bold text-brand-800 tracking-wider uppercase">Anggota Tim Magang</span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900">4 Mahasiswa Bisnis Digital FEB UNM</h2>
                <p class="text-slate-600 max-w-xl mx-auto">
                    Melaksanakan program magang selama 3 bulan di Dinas Komunikasi dan Informatika Kota Makassar.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $mahasiswaList = \App\Models\User::role('mahasiswa')->with('member')->get();
                @endphp
                @forelse($mahasiswaList as $mhs)
                    @php
                        $nim = $mhs->member?->nim ?? '-';
                        $divisi = $mhs->member?->divisi ?? 'Magang';
                        $foto = $mhs->member?->foto_profil;
                        
                        // Generate initials
                        $words = explode(' ', $mhs->name);
                        $initials = '';
                        if (count($words) >= 2) {
                            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                        } else {
                            $initials = strtoupper(substr($mhs->name, 0, 2));
                        }
                    @endphp
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center space-y-4 hover:shadow-lg transition duration-200">
                        @if($foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($foto))
                            <img src="{{ asset('storage/' . $foto) }}" alt="{{ $mhs->name }}" class="w-20 h-20 rounded-full object-cover mx-auto shadow-md">
                        @else
                            <div class="w-20 h-20 bg-brand-800 text-white rounded-full flex items-center justify-center font-extrabold text-2xl mx-auto shadow-md">
                                {{ $initials }}
                            </div>
                        @endif
                        <div>
                            <h4 class="font-bold text-lg text-slate-900">{{ $mhs->name }}</h4>
                            <p class="text-xs text-slate-400 mt-1">NIM: {{ $nim }}</p>
                            <span class="inline-block mt-3 px-3 py-1 bg-brand-100 text-brand-800 text-[10px] font-bold rounded-full uppercase tracking-wider">
                                {{ $divisi }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-slate-500 py-6">
                        Belum ada data mahasiswa yang terdaftar.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-400 py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <p class="font-bold text-white text-lg">InternTrack</p>
                <p class="text-xs mt-1">Sistem Informasi Monitoring Magang Dinas Kominfo Makassar</p>
            </div>
            <p class="text-xs">&copy; {{ date('Y') }} InternTrack. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>

</body>
</html>
