<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\StorePaymentRequest;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $payments)
    {
    }

    public function store(StorePaymentRequest $request, Invoice $invoice): RedirectResponse
    {
        $this->payments->create($invoice, $request->validated(), $request->user()->id);

        return back()->with('success', __('app.messages.created'));
    }

    public function destroy(Payment $payment): RedirectResponse
    {
        $this->payments->delete($payment);

        return back()->with('success', __('app.messages.deleted'));
    }
}
