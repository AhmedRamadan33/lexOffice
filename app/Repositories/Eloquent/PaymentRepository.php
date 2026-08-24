<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->with('invoice')
            ->when($filters['invoice_id'] ?? null, fn ($q, $invoiceId) => $q->where('invoice_id', $invoiceId))
            ->latest('paid_at')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
