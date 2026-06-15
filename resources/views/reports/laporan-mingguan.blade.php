@include('reports.partials.header')
<body>
    <div class="header">
        <div class="title">LAPORAN MINGGUAN KEGIATAN MAGANG</div>
        <div class="subtitle">Program Studi Bisnis Digital – FEB Universitas Negeri Makassar</div>
        <div class="period">Dinas Komunikasi dan Informatika Kota Makassar</div>
        <div class="period">Periode: {{ $startDate->translatedFormat('d F Y') }} – {{ $endDate->translatedFormat('d F Y') }}</div>
    </div>

    {{-- Summary Stats --}}
    <div class="section-title">RINGKASAN MINGGUAN</div>
    <table>
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Jumlah Kegiatan</th>
                <th>Jumlah Dokumentasi</th>
                <th>Status Dominan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            @php
                $userLogbooks = $logbooks->where('user_id', $member->id);
                $userDocs = $documentations->where('user_id', $member->id);
                $statusCounts = $userLogbooks->groupBy('status')->map->count();
                $dominantStatus = $statusCounts->sortDesc()->keys()->first() ?? 'N/A';
            @endphp
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $userLogbooks->count() }}</td>
                <td>{{ $userDocs->count() }}</td>
                <td><span class="badge badge-primary">{{ $dominantStatus }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Detailed Logbooks --}}
    <div class="section-title">DETAIL KEGIATAN MINGGUAN</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Judul Kegiatan</th>
                <th>Kategori</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logbooks as $i => $logbook)
            <tr>
                <td>{{ $logbook->tanggal->translatedFormat('d M Y') }}</td>
                <td>{{ $logbook->user->name }}</td>
                <td>{{ $logbook->judul_kegiatan }}</td>
                <td>{{ $logbook->kategori_kegiatan }}</td>
                <td>{{ $logbook->jam_mulai->format('H:i') }}–{{ $logbook->jam_selesai->format('H:i') }}</td>
                <td>
                    <span class="badge badge-{{ $logbook->status === 'Disetujui Mentor' ? 'success' : ($logbook->status === 'Draft' ? 'warning' : 'primary') }}">{{ $logbook->status }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Dokumentasi section --}}
    @if($documentations->isNotEmpty())
        <div class="section-title">FOTO DOKUMENTASI MINGGU INI</div>
        @foreach($documentations as $doc)
            <p style="margin:4px 0;"><strong>{{ $doc->judul }}</strong> — {{ $doc->user->name }} ({{ $doc->tanggal->translatedFormat('d M Y') }})</p>
            @if($doc->keterangan)<p style="color:#64748b;font-size:9px;margin-bottom:6px;">{{ $doc->keterangan }}</p>@endif
        @endforeach
    @endif

    <div class="footer">
        <p>Dibuat otomatis oleh InternTrack | {{ now()->translatedFormat('d F Y, H:i') }}</p>
    </div>
</body>
</html>
