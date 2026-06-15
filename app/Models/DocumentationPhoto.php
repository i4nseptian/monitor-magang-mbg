<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentationPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'documentation_id',
        'photo_path',
        'caption',
    ];

    public function documentation(): BelongsTo
    {
        return $this->belongsTo(Documentation::class);
    }
}
