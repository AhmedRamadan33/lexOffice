<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Translatable\HasTranslations;

class CaseSession extends Model
{
    use HasFactory, HasTranslations, LogsActivity;

    protected $translatable = ['judge_name', 'notes', 'decision'];

    protected $fillable = [
        'case_id',
        'court_id',
        'session_date',
        'session_time',
        'judge_name',
        'notes',
        'decision',
        'next_session_date',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'session_date' => 'date',
            'next_session_date' => 'date',
        ];
    }

    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judge_name', 'session_date', 'session_time', 'status', 'decision', 'next_session_date'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
