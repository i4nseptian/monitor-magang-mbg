@include('reports.partials.header')
<body>
    <div class="header">
        <div class="title">LAPORAN HARIAN KEGIATAN MAGANG</div>
        <div class="subtitle">Program Studi Bisnis Digital – FEB Universitas Negeri Makassar</div>
        <div class="period">Dinas Komunikasi dan Informatika Kota Makassar</div>
        <div class="period">Periode: {{ $startDate->translatedFormat('d F Y') }} – {{ $endDate->translatedFormat('d F Y') }}</div>
    </div>

    @if($logbooks->isEmpty())
        <p style="text-align:center; color:#64748b; margin: 30px 0;">Tidak ada data logbook pada periode ini.</p>
    @else
        @foreach($logbooks->groupBy(fn($l) => $l->tanggal->format('Y-m-d')) as $date => $dayLogs)
            <div class="section-title">
                {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }} — Hari Ke-{{ $dayLogs->first()->hari_ke }}
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="18%">Nama</th>
                        <th width="28%">Judul Kegiatan</th>
                        <th width="20%">Kategori</th>
                        <th width="10%">Waktu</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dayLogs as $i => $logbook)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $logbook->user->name }}</td>
                        <td>{{ $logbook->judul_kegiatan }}</td>
                        <td>{{ $logbook->kategori_kegiatan }}</td>
                        <td>{{ $logbook->jam_mulai->format('H:i') }}–{{ $logbook->jam_selesai->format('H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $logbook->status === 'Disetujui Mentor' ? 'success' : ($logbook->status === 'Draft' ? 'warning' : 'primary') }}">
                                {{ $logbook->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endif

    @if($documentations->isNotEmpty())
        <div class="section-title">DOKUMENTASI HARI INI</div>
        @foreach($documentations as $doc)
            <p style="margin-bottom: 4px;"><strong>{{ $doc->judul }}</strong> – {{ $doc->user->name }}</p>
            <p style="color: #64748b; font-size:9px; margin-bottom:8px;">{{ $doc->keterangan }}</p>
        @endforeach
    @endif

    <div class="footer">
        <p>Dibuat otomatis oleh InternTrack | {{ now()->translatedFormat('d F Y, H:i') }}</p>
        <p>Dinas Komunikasi dan Informatika Kota Makassar</p>
    </div>
</body>
</html>
