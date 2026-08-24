<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Translatable\HasTranslations;

class Task extends Model
{
    use BelongsToBranch, HasFactory, HasTranslations, LogsActivity;

    protected $translatable = ['title', 'description'];

    protected $fillable = [
        'branch_id',
        'case_id',
        'assigned_to',
        'assigned_by',
        'title',
        'description',
        'due_date',
        'status',
        'priority',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'due_date', 'status', 'priority', 'assigned_to'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
