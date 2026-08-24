<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Translatable\HasTranslations;

class PracticeArea extends Model
{
    use HasTranslations, LogsActivity;

    protected $translatable = ['title', 'description'];

    protected $fillable = [
        'icon',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['icon', 'title', 'sort_order', 'is_active'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
