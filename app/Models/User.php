<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, HasTranslations, InteractsWithMedia, LogsActivity, Notifiable, SoftDeletes;

    protected $translatable = ['name', 'title', 'bio', 'specialties', 'education', 'experience'];

    protected $fillable = [
        'branch_id',
        'name',
        'email',
        'phone',
        'password',
        'is_active',
        'title',
        'bio',
        'specialties',
        'education',
        'experience',
        'category',
        'sort_order',
        'is_team_visible',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_team_visible' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function assignedCases(): HasMany
    {
        return $this->hasMany(CaseModel::class, 'assigned_lawyer_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'phone', 'is_active', 'category', 'is_team_visible'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }

    /**
     * @return array<int, string>
     */
    public function specialtiesList(): array
    {
        return array_filter(array_map('trim', explode("\n", (string) $this->specialties)));
    }

    /**
     * @return array<int, string>
     */
    public function educationList(): array
    {
        return array_filter(array_map('trim', explode("\n", (string) $this->education)));
    }

    /**
     * @return array<int, string>
     */
    public function experienceList(): array
    {
        return array_filter(array_map('trim', explode("\n", (string) $this->experience)));
    }
}
