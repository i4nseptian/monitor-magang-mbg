<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'check_in',
        'check_out',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'check_in' => 'datetime:H:i',
        'check_out' => 'datetime:H:i',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalJamAttribute(): string
    {
        if (!$this->check_in || !$this->check_out) {
            return '-';
        }

        $diff = $this->check_in->diff($this->check_out);

        $jam = $diff->days * 24 + $diff->h;
        return $jam . ' jam ' . $diff->i . ' menit';
    }
}
