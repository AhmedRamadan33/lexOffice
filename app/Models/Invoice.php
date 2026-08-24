<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Translatable\HasTranslations;

class Invoice extends Model
{
    use BelongsToBranch, HasFactory, HasTranslations, LogsActivity, SoftDeletes;

    protected $translatable = ['notes'];

    protected $fillable = [
        'branch_id',
        'invoice_number',
        'client_id',
        'case_id',
        'subtotal',
        'tax',
        'discount',
        'total',
        'status',
        'due_date',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'tax' => 'decimal:2',
            'discount' => 'decimal:2',
            'total' => 'decimal:2',
            'due_date' => 'date',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['invoice_number', 'total', 'status', 'due_date'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function case(): BelongsTo
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getPaidAmountAttribute(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getBalanceAttribute(): float
    {
        return (float) $this->total - $this->paid_amount;
    }

    public function refreshStatus(): void
    {
        $paid = $this->paid_amount;

        $status = match (true) {
            $paid <= 0 => 'unpaid',
            $paid < (float) $this->total => 'partial',
            default => 'paid',
        };

        if ($status !== $this->status) {
            $this->update(['status' => $status]);
        }
    }
}
