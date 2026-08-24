@php $c = $client ?? null; @endphp

<x-language-tabs id="client-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="name[ar]" value="{{ old('name.ar', $c?->getTranslationWithoutFallback('name', 'ar')) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.address') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="address[ar]" value="{{ old('address.ar', $c?->getTranslationWithoutFallback('address', 'ar')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="notes[ar]" rows="3" class="form-control">{{ old('notes.ar', $c?->getTranslationWithoutFallback('notes', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="name[en]" value="{{ old('name.en', $c?->getTranslationWithoutFallback('name', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.address') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="address[en]" value="{{ old('address.en', $c?->getTranslationWithoutFallback('address', 'en')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.english') }})</label>
            <textarea name="notes[en]" rows="3" class="form-control">{{ old('notes.en', $c?->getTranslationWithoutFallback('notes', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.type') }} <span class="text-danger">*</span></label>
        <select name="type" class="form-select" required>
            <option value="individual" @selected(old('type', $c?->type) === 'individual')>{{ __('app.labels.individual') }}</option>
            <option value="company" @selected(old('type', $c?->type) === 'company')>{{ __('app.labels.company') }}</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.phone') }} <span class="text-danger">*</span></label>
        <input type="text" name="phone" value="{{ old('phone', $c?->phone) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.email') }} <span class="text-danger">*</span></label>
        <input type="email" name="email" value="{{ old('email', $c?->email) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.national_id') }} <span class="text-danger">*</span></label>
        <input type="text" name="national_id" value="{{ old('national_id', $c?->national_id) }}" class="form-control" required>
        @if (! $c)
            <div class="form-text">{{ __('app.labels.national_id_password_hint') }}</div>
        @endif
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
