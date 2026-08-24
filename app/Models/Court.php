<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Translatable\HasTranslations;

class Court extends Model
{
    use HasTranslations, LogsActivity;

    protected $translatable = ['name', 'type', 'address'];

    protected $fillable = [
        'name',
        'type',
        'address',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }

    public function sessions()
    {
        return $this->hasMany(CaseSession::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'type', 'is_active'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
