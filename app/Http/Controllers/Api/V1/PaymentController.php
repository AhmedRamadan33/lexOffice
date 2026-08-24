<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $payments)
    {
    }

    public function store(StorePaymentRequest $request, Invoice $invoice): JsonResponse
    {
        $payment = $this->payments->create($invoice, $request->validated(), $request->user()->id);

        return response()->json(new PaymentResource($payment), 201);
    }

    public function destroy(Payment $payment): JsonResponse
    {
        $this->payments->delete($payment);

        return response()->json(null, 204);
    }
}
