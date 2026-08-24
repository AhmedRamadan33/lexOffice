<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class SuccessStory extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, LogsActivity;

    protected $translatable = ['title', 'excerpt', 'body'];

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'category',
        'story_date',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'story_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'category', 'story_date', 'is_active'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
