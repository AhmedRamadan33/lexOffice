@php $m = $teamMember ?? null; @endphp

<div class="mb-3">
    <label class="form-label">{{ __('app.labels.photo') }}</label>
    @if ($m?->hasMedia('photo'))
        <div class="mb-2">
            <img src="{{ $m->getFirstMediaUrl('photo') }}" class="rounded" style="width:80px;height:80px;object-fit:cover;">
        </div>
    @endif
    <input type="file" name="photo" class="form-control" accept="image/*">
</div>

<x-language-tabs id="team-member-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="name[ar]" value="{{ old('name.ar', $m?->getTranslationWithoutFallback('name', 'ar')) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="title[ar]" value="{{ old('title.ar', $m?->getTranslationWithoutFallback('title', 'ar')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.bio') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="bio[ar]" class="form-control" rows="3">{{ old('bio.ar', $m?->getTranslationWithoutFallback('bio', 'ar')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.specialties') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="specialties[ar]" class="form-control" rows="4" placeholder="سطر لكل تخصص">{{ old('specialties.ar', $m?->getTranslationWithoutFallback('specialties', 'ar')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.education') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="education[ar]" class="form-control" rows="4" placeholder="سطر لكل مؤهل">{{ old('education.ar', $m?->getTranslationWithoutFallback('education', 'ar')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.experience') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="experience[ar]" class="form-control" rows="4" placeholder="سطر لكل خبرة">{{ old('experience.ar', $m?->getTranslationWithoutFallback('experience', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="name[en]" value="{{ old('name.en', $m?->getTranslationWithoutFallback('name', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="title[en]" value="{{ old('title.en', $m?->getTranslationWithoutFallback('title', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.bio') }} ({{ __('app.labels.english') }})</label>
            <textarea name="bio[en]" class="form-control" rows="3">{{ old('bio.en', $m?->getTranslationWithoutFallback('bio', 'en')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.specialties') }} ({{ __('app.labels.english') }})</label>
            <textarea name="specialties[en]" class="form-control" rows="4" placeholder="One specialty per line">{{ old('specialties.en', $m?->getTranslationWithoutFallback('specialties', 'en')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.education') }} ({{ __('app.labels.english') }})</label>
            <textarea name="education[en]" class="form-control" rows="4" placeholder="One item per line">{{ old('education.en', $m?->getTranslationWithoutFallback('education', 'en')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.experience') }} ({{ __('app.labels.english') }})</label>
            <textarea name="experience[en]" class="form-control" rows="4" placeholder="One item per line">{{ old('experience.en', $m?->getTranslationWithoutFallback('experience', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="row g-3">
    <div class="col-md-3">
        <label class="form-label">{{ __('app.labels.category') }}</label>
        <input type="text" name="category" value="{{ old('category', $m?->category) }}" class="form-control" placeholder="corporate">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.labels.phone') }}</label>
        <input type="text" name="phone" value="{{ old('phone', $m?->phone) }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.labels.email') }}</label>
        <input type="email" name="email" value="{{ old('email', $m?->email) }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.labels.sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $m?->sort_order ?? 0) }}" class="form-control" min="0">
    </div>
</div>
<div class="d-flex gap-4 mt-3">
    <div class="form-check">
        <input type="checkbox" name="is_featured" value="1" id="is_featured" class="form-check-input" @checked(old('is_featured', $m?->is_featured))>
        <label for="is_featured" class="form-check-label">{{ __('app.labels.is_featured') }}</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" @checked(old('is_active', $m?->is_active ?? true))>
        <label for="is_active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('team-members.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
