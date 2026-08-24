@php $b = $branch ?? null; @endphp

<x-language-tabs id="branch-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="name[ar]" value="{{ old('name.ar', $b?->getTranslationWithoutFallback('name', 'ar')) }}" class="form-control" required>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.address') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="address[ar]" value="{{ old('address.ar', $b?->getTranslationWithoutFallback('address', 'ar')) }}" class="form-control">
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="name[en]" value="{{ old('name.en', $b?->getTranslationWithoutFallback('name', 'en')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.address') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="address[en]" value="{{ old('address.en', $b?->getTranslationWithoutFallback('address', 'en')) }}" class="form-control">
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.phone') }}</label>
        <input type="text" name="phone" value="{{ old('phone', $b?->phone) }}" class="form-control">
    </div>
    <div class="col-md-6 d-flex align-items-end gap-4">
        <div class="form-check">
            <input type="checkbox" name="is_main" value="1" id="is_main" class="form-check-input" @checked(old('is_main', $b?->is_main))>
            <label for="is_main" class="form-check-label">{{ __('app.labels.is_main') }}</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" @checked(old('is_active', $b?->is_active ?? true))>
            <label for="is_active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
        </div>
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('branches.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
