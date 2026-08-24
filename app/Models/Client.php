<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Client extends Model implements HasMedia
{
    use BelongsToBranch, HasFactory, HasTranslations, InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $translatable = ['name', 'address', 'notes'];

    protected $fillable = [
        'branch_id',
        'name',
        'type',
        'phone',
        'email',
        'national_id',
        'address',
        'notes',
        'created_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'type', 'phone', 'email', 'national_id', 'address'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function cases(): BelongsToMany
    {
        return $this->belongsToMany(CaseModel::class, 'case_client', 'client_id', 'case_id');
    }

    public function primaryCases(): HasMany
    {
        return $this->hasMany(CaseModel::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
