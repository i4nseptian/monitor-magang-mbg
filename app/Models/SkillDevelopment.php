<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillDevelopment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_name',
        'nilai_awal',
        'nilai_akhir',
        'catatan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
