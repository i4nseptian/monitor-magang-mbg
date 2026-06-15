<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeeklySummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'minggu_ke',
        'tanggal_mulai',
        'tanggal_selesai',
        'pekerjaan',
        'kendala',
        'solusi',
        'skill_dipelajari',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
