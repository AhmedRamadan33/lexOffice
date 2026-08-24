<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, LogsActivity;

    protected $translatable = ['name', 'title', 'bio', 'specialties', 'education', 'experience'];

    protected $fillable = [
        'name',
        'title',
        'bio',
        'specialties',
        'education',
        'experience',
        'category',
        'phone',
        'email',
        'is_featured',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'title', 'category', 'is_featured', 'is_active'])
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
