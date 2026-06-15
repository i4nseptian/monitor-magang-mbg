<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'hari_ke',
        'judul_kegiatan',
        'deskripsi_kegiatan',
        'kategori_kegiatan',
        'jam_mulai',
        'jam_selesai',
        'status',
        'mood',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    public const KATEGORI = [
        'Pengelolaan Media Sosial',
        'Publikasi Informasi Digital',
        'Pengolahan Data',
        'Desain Konten Digital',
        'Dokumentasi Kegiatan',
        'Peliputan Lapangan',
        'Strategi Komunikasi Digital',
        'Penyusunan Laporan',
        'Lainnya',
    ];

    public const STATUS = [
        'Draft',
        'Menunggu Review',
        'Disetujui Mentor',
        'Revisi',
    ];

    public const MOOD = [
        '😀 Mudah',
        '🙂 Normal',
        '😐 Cukup Sulit',
        '😵 Sangat Sulit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(LogbookPhoto::class);
    }

    /**
     * Auto-calculate hari_ke based on internship start date.
     */
    public static function calculateHariKe(\DateTime $tanggal): int
    {
        $setting = InternshipSetting::where('key', 'tanggal_mulai')->first();
        if (!$setting) {
            return 1;
        }

        $startDate = new \DateTime($setting->value);

        // If the given date is before the internship start date, return 1
        if ($tanggal < $startDate) {
            return 1;
        }

        $diff = $startDate->diff($tanggal);

        return $diff->days + 1;
    }
}
