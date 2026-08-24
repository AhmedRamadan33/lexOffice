@php $t = $testimonial ?? null; @endphp

<div class="mb-3">
    <label class="form-label">{{ __('app.labels.photo') }}</label>
    @if ($t?->hasMedia('photo'))
        <div class="mb-2">
            <img src="{{ $t->getFirstMediaUrl('photo') }}" class="rounded-circle" style="width:70px;height:70px;object-fit:cover;">
        </div>
    @endif
    <input type="file" name="photo" class="form-control" accept="image/*">
</div>

<x-language-tabs id="testimonial-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.client_name') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="client_name[ar]" value="{{ old('client_name.ar', $t?->getTranslationWithoutFallback('client_name', 'ar')) }}" class="form-control" required>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.quote') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <textarea name="quote[ar]" class="form-control" rows="3" required>{{ old('quote.ar', $t?->getTranslationWithoutFallback('quote', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.client_name') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="client_name[en]" value="{{ old('client_name.en', $t?->getTranslationWithoutFallback('client_name', 'en')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.quote') }} ({{ __('app.labels.english') }})</label>
            <textarea name="quote[en]" class="form-control" rows="3">{{ old('quote.en', $t?->getTranslationWithoutFallback('quote', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.rating') }} <span class="text-danger">*</span></label>
        <select name="rating" class="form-select" required>
            @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" @selected((int) old('rating', $t?->rating ?? 5) === $i)>{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $t?->sort_order ?? 0) }}" class="form-control" min="0">
    </div>
</div>
<div class="form-check mt-3">
    <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" @checked(old('is_active', $t?->is_active ?? true))>
    <label for="is_active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('testimonials.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
