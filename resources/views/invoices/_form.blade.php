@php
$inv = $invoice ?? null;
$existingItems = old('items', $inv?->items?->map(fn ($i) => [
    'description' => ['ar' => $i->getTranslationWithoutFallback('description', 'ar'), 'en' => $i->getTranslationWithoutFallback('description', 'en')],
    'amount' => $i->amount,
])->toArray() ?? [['description' => ['ar' => '', 'en' => ''], 'amount' => '']]);
@endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.client') }} <span class="text-danger">*</span></label>
        <select name="client_id" class="form-select" required>
            <option value="">-</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}" @selected(old('client_id', $inv?->client_id) == $client->id)>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.case') }}</label>
        <select name="case_id" class="form-select">
            <option value="">-</option>
            @foreach ($cases as $case)
                <option value="{{ $case->id }}" @selected(old('case_id', $inv?->case_id) == $case->id)>{{ $case->case_number }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.labels.due_date') }}</label>
        <input type="date" name="due_date" value="{{ old('due_date', $inv?->due_date?->format('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.labels.tax') }}</label>
        <input type="number" step="0.01" min="0" name="tax" value="{{ old('tax', $inv?->tax ?? 0) }}" class="form-control" id="tax-input">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.labels.discount') }}</label>
        <input type="number" step="0.01" min="0" name="discount" value="{{ old('discount', $inv?->discount ?? 0) }}" class="form-control" id="discount-input">
    </div>

    <div class="col-12">
        <label class="form-label">{{ __('app.labels.items') }}</label>
        <table class="table" id="items-table">
            <thead>
                <tr>
                    <th>{{ __('app.labels.description') }} ({{ __('app.labels.arabic') }} / {{ __('app.labels.english') }})</th>
                    <th style="width:180px">{{ __('app.labels.amount') }}</th>
                    <th style="width:40px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($existingItems as $i => $item)
                    <tr>
                        <td>
                            <input type="text" name="items[{{ $i }}][description][ar]" value="{{ $item['description']['ar'] ?? '' }}" class="form-control mb-1" placeholder="{{ __('app.labels.arabic') }}" required>
                            <input type="text" name="items[{{ $i }}][description][en]" value="{{ $item['description']['en'] ?? '' }}" class="form-control form-control-sm" placeholder="{{ __('app.labels.english') }}">
                        </td>
                        <td><input type="number" step="0.01" min="0" name="items[{{ $i }}][amount]" value="{{ $item['amount'] }}" class="form-control item-amount" required></td>
                        <td><button type="button" class="btn btn-outline-danger btn-sm remove-item"><i class="bi bi-x-lg"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-outline-primary btn-sm" id="add-item"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</button>
    </div>

    <div class="col-12">
        <div class="d-flex justify-content-end">
            <table class="table table-sm w-auto">
                <tr><td class="text-secondary">{{ __('app.labels.subtotal') }}</td><td class="text-end" id="subtotal-display">0.00</td></tr>
                <tr><td class="text-secondary">{{ __('app.labels.total') }}</td><td class="text-end fw-bold" id="total-display">0.00</td></tr>
            </table>
        </div>
    </div>
</div>

<x-language-tabs id="invoice-lang">
    <x-slot:ar>
        <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.arabic') }})</label>
        <textarea name="notes[ar]" rows="2" class="form-control">{{ old('notes.ar', $inv?->getTranslationWithoutFallback('notes', 'ar')) }}</textarea>
    </x-slot:ar>
    <x-slot:en>
        <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.english') }})</label>
        <textarea name="notes[en]" rows="2" class="form-control">{{ old('notes.en', $inv?->getTranslationWithoutFallback('notes', 'en')) }}</textarea>
    </x-slot:en>
</x-language-tabs>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>

<script>
(function () {
    const table = document.getElementById('items-table').querySelector('tbody');
    const taxInput = document.getElementById('tax-input');
    const discountInput = document.getElementById('discount-input');
    let index = table.querySelectorAll('tr').length;

    function recalc() {
        let subtotal = 0;
        table.querySelectorAll('.item-amount').forEach(input => subtotal += parseFloat(input.value || 0));
        const tax = parseFloat(taxInput.value || 0);
        const discount = parseFloat(discountInput.value || 0);
        const total = Math.max(subtotal + tax - discount, 0);
        document.getElementById('subtotal-display').textContent = subtotal.toFixed(2);
        document.getElementById('total-display').textContent = total.toFixed(2);
    }

    document.getElementById('add-item').addEventListener('click', function () {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <input type="text" name="items[${index}][description][ar]" class="form-control mb-1" placeholder="{{ __('app.labels.arabic') }}" required>
                <input type="text" name="items[${index}][description][en]" class="form-control form-control-sm" placeholder="{{ __('app.labels.english') }}">
            </td>
            <td><input type="number" step="0.01" min="0" name="items[${index}][amount]" class="form-control item-amount" required></td>
            <td><button type="button" class="btn btn-outline-danger btn-sm remove-item"><i class="bi bi-x-lg"></i></button></td>
        `;
        table.appendChild(row);
        index++;
    });

    table.addEventListener('click', function (e) {
        if (e.target.closest('.remove-item')) {
            e.target.closest('tr').remove();
            recalc();
        }
    });

    table.addEventListener('input', recalc);
    taxInput.addEventListener('input', recalc);
    discountInput.addEventListener('input', recalc);
    recalc();
})();
</script>
