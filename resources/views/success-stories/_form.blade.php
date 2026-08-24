@php $s = $story ?? null; @endphp

<div class="mb-3">
    <label class="form-label">{{ __('app.labels.image') }}</label>
    @if ($s?->hasMedia('image'))
        <div class="mb-2">
            <img src="{{ $s->getFirstMediaUrl('image') }}" class="rounded" style="width:140px;height:90px;object-fit:cover;">
        </div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/*">
</div>

<x-language-tabs id="success-story-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="title[ar]" value="{{ old('title.ar', $s?->getTranslationWithoutFallback('title', 'ar')) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.category') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="category[ar]" value="{{ old('category.ar', $s?->getTranslationWithoutFallback('category', 'ar')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.excerpt') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="excerpt[ar]" class="form-control" rows="2">{{ old('excerpt.ar', $s?->getTranslationWithoutFallback('excerpt', 'ar')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.body') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="body[ar]" class="form-control" rows="5">{{ old('body.ar', $s?->getTranslationWithoutFallback('body', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="title[en]" value="{{ old('title.en', $s?->getTranslationWithoutFallback('title', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.category') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="category[en]" value="{{ old('category.en', $s?->getTranslationWithoutFallback('category', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.excerpt') }} ({{ __('app.labels.english') }})</label>
            <textarea name="excerpt[en]" class="form-control" rows="2">{{ old('excerpt.en', $s?->getTranslationWithoutFallback('excerpt', 'en')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.body') }} ({{ __('app.labels.english') }})</label>
            <textarea name="body[en]" class="form-control" rows="5">{{ old('body.en', $s?->getTranslationWithoutFallback('body', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.story_date') }}</label>
        <input type="date" name="story_date" value="{{ old('story_date', $s?->story_date?->format('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $s?->sort_order ?? 0) }}" class="form-control" min="0">
    </div>
</div>
<div class="form-check mt-3">
    <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" @checked(old('is_active', $s?->is_active ?? true))>
    <label for="is_active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('success-stories.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
