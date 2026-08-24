@php $p = $practiceArea ?? null; @endphp

<div class="mb-3">
    <label class="form-label">{{ __('app.labels.icon') }} <span class="text-danger">*</span></label>
    <input type="text" name="icon" value="{{ old('icon', $p?->icon) }}" class="form-control" placeholder="bi-briefcase" required>
    <div class="form-text">{{ __('app.labels.icon') }}: <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener">Bootstrap Icons</a> — e.g. bi-briefcase, bi-bank, bi-people</div>
</div>

<x-language-tabs id="practice-area-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="title[ar]" value="{{ old('title.ar', $p?->getTranslationWithoutFallback('title', 'ar')) }}" class="form-control" required>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.description') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="description[ar]" class="form-control" rows="3">{{ old('description.ar', $p?->getTranslationWithoutFallback('description', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="title[en]" value="{{ old('title.en', $p?->getTranslationWithoutFallback('title', 'en')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.description') }} ({{ __('app.labels.english') }})</label>
            <textarea name="description[en]" class="form-control" rows="3">{{ old('description.en', $p?->getTranslationWithoutFallback('description', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $p?->sort_order ?? 0) }}" class="form-control" min="0">
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" @checked(old('is_active', $p?->is_active ?? true))>
            <label for="is_active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
        </div>
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('practice-areas.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
