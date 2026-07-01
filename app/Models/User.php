<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Determine if the user can access the Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['super_admin', 'mentor', 'mahasiswa']);
    }

    // ─── Relationships ───────────────────────────────────────

    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }

    public function logbooks(): HasMany
    {
        return $this->hasMany(Logbook::class);
    }

    public function documentations(): HasMany
    {
        return $this->hasMany(Documentation::class);
    }

    public function mentorNotes(): HasMany
    {
        return $this->hasMany(MentorNote::class);
    }

    public function givenNotes(): HasMany
    {
        return $this->hasMany(MentorNote::class, 'mentor_id');
    }

    public function loginHistories(): HasMany
    {
        return $this->hasMany(LoginHistory::class);
    }

    public function skillDevelopments(): HasMany
    {
        return $this->hasMany(SkillDevelopment::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function weeklySummaries(): HasMany
    {
        return $this->hasMany(WeeklySummary::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }

    // ─── Scopes ──────────────────────────────────────────────

    public function scopeMahasiswa($query)
    {
        try {
            return $query->role('mahasiswa');
        } catch (\Spatie\Permission\Exceptions\RoleDoesNotExist) {
            return $query->whereRaw('1 = 0');
        }
    }

    // ─── Helpers ─────────────────────────────────────────────

    public function isMahasiswa(): bool
    {
        return $this->hasRole('mahasiswa');
    }

    public function isMentor(): bool
    {
        return $this->hasRole('mentor');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    public function getDivisiAttribute(): ?string
    {
        return $this->member?->divisi;
    }

    public function getNimAttribute(): ?string
    {
        return $this->member?->nim;
    }
}
