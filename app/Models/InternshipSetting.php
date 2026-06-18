<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class InternshipSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    /**
     * Get a setting value by key (cached for 1 hour).
     */
    public static function getValue(string $key, mixed $default = null): mixed
    {
        return Cache::remember("internship_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value by key and clear the cache.
     */
    public static function setValue(string $key, mixed $value, ?string $description = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'description' => $description]
        );
        Cache::forget("internship_setting_{$key}");
    }
}
