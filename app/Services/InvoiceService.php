<?php

namespace App\Services;

use App\Models\Invoice;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    public function __construct(protected InvoiceRepositoryInterface $invoices)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->invoices->paginate($filters);
    }

    public function create(array $data, int $userId): Invoice
    {
        return DB::transaction(function () use ($data, $userId) {
            $totals = $this->calculateTotals($data['items'], $data['tax'] ?? 0, $data['discount'] ?? 0);

            $invoice = $this->invoices->create([
                'invoice_number' => $this->generateInvoiceNumber(),
                'client_id' => $data['client_id'],
                'case_id' => $data['case_id'] ?? null,
                'subtotal' => $totals['subtotal'],
                'tax' => $totals['tax'],
                'discount' => $totals['discount'],
                'total' => $totals['total'],
                'due_date' => $data['due_date'] ?? null,
                'notes' => $data['notes'] ?? null,
                'created_by' => $userId,
            ]);

            foreach ($data['items'] as $item) {
                $invoice->items()->create($item);
            }

            return $invoice;
        });
    }

    public function update(Invoice $invoice, array $data): Invoice
    {
        return DB::transaction(function () use ($invoice, $data) {
            $totals = $this->calculateTotals($data['items'], $data['tax'] ?? 0, $data['discount'] ?? 0);

            $this->invoices->update($invoice, [
                'client_id' => $data['client_id'],
                'case_id' => $data['case_id'] ?? null,
                'subtotal' => $totals['subtotal'],
                'tax' => $totals['tax'],
                'discount' => $totals['discount'],
                'total' => $totals['total'],
                'due_date' => $data['due_date'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);

            $invoice->items()->delete();
            foreach ($data['items'] as $item) {
                $invoice->items()->create($item);
            }

            $invoice->refreshStatus();

            return $invoice;
        });
    }

    public function delete(Invoice $invoice): bool
    {
        return $this->invoices->delete($invoice);
    }

    private function calculateTotals(array $items, float $tax, float $discount): array
    {
        $subtotal = collect($items)->sum('amount');
        $total = max($subtotal + $tax - $discount, 0);

        return compact('subtotal', 'tax', 'discount', 'total');
    }

    private function generateInvoiceNumber(): string
    {
        $year = now()->year;

        do {
            $sequence = Invoice::withTrashed()->whereYear('created_at', $year)->count() + 1;
            $number = sprintf('INV-%d-%04d', $year, $sequence);
        } while (Invoice::withTrashed()->where('invoice_number', $number)->exists());

        return $number;
    }
}
