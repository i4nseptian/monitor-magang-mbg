<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mentor_id',
        'tanggal',
        'catatan',
        'evaluasi',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public const STATUS = [
        'Sangat Baik',
        'Baik',
        'Cukup',
        'Perlu Perbaikan',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
