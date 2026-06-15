<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogbookPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'logbook_id',
        'photo_path',
        'caption',
    ];

    public function logbook(): BelongsTo
    {
        return $this->belongsTo(Logbook::class);
    }
}
