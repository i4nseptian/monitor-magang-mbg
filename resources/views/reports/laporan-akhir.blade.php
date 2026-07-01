@include('reports.partials.header')
<style>
    h1 { font-size: 16px; color: #1e3a5f; margin-bottom: 5px; }
    h2 { font-size: 13px; color: #1e3a5f; border-bottom: 2px solid #1e3a5f; padding-bottom: 4px; margin: 16px 0 8px; }
    h3 { font-size: 11px; color: #334155; margin: 10px 0 5px; }
    p { font-size: 10px; line-height: 1.7; color: #334155; margin-bottom: 6px; }
    .cover { text-align: center; margin: 60px 0; }
    .cover h1 { font-size: 20px; margin-bottom: 16px; }
    .cover .subtitle { font-size: 12px; color: #475569; margin-bottom: 8px; }
    .info-box { border: 1px solid #cbd5e1; border-radius: 4px; padding: 12px 16px; margin: 20px 0; }
    .info-row { display: flex; margin-bottom: 4px; }
    .info-label { width: 160px; font-size: 10px; color: #64748b; font-weight: bold; }
    .info-value { font-size: 10px; }
    .photo-grid { display: flex; flex-wrap: wrap; gap: 8px; margin: 12px 0; }
    .photo-item { width: 120px; text-align: center; }
    .photo-item img { width: 120px; height: 90px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0; }
    .photo-item .caption { font-size: 7px; color: #64748b; margin-top: 3px; }
    .section-box { border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px; margin: 10px 0; }
    ul.daftar { margin-left: 20px; font-size: 10px; line-height: 1.8; }
</style>
<body>

{{-- ═══════════════════════════════════════ --}}
{{-- COVER --}}
{{-- ═══════════════════════════════════════ --}}
<div class="cover">
    <div style="margin-bottom:30px;">
        <div style="font-size:13px; color:#64748b; margin-bottom:4px; text-transform:uppercase; letter-spacing:3px;">
            Dinas Komunikasi dan Informatika Kota Makassar
        </div>
        <div style="font-size:20px; font-weight:bold; color:#1e3a5f; text-transform:uppercase; letter-spacing:2px; margin:20px 0 8px;">
            LAPORAN AKHIR MAGANG
        </div>
        <div style="font-size:11px; color:#475569; margin-top:6px;">
            Program Magang Mahasiswa<br>
            Program Studi Bisnis Digital – FEB Universitas Negeri Makassar
        </div>
    </div>
    <div style="width:80px; height:4px; background:#1e3a5f; margin: 0 auto 30px; border-radius:2px;"></div>
    <div class="info-box" style="text-align:left; max-width:420px; margin: 0 auto;">
        <div class="info-row"><div class="info-label">Instansi</div><div class="info-value">: Dinas Komunikasi dan Informatika Kota Makassar</div></div>
        <div class="info-row"><div class="info-label">Periode</div><div class="info-value">: {{ $tglMulai->translatedFormat('d F Y') }} – {{ $tglSelesai->translatedFormat('d F Y') }}</div></div>
        <div class="info-row"><div class="info-label">Total Hari</div><div class="info-value">: {{ $totalHari }} Hari Kerja</div></div>
        <div class="info-row"><div class="info-label">Program Studi</div><div class="info-value">: Bisnis Digital</div></div>
        <div class="info-row"><div class="info-label">Jumlah Mahasiswa</div><div class="info-value">: {{ $members->count() }} Orang</div></div>
    </div>
    <div style="margin-top:30px; font-size:9px; color:#94a3b8;">
        Laporan ini digenerate otomatis oleh InternTrack pada {{ now()->translatedFormat('d F Y') }}
    </div>
</div>

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── PROFIL INSTANSI ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>PROFIL INSTANSI</h2>
<h3>A. Gambaran Umum</h3>
<p>
    Dinas Komunikasi dan Informatika (Diskominfo) Kota Makassar adalah Satuan Kerja Perangkat Daerah (SKPD)
    yang bertugas melaksanakan urusan pemerintahan di bidang komunikasi dan informatika. Diskominfo Makassar
    memiliki peran strategis dalam mendukung transformasi digital pemerintah kota melalui pengelolaan
    website resmi, media sosial instansi, dan sistem informasi pemerintahan.
</p>

<h3>B. Visi dan Misi</h3>
<p>
    <strong>Visi:</strong> Mewujudkan Makassar sebagai Kota Cerdas Berbasis Teknologi Informasi dan Komunikasi yang
    Transparan, Akuntabel, dan Inovatif.<br><br>
    <strong>Misi:</strong>
</p>
<ul class="daftar">
    <li>Menyelenggarakan komunikasi publik yang efektif dan transparan.</li>
    <li>Mengembangkan infrastruktur teknologi informasi yang handal dan merata.</li>
    <li>Meningkatkan literasi digital masyarakat Kota Makassar.</li>
    <li>Mendukung tata kelola pemerintahan berbasis elektronik (SPBE).</li>
</ul>

<h3>C. Struktur Penempatan Mahasiswa</h3>
<table>
    <thead>
        <tr><th>No</th><th>Nama Mahasiswa</th><th>NIM</th><th>Program Studi</th><th>Divisi Penempatan</th></tr>
    </thead>
    <tbody>
        @foreach($members as $i => $member)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->member?->nim ?? '-' }}</td>
            <td>{{ $member->member?->program_studi ?? '-' }}</td>
            <td>{{ $member->member?->divisi ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── TIMELINE KEGIATAN ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>TIMELINE KEGIATAN MAGANG</h2>
<p>
    Program magang dilaksanakan selama <strong>{{ $totalHari }} hari kerja</strong>, dimulai dari
    {{ $tglMulai->translatedFormat('d F Y') }} hingga {{ $tglSelesai->translatedFormat('d F Y') }}.
    Berikut adalah timeline kegiatan berdasarkan minggu:
</p>

<table>
    <thead>
        <tr><th>Minggu</th><th>Periode</th><th>Jumlah Kegiatan</th><th>Kegiatan Utama</th></tr>
    </thead>
    <tbody>
        @forelse($weeklyRekap as $week => $data)
        <tr>
            <td style="text-align:center">Minggu {{ $week }}</td>
            <td>{{ $data['kegiatan']->first()->tanggal->format('d/m') }} - {{ $data['kegiatan']->last()->tanggal->format('d/m/Y') }}</td>
            <td style="text-align:center">{{ $data['total_kegiatan'] }}</td>
            <td>{{ $data['kegiatan']->take(3)->pluck('judul_kegiatan')->implode(', ') }}</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center; color:#94a3b8;">Belum ada data kegiatan</td></tr>
        @endforelse
    </tbody>
</table>

@if($persentase > 0)
<h3>Progress Magang</h3>
<table>
    <tr>
        <td style="width:80%;">
            <div style="background:#e2e8f0; border-radius:8px; height:18px; overflow:hidden;">
                <div style="background: #1e3a5f; height:100%; width:{{ $persentase }}%; border-radius:8px;"></div>
            </div>
        </td>
        <td style="width:20%; text-align:center; font-weight:bold;">{{ $persentase }}%</td>
    </tr>
</table>
@endif

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── REKAP LOGBOOK MINGGUAN ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>REKAP LOGBOOK MINGGUAN</h2>

@forelse($weeklyRekap as $week => $data)
<div class="section-box">
    <h3 style="margin-top:0;">Minggu Ke-{{ $week }}</h3>
    <p style="font-size:9px; color:#64748b;">
        Total: {{ $data['total_kegiatan'] }} kegiatan
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Judul Kegiatan</th>
                <th>Kategori</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['kegiatan'] as $j => $log)
            <tr>
                <td>{{ $j + 1 }}</td>
                <td>{{ $log->tanggal->format('d/m') }}</td>
                <td style="text-align:center">H-{{ $log->hari_ke }}</td>
                <td>{{ $log->judul_kegiatan }}</td>
                <td>{{ $log->kategori_kegiatan }}</td>
                <td>{{ $log->jam_mulai->format('H:i') }} - {{ $log->jam_selesai->format('H:i') }}</td>
                <td><span class="badge badge-{{ $log->status === 'Disetujui Mentor' ? 'success' : ($log->status === 'Draft' ? 'warning' : ($log->status === 'Revisi' ? 'danger' : 'primary')) }}">{{ $log->status }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@empty
<p style="text-align:center; color:#94a3b8; padding:20px;">Belum ada data logbook untuk ditampilkan.</p>
@endforelse

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── DOKUMENTASI FOTO ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>DOKUMENTASI FOTO KEGIATAN</h2>
<p>Dokumentasi kegiatan magang selama periode {{ $startDate->format('d/m/Y') }} – {{ $endDate->format('d/m/Y') }}:</p>

@forelse($documentations as $doc)
<div class="section-box">
    <h3 style="margin-top:0;">{{ $doc->judul }}</h3>
    <p style="font-size:9px; color:#64748b;">{{ $doc->tanggal->format('d M Y') }} | {{ $doc->user->name }}</p>
    @if($doc->keterangan)
        <p style="font-size:9px; margin-bottom: 8px;">{{ $doc->keterangan }}</p>
    @endif
    @if($doc->photos->count() > 0)
    <div class="photo-grid">
        @foreach($doc->photos as $photo)
        <div class="photo-item">
            <img src="{{ public_path('storage/' . $photo->photo_path) }}" alt="Foto">
            @if($photo->caption)
            <div class="caption">{{ $photo->caption }}</div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
@empty
<p style="text-align:center; color:#94a3b8; padding:20px;">Belum ada dokumentasi foto.</p>
@endforelse

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── GRAFIK AKTIVITAS ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>GRAFIK AKTIVITAS</h2>

<h3>A. Statistik Kegiatan per Mahasiswa</h3>
<table>
    <thead>
        <tr>
            <th>Nama Mahasiswa</th>
            <th>Total Logbook</th>
            <th>Total Dokumentasi</th>
            <th>Evaluasi Mentor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        @php $stats = $memberStats[$member->id] ?? ['logbooks' => 0, 'docs' => 0]; @endphp
        <tr>
            <td>{{ $member->name }}</td>
            <td style="text-align:center">{{ $stats['logbooks'] }}</td>
            <td style="text-align:center">{{ $stats['docs'] }}</td>
            <td style="text-align:center">{{ $mentorNotes->where('user_id', $member->id)->count() }}</td>
        </tr>
        @endforeach
        <tr style="font-weight:bold; background:#f1f5f9;">
            <td>TOTAL</td>
            <td style="text-align:center">{{ $logbooks->count() }}</td>
            <td style="text-align:center">{{ $documentations->count() }}</td>
            <td style="text-align:center">{{ $mentorNotes->count() }}</td>
        </tr>
    </tbody>
</table>

<h3>B. Distribusi Kategori Kegiatan</h3>
@if($categoryStats->isNotEmpty())
<table>
    <thead><tr><th>Kategori</th><th style="text-align:center">Jumlah</th><th style="text-align:center">Persentase</th></tr></thead>
    <tbody>
        @php $totalCat = $categoryStats->sum(); @endphp
        @foreach($categoryStats as $kategori => $total)
        <tr>
            <td>{{ $kategori }}</td>
            <td style="text-align:center">{{ $total }}</td>
            <td style="text-align:center">{{ $totalCat > 0 ? round(($total / $totalCat) * 100, 1) : 0 }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Simple bar representation --}}
<div style="margin: 8px 0;">
    @foreach($categoryStats as $kategori => $total)
    @php $pct = $totalCat > 0 ? round(($total / $totalCat) * 100, 0) : 0; @endphp
    <div style="display:flex; align-items:center; margin-bottom:4px;">
        <div style="width:160px; font-size:8px; color:#475569;">{{ $kategori }}</div>
        <div style="flex:1; background:#e2e8f0; border-radius:4px; height:14px; margin:0 8px; overflow:hidden;">
            <div style="background:#1e3a5f; height:100%; width:{{ $pct }}%; border-radius:4px;"></div>
        </div>
        <div style="width:30px; text-align:right; font-size:8px;">{{ $total }}</div>
    </div>
    @endforeach
</div>
@endif

<h3>C. Distribusi Mood / Tingkat Kesulitan</h3>
@if(isset($moodStats) && $moodStats->isNotEmpty())
<table>
    <thead><tr><th>Tingkat Kesulitan</th><th style="text-align:center">Jumlah</th></tr></thead>
    <tbody>
        @foreach($moodStats as $mood => $total)
        <tr><td>{{ $mood }}</td><td style="text-align:center">{{ $total }}</td></tr>
        @endforeach
    </tbody>
</table>
@else
<p style="color:#94a3b8;">Belum ada data mood.</p>
@endif

@if(isset($skillDevelopments) && $skillDevelopments->count() > 0)
<h3>D. Perkembangan Skill</h3>
<table>
    <thead><tr><th>Skill</th><th style="text-align:center">Nilai Awal</th><th style="text-align:center">Nilai Akhir</th><th style="text-align:center">Peningkatan</th></tr></thead>
    <tbody>
        @foreach($skillDevelopments as $skill)
        @php $increase = $skill->nilai_akhir ? (($skill->nilai_akhir - $skill->nilai_awal) / max($skill->nilai_awal, 1)) * 100 : 0; @endphp
        <tr>
            <td>{{ $skill->skill_name }}</td>
            <td style="text-align:center">{{ $skill->nilai_awal }}%</td>
            <td style="text-align:center">{{ $skill->nilai_akhir ?? '-' }}%</td>
            <td style="text-align:center">{{ $skill->nilai_akhir ? number_format($increase, 0) . '%' : '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── EVALUASI MENTOR ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>EVALUASI MENTOR</h2>
<p>Berikut adalah catatan dan evaluasi yang diberikan oleh mentor selama periode magang:</p>

@if($mentorNotes->isNotEmpty())
<table>
    <thead><tr><th>Tanggal</th><th>Mahasiswa</th><th>Mentor</th><th>Status</th><th>Catatan</th></tr></thead>
    <tbody>
        @foreach($mentorNotes as $note)
        <tr>
            <td>{{ $note->tanggal->format('d/m/Y') }}</td>
            <td>{{ $note->mahasiswa->name }}</td>
            <td>{{ $note->mentor->name }}</td>
            <td><span class="badge badge-{{ $note->status === 'Sangat Baik' || $note->status === 'Baik' ? 'success' : 'warning' }}">{{ $note->status }}</span></td>
            <td>{{ strip_tags($note->catatan) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Rekapitulasi Status Evaluasi</h3>
@php
    $evalStats = $mentorNotes->groupBy('status')->map->count();
@endphp
<table>
    <thead><tr><th>Status</th><th style="text-align:center">Jumlah</th></tr></thead>
    <tbody>
        @foreach(['Sangat Baik', 'Baik', 'Cukup', 'Perlu Perbaikan'] as $s)
        <tr><td>{{ $s }}</td><td style="text-align:center">{{ $evalStats[$s] ?? 0 }}</td></tr>
        @endforeach
    </tbody>
</table>
@else
<p style="text-align:center; color:#94a3b8; padding:20px;">Belum ada catatan evaluasi dari mentor.</p>
@endif

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── KESIMPULAN ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>KESIMPULAN DAN SARAN</h2>

<h3>A. Kesimpulan</h3>
<p>
    Program magang di Dinas Komunikasi dan Informatika Kota Makassar telah dilaksanakan selama
    <strong>{{ $totalHari }} hari kerja</strong> terhitung mulai {{ $tglMulai->translatedFormat('d F Y') }} hingga
    {{ $tglSelesai->translatedFormat('d F Y') }}. Selama periode tersebut, mahasiswa telah berhasil
    mencatat sebanyak <strong>{{ $logbooks->count() }} kegiatan</strong> dalam logbook harian,
    mengumpulkan <strong>{{ $documentations->count() }} dokumentasi</strong> kegiatan, serta
    menerima <strong>{{ $mentorNotes->count() }} catatan evaluasi</strong> dari mentor.
</p>
<p>
    Secara keseluruhan, program magang ini berjalan dengan baik dan memberikan manfaat yang signifikan
    bagi pengembangan kompetensi mahasiswa di bidang komunikasi digital, pengelolaan media sosial,
    desain konten, dan pengolahan data. Mahasiswa telah mendapatkan pengalaman langsung dalam lingkungan
    kerja profesional di instansi pemerintah.
</p>

@if(isset($achievements) && $achievements->count() > 0)
<h3>B. Pencapaian Selama Magang</h3>
<ul class="daftar">
    @foreach($achievements as $achievement)
    <li>
        <strong>{{ $achievement->judul }}</strong>
        @if($achievement->tanggal) ({{ $achievement->tanggal->format('d M Y') }}) @endif
        @if($achievement->deskripsi) – {{ strip_tags($achievement->deskripsi) }} @endif
    </li>
    @endforeach
</ul>
@endif

@if(isset($projects) && $projects->count() > 0)
<h3>C. Project yang Dikerjakan</h3>
<ul class="daftar">
    @foreach($projects as $project)
    <li>
        <strong>{{ $project->judul }}</strong>
        @if($project->teknologi) [{{ $project->teknologi }}] @endif
        – <em>{{ $project->status_project }}</em>
    </li>
    @endforeach
</ul>
@endif

<h3>D. Saran</h3>
<p>
    1. Diharapkan kerjasama antara Program Studi Bisnis Digital FEB UNM dengan Diskominfo Kota Makassar
       dapat terus ditingkatkan dan diperluas untuk program magang di tahun-tahun mendatang.<br>
    2. Mahasiswa diharapkan terus mengembangkan kompetensi digital yang telah diperoleh selama magang
       dan mengaplikasikannya dalam dunia kerja profesional.<br>
    3. Instansi diharapkan dapat memberikan lebih banyak kesempatan kepada mahasiswa untuk berkontribusi
       dalam proyek-proyek strategis guna memperkaya pengalaman magang.<br>
    4. Sistem InternTrack dapat terus dikembangkan dan diadopsi oleh instansi lain sebagai standar
       dokumentasi magang berbasis digital.
</p>

<div style="margin-top: 40px; text-align: right;">
    <p>Makassar, {{ now()->translatedFormat('d F Y') }}</p>
    <br>
    <p><strong>Menyetujui,</strong></p>
    <p style="margin-top: 50px;"><strong>Kepala Dinas Kominfo Kota Makassar</strong></p>
    <br><br>
    <p>____________________________</p>
</div>

<div class="page-break"></div>

{{-- ═══════════════════════════════════════ --}}
{{── LAMPIRAN ──}}
{{-- ═══════════════════════════════════════ --}}
<h2>LAMPIRAN</h2>

<h3>A. Data Kehadiran</h3>
@if(isset($attendances) && $attendances->count() > 0)
<table>
    <thead><tr><th>Tanggal</th><th>Mahasiswa</th><th>Check-in</th><th>Check-out</th><th>Status</th></tr></thead>
    <tbody>
        @foreach($attendances as $att)
        <tr>
            <td>{{ $att->tanggal->format('d/m/Y') }}</td>
            <td>{{ $att->user->name }}</td>
            <td>{{ $att->check_in?->format('H:i') ?? '-' }}</td>
            <td>{{ $att->check_out?->format('H:i') ?? '-' }}</td>
            <td><span class="badge badge-{{ $att->status === 'Hadir' ? 'success' : ($att->status === 'Izin' ? 'primary' : ($att->status === 'Sakit' ? 'warning' : 'danger')) }}">{{ $att->status }}</span></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p style="color:#94a3b8;">Belum ada data kehadiran.</p>
@endif

<h3>B. Target & Progress</h3>
@if(isset($targets) && $targets->count() > 0)
<table>
    <thead><tr><th>Target</th><th style="text-align:center">Progress</th><th style="text-align:center">Target Selesai</th></tr></thead>
    <tbody>
        @foreach($targets as $target)
        <tr>
            <td>{{ $target->target_name }}</td>
            <td style="text-align:center">{{ $target->progress }}%</td>
            <td style="text-align:center">{{ $target->target_date?->format('d M Y') ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p style="color:#94a3b8;">Belum ada data target.</p>
@endif

<h3>C. Ringkasan Mingguan</h3>
@if(isset($weeklySummaries) && $weeklySummaries->count() > 0)
@foreach($weeklySummaries as $summary)
<div class="section-box">
    <h3 style="margin-top:0;">Minggu Ke-{{ $summary->minggu_ke }}</h3>
    <p style="font-size:9px; color:#64748b;">
        {{ $summary->tanggal_mulai->format('d/m/Y') }} – {{ $summary->tanggal_selesai->format('d/m/Y') }}
    </p>
    @if($summary->pekerjaan)
        <p><strong>Pekerjaan:</strong> {!! strip_tags($summary->pekerjaan) !!}</p>
    @endif
    @if($summary->kendala)
        <p><strong>Kendala:</strong> {!! strip_tags($summary->kendala) !!}</p>
    @endif
    @if($summary->solusi)
        <p><strong>Solusi:</strong> {!! strip_tags($summary->solusi) !!}</p>
    @endif
    @if($summary->skill_dipelajari)
        <p><strong>Skill Dipelajari:</strong> {!! strip_tags($summary->skill_dipelajari) !!}</p>
    @endif
</div>
@endforeach
@else
<p style="color:#94a3b8;">Belum ada ringkasan mingguan.</p>
@endif

<div class="footer">
    <p>Laporan ini dibuat secara otomatis oleh InternTrack | {{ now()->translatedFormat('d F Y, H:i') }}</p>
</div>

</body>
</html>
