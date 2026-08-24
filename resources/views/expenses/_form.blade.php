@php $e = $expense ?? null; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.amount') }} <span class="text-danger">*</span></label>
        <input type="number" step="0.01" min="0.01" name="amount" value="{{ old('amount', $e?->amount) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.expense_date') }} <span class="text-danger">*</span></label>
        <input type="date" name="expense_date" value="{{ old('expense_date', $e?->expense_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="form-control" required>
    </div>
</div>

<x-language-tabs id="expense-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.category') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="category[ar]" value="{{ old('category.ar', $e?->getTranslationWithoutFallback('category', 'ar')) }}" class="form-control" required>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.description') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="description[ar]" rows="3" class="form-control">{{ old('description.ar', $e?->getTranslationWithoutFallback('description', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.category') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="category[en]" value="{{ old('category.en', $e?->getTranslationWithoutFallback('category', 'en')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.description') }} ({{ __('app.labels.english') }})</label>
            <textarea name="description[en]" rows="3" class="form-control">{{ old('description.en', $e?->getTranslationWithoutFallback('description', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
