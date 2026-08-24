<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Translatable\HasTranslations;

class Payment extends Model
{
    use HasFactory, HasTranslations, LogsActivity;

    protected $translatable = ['notes'];

    protected $fillable = [
        'invoice_id',
        'amount',
        'paid_at',
        'method',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn (Payment $payment) => $payment->invoice?->refreshStatus());
        static::deleted(fn (Payment $payment) => $payment->invoice?->refreshStatus());
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['amount', 'paid_at', 'method'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
