<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(protected InvoiceService $invoices)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $invoices = $this->invoices->paginate($request->only(['search', 'status', 'client_id', 'per_page']));

        return response()->json(InvoiceResource::collection($invoices)->response()->getData(true));
    }

    public function store(StoreInvoiceRequest $request): JsonResponse
    {
        $invoice = $this->invoices->create($request->validated(), $request->user()->id);
        $invoice->load(['client', 'items']);

        return response()->json(new InvoiceResource($invoice), 201);
    }

    public function show(Invoice $invoice): JsonResponse
    {
        $invoice->load(['client', 'items', 'payments']);

        return response()->json(new InvoiceResource($invoice));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): JsonResponse
    {
        $this->invoices->update($invoice, $request->validated());
        $invoice->load(['client', 'items', 'payments']);

        return response()->json(new InvoiceResource($invoice));
    }

    public function destroy(Invoice $invoice): JsonResponse
    {
        $this->invoices->delete($invoice);

        return response()->json(null, 204);
    }
}
