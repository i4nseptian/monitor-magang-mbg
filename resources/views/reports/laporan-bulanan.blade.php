@include('reports.partials.header')
<body>
    <div class="header">
        <div class="title">LAPORAN BULANAN KEGIATAN MAGANG</div>
        <div class="subtitle">Program Studi Bisnis Digital – FEB Universitas Negeri Makassar</div>
        <div class="period">Dinas Komunikasi dan Informatika Kota Makassar</div>
        <div class="period">Periode: {{ $startDate->translatedFormat('F Y') }}</div>
    </div>

    {{-- Statistik per Anggota --}}
    <div class="section-title">REKAP AKTIVITAS BULANAN PER MAHASISWA</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Divisi</th>
                <th>Kegiatan</th>
                <th>Dokumentasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $i => $member)
            @php
                $stats = $memberStats[$member->id] ?? ['logbooks' => 0, 'docs' => 0];
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->member?->nim ?? '-' }}</td>
                <td>{{ $member->member?->divisi ?? '-' }}</td>
                <td style="text-align:center;">{{ $stats['logbooks'] }}</td>
                <td style="text-align:center;">{{ $stats['docs'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Kategori Kegiatan --}}
    @if($categoryStats->isNotEmpty())
        <div class="section-title">DISTRIBUSI KATEGORI KEGIATAN</div>
        <table>
            <thead>
                <tr>
                    <th>Kategori Kegiatan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoryStats as $kategori => $total)
                <tr>
                    <td>{{ $kategori }}</td>
                    <td>{{ $total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Detail Logbook --}}
    <div class="section-title">REKAP KEGIATAN BULAN INI ({{ $logbooks->count() }} Entri)</div>
    <table>
        <thead>
            <tr>
                <th>Tgl</th>
                <th>Hari ke-</th>
                <th>Nama</th>
                <th>Judul Kegiatan</th>
                <th>Kategori</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logbooks as $logbook)
            <tr>
                <td>{{ $logbook->tanggal->format('d/m') }}</td>
                <td style="text-align:center">{{ $logbook->hari_ke }}</td>
                <td>{{ $logbook->user->name }}</td>
                <td>{{ $logbook->judul_kegiatan }}</td>
                <td>{{ $logbook->kategori_kegiatan }}</td>
                <td><span class="badge badge-{{ $logbook->status === 'Disetujui Mentor' ? 'success' : ($logbook->status === 'Draft' ? 'warning' : 'primary') }}">{{ $logbook->status }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dibuat otomatis oleh InternTrack | {{ now()->translatedFormat('d F Y, H:i') }}</p>
    </div>
</body>
</html>
