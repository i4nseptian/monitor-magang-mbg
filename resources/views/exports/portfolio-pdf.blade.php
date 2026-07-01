<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Portfolio {{ $user->name }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #1e293b; margin: 0; padding: 20px; }
        h1 { font-size: 18px; color: #1e3a5f; margin-bottom: 4px; }
        h2 { font-size: 13px; color: #1e3a5f; border-bottom: 2px solid #6366f1; padding-bottom: 4px; margin: 20px 0 8px; }
        h3 { font-size: 11px; color: #334155; margin: 10px 0 5px; }
        p { font-size: 10px; line-height: 1.6; color: #475569; margin-bottom: 4px; }
        .header { text-align: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 3px solid #6366f1; }
        .header h1 { margin-bottom: 2px; }
        .header p { margin: 2px 0; font-size: 10px; color: #64748b; }
        .section { margin: 12px 0; }
        .skill-tag { display: inline-block; background: #eef2ff; color: #4338ca; padding: 2px 8px; border-radius: 3px; font-size: 9px; margin: 2px 3px 2px 0; }
        .project-item, .achievement-item, .target-item { border: 1px solid #e2e8f0; border-radius: 4px; padding: 8px 10px; margin: 6px 0; }
        .project-item h3, .achievement-item h3 { margin: 0 0 3px; font-size: 11px; }
        .meta { font-size: 9px; color: #94a3b8; }
        .footer { text-align: center; margin-top: 30px; padding-top: 10px; border-top: 1px solid #e2e8f0; font-size: 9px; color: #94a3b8; }
        .skill-bar { margin: 6px 0; }
        .skill-bar-label { font-size: 9px; color: #475569; margin-bottom: 2px; }
        .skill-bar-track { height: 6px; background: #e2e8f0; border-radius: 3px; overflow: hidden; }
        .skill-bar-fill { height: 100%; background: #6366f1; border-radius: 3px; }
        .progress-bar { margin: 4px 0; }
        .progress-label { font-size: 9px; color: #475569; }
        .progress-track { height: 6px; background: #e2e8f0; border-radius: 3px; overflow: hidden; }
        .progress-fill { height: 100%; background: #10b981; border-radius: 3px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Portfolio Magang</h1>
        <p>Dinas Komunikasi dan Informatika Kota Makassar</p>
        <p>Program Studi Bisnis Digital – FEB Universitas Negeri Makassar</p>
    </div>

    <div style="margin-bottom:16px;">
        <h1 style="font-size:16px; margin-bottom:2px;">{{ $user->name }}</h1>
        @if($member)
        <p style="margin:1px 0;">{{ $member->program_studi }} | NIM {{ $member->nim }}</p>
        <p style="margin:1px 0;">Divisi {{ $member->divisi }}</p>
        @endif
    </div>

    @if($skills->isNotEmpty())
    <h2>Perkembangan Skill</h2>
    <div class="section">
        @foreach($skills as $skill)
        <div class="skill-bar">
            <div class="skill-bar-label">{{ $skill->skill_name }} ({{ $skill->nilai_awal }}% → {{ $skill->nilai_akhir ?? '-' }}%)</div>
            <div class="skill-bar-track">
                <div class="skill-bar-fill" style="width: {{ $skill->nilai_akhir ?? $skill->nilai_awal }}%"></div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($projects->isNotEmpty())
    <h2>Daftar Project</h2>
    <div class="section">
        @foreach($projects as $project)
        <div class="project-item">
            <h3>{{ $project->judul }}</h3>
            <p>{{ $project->deskripsi }}</p>
            @if($project->teknologi)
            <p class="meta">Teknologi: {{ $project->teknologi }}</p>
            @endif
            <p class="meta">Status: {{ $project->status_project }}</p>
        </div>
        @endforeach
    </div>
    @endif

    @if($achievements->isNotEmpty())
    <h2>Pencapaian</h2>
    <div class="section">
        @foreach($achievements as $achievement)
        <div class="achievement-item">
            <h3>{{ $achievement->judul }}</h3>
            <p>{{ $achievement->deskripsi }}</p>
            @if($achievement->tanggal)
            <p class="meta">{{ \Carbon\Carbon::parse($achievement->tanggal)->format('d/m/Y') }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($targets->isNotEmpty())
    <h2>Target & Pencapaian Kerja</h2>
    <div class="section">
        @foreach($targets as $target)
        <div class="target-item">
            <h3>{{ $target->target_name }}</h3>
            <div class="progress-bar">
                <div class="progress-label">Progress: {{ $target->progress }}%</div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: {{ $target->progress }}%"></div>
                </div>
            </div>
            @if($target->catatan)
            <p>{{ $target->catatan }}</p>
            @endif
            @if($target->target_date)
            <p class="meta">Target selesai: {{ \Carbon\Carbon::parse($target->target_date)->format('d/m/Y') }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <div class="footer">
        Dihasilkan oleh InternTrack &bull; {{ now()->translatedFormat('d F Y') }}
    </div>

</body>
</html>
