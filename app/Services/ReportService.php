<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\Attendance;
use App\Models\Documentation;
use App\Models\DocumentationPhoto;
use App\Models\InternshipSetting;
use App\Models\Logbook;
use App\Models\MentorNote;
use App\Models\Project;
use App\Models\SkillDevelopment;
use App\Models\Target;
use App\Models\User;
use App\Models\WeeklySummary;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Get all data needed for a specific report type.
     */
    public function getData(string $type, ?string $from, ?string $to, ?int $userId = null): array
    {
        $startDate = $from ? Carbon::parse($from)->startOfDay() : Carbon::now()->startOfMonth()->startOfDay();
        $endDate = $to ? Carbon::parse($to)->endOfDay() : Carbon::now()->endOfDay();

        $logbooks = Logbook::with(['user', 'photos'])
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('tanggal')
            ->get();

        $documentations = Documentation::with(['user', 'photos'])
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('tanggal')
            ->get();

        $members = User::role('mahasiswa')->with('member')->get();

        $mentorNotes = MentorNote::with(['mahasiswa', 'mentor'])
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('tanggal')
            ->get();

        // Timeline info
        $tglMulai = Carbon::parse(InternshipSetting::getValue('tanggal_mulai', '2026-06-08'));
        $tglSelesai = Carbon::parse(InternshipSetting::getValue('tanggal_selesai', '2026-08-28'));
        $totalHari = (int) $tglMulai->diffInDays($tglSelesai) + 1;
        $hariBerjalan = min((int) $tglMulai->diffInDays(Carbon::now()) + 1, $totalHari);
        $persentase = round(($hariBerjalan / $totalHari) * 100);

        // ─── Process logbook-derived stats from $logbooks (already fetched) ───
        // Category stats
        $categoryStats = $logbooks->groupBy('kategori_kegiatan')
            ->map(fn ($items) => $items->count());

        // Weekly rekap
        $weeklyRekap = [];
        $logbooksByWeek = $logbooks->groupBy(fn ($item) => ceil($item->hari_ke / 7));
        foreach ($logbooksByWeek as $week => $items) {
            $weeklyRekap[$week] = [
                'minggu_ke' => $week,
                'total_kegiatan' => $items->count(),
                'kegiatan' => $items,
            ];
        }

        // Mood stats
        $moodStats = $logbooks->whereNotNull('mood')
            ->groupBy('mood')
            ->map(fn ($items) => $items->count());

        // Member stats (single query per model instead of N+1)
        $memberLogbookCounts = Logbook::select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $memberDocCounts = Documentation::select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $memberStats = [];
        foreach ($members as $member) {
            $memberStats[$member->id] = [
                'name' => $member->name,
                'logbooks' => (int) ($memberLogbookCounts[$member->id]->total ?? 0),
                'docs' => (int) ($memberDocCounts[$member->id]->total ?? 0),
            ];
        }

        // ─── New data ─────────────────────────────────────

        // Skill developments
        $skillDevelopments = SkillDevelopment::with('user')
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->get();

        // Achievements
        $achievements = Achievement::with('user')
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->orderBy('tanggal')
            ->get();

        // Projects
        $projects = Project::with('user')
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->get();

        // Weekly summaries
        $weeklySummaries = WeeklySummary::with('user')
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->orderBy('minggu_ke')
            ->get();

        // Attendances
        $attendances = Attendance::with('user')
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('tanggal')
            ->get();

        // Targets
        $targets = Target::with('user')
            ->when($userId, fn ($q) => $q->where('user_id', $userId))
            ->get();

        // Attendance stats (single aggregate query instead of N+1)
        $attendanceAgg = Attendance::select('user_id', 'status', DB::raw('count(*) as total'))
            ->groupBy('user_id', 'status')
            ->get()
            ->groupBy('user_id');

        $attendanceStats = [];
        foreach ($members as $member) {
            $stats = $attendanceAgg->get($member->id, collect());
            $totalSemua = $stats->sum('total');
            $totalIzin = (int) $stats->where('status', 'Izin')->sum('total');
            $totalSakit = (int) $stats->where('status', 'Sakit')->sum('total');
            $totalAlpha = (int) $stats->where('status', 'Alpha')->sum('total');
            $totalHadirAktual = $totalSemua - $totalIzin - $totalSakit - $totalAlpha;
            $persenHadir = $totalSemua > 0 ? round($totalHadirAktual / $totalSemua * 100) : 0;

            $attendanceStats[$member->id] = [
                'total' => $totalSemua,
                'hadir' => $totalHadirAktual,
                'izin' => $totalIzin,
                'sakit' => $totalSakit,
                'alpha' => $totalAlpha,
                'persentase' => $persenHadir,
            ];
        }

        return compact(
            'logbooks',
            'documentations',
            'members',
            'mentorNotes',
            'tglMulai',
            'tglSelesai',
            'totalHari',
            'hariBerjalan',
            'persentase',
            'categoryStats',
            'memberStats',
            'startDate',
            'endDate',
            'type',
            'weeklyRekap',
            'skillDevelopments',
            'achievements',
            'projects',
            'weeklySummaries',
            'attendances',
            'targets',
            'moodStats',
            'attendanceStats'
        );
    }

    /**
     * Get comprehensive final stats for the dashboard.
     */
    public function getFinalStats(?int $userId = null): array
    {
        $tglMulai = Carbon::parse(InternshipSetting::getValue('tanggal_mulai', '2026-06-08'));
        $tglSelesai = Carbon::parse(InternshipSetting::getValue('tanggal_selesai', '2026-08-28'));
        $totalHari = (int) $tglMulai->diffInDays($tglSelesai) + 1;

        $base = $userId ? [['user_id', '=', $userId]] : [];
        $totalLogbook = Logbook::where($base)->count();
        $totalDokumentasi = Documentation::where($base)->count();
        $totalFoto = DocumentationPhoto::whereIn('documentation_id',
            Documentation::select('id')->where($base)
        )->count();
        $totalProject = Project::where($base)->count();
        $totalEvaluasi = MentorNote::where($base)->count();
        $totalAchievements = Achievement::where($base)->count();
        $totalSkills = SkillDevelopment::where($base)->count();
        $totalTargets = Target::where($base)->count();

        $attendanceCounts = Attendance::where($base)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
        $totalAttendance = $attendanceCounts->sum();
        $totalIzin = (int) ($attendanceCounts['Izin'] ?? 0);
        $totalSakit = (int) ($attendanceCounts['Sakit'] ?? 0);
        $totalAlpha = (int) ($attendanceCounts['Alpha'] ?? 0);
        $totalHadirAktual = $totalAttendance - $totalIzin - $totalSakit - $totalAlpha;
        $persenHadir = $totalAttendance > 0 ? round($totalHadirAktual / $totalAttendance * 100, 1) : 0;

        // Most frequent category
        $topCategory = Logbook::when($userId, fn ($q) => $q->where('user_id', $userId))
            ->select('kategori_kegiatan', DB::raw('count(*) as total'))
            ->groupBy('kategori_kegiatan')
            ->orderByDesc('total')
            ->first();

        // Category distribution
        $categoryDistribution = Logbook::when($userId, fn ($q) => $q->where('user_id', $userId))
            ->select('kategori_kegiatan', DB::raw('count(*) as total'))
            ->groupBy('kategori_kegiatan')
            ->orderByDesc('total')
            ->get()
            ->toArray();

        return [
            'total_hari' => $totalHari,
            'total_logbook' => $totalLogbook,
            'total_dokumentasi' => $totalDokumentasi,
            'total_foto' => $totalFoto,
            'total_project' => $totalProject,
            'total_evaluasi' => $totalEvaluasi,
            'total_achievements' => $totalAchievements,
            'total_skills' => $totalSkills,
            'total_targets' => $totalTargets,
            'total_hadir' => $totalAttendance,
            'total_hadir_aktual' => $totalHadirAktual,
            'persen_hadir' => $persenHadir,
            'top_category' => $topCategory?->kategori_kegiatan ?? '-',
            'top_category_count' => $topCategory?->total ?? 0,
            'category_distribution' => $categoryDistribution,
            'tgl_mulai' => $tglMulai,
            'tgl_selesai' => $tglSelesai,
        ];
    }

    /**
     * Quick stats for the laporan page preview.
     */
    public function getQuickStats(?int $userId = null): array
    {
        $results = DB::select("
            SELECT
                (SELECT COUNT(*) FROM logbooks " . ($userId ? "WHERE user_id = ?" : "") . ") as total_logbook,
                (SELECT COUNT(*) FROM documentations " . ($userId ? "WHERE user_id = ?" : "") . ") as total_dokumentasi,
                (SELECT COUNT(*) FROM mentor_notes " . ($userId ? "WHERE user_id = ?" : "") . ") as total_catatan_mentor,
                (SELECT COUNT(*) FROM skill_developments " . ($userId ? "WHERE user_id = ?" : "") . ") as total_skill,
                (SELECT COUNT(*) FROM projects " . ($userId ? "WHERE user_id = ?" : "") . ") as total_project,
                (SELECT COUNT(*) FROM attendances " . ($userId ? "WHERE user_id = ?" : "") . ") as total_attendance
        ", $userId ? array_fill(0, 6, $userId) : []);

        $row = $results[0] ?? (object) [
            'total_logbook' => 0, 'total_dokumentasi' => 0, 'total_catatan_mentor' => 0,
            'total_skill' => 0, 'total_project' => 0, 'total_attendance' => 0,
        ];

        return [
            'totalLogbook' => $row->total_logbook,
            'totalDokumentasi' => $row->total_dokumentasi,
            'totalCatatanMentor' => $row->total_catatan_mentor,
            'totalSkill' => $row->total_skill,
            'totalProject' => $row->total_project,
            'totalAttendance' => $row->total_attendance,
        ];
    }
}
