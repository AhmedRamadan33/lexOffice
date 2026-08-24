<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentService
{
    public function __construct(protected PaymentRepositoryInterface $payments)
    {
    }

    public function create(Invoice $invoice, array $data, int $userId): Payment
    {
        $data['created_by'] = $userId;

        return $invoice->payments()->create($data);
    }

    public function delete(Payment $payment): bool
    {
        return $this->payments->delete($payment);
    }
}
