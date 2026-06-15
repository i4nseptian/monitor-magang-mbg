<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'teknologi',
        'screenshot',
        'link',
        'status_project',
    ];

    public const STATUS_PROJECT = [
        'Selesai',
        'Sedang Dikerjakan',
        'Ditunda',
        'Dibatalkan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
