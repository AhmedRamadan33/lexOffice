<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Models\CaseModel;
use App\Models\Client;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function __construct(protected InvoiceService $invoices)
    {
    }

    public function index(Request $request): View
    {
        $invoices = $this->invoices->paginate($request->only(['search', 'status', 'client_id', 'per_page']));

        return view('invoices.index', [
            'invoices' => $invoices,
            'clients' => Client::orderBy('name->ar')->get(),
        ]);
    }

    public function create(): View
    {
        return view('invoices.create', $this->formData());
    }

    public function store(StoreInvoiceRequest $request): RedirectResponse
    {
        $invoice = $this->invoices->create($request->validated(), $request->user()->id);

        return redirect()->route('invoices.show', $invoice)->with('success', __('app.messages.created'));
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['client', 'case', 'items', 'payments.creator']);

        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice): View
    {
        $invoice->load('items');

        return view('invoices.edit', [...$this->formData(), 'invoice' => $invoice]);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        $this->invoices->update($invoice, $request->validated());

        return redirect()->route('invoices.show', $invoice)->with('success', __('app.messages.updated'));
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $this->invoices->delete($invoice);

        return redirect()->route('invoices.index')->with('success', __('app.messages.deleted'));
    }

    private function formData(): array
    {
        return [
            'clients' => Client::orderBy('name->ar')->get(),
            'cases' => CaseModel::orderBy('case_number')->get(),
        ];
    }
}
