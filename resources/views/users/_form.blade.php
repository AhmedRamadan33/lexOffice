@php $u = $user ?? null; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
        <input type="text" name="name[ar]" value="{{ old('name.ar', $u?->getTranslationWithoutFallback('name', 'ar')) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.english') }})</label>
        <input type="text" name="name[en]" value="{{ old('name.en', $u?->getTranslationWithoutFallback('name', 'en')) }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.email') }} <span class="text-danger">*</span></label>
        <input type="email" name="email" value="{{ old('email', $u?->email) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.phone') }}</label>
        <input type="text" name="phone" value="{{ old('phone', $u?->phone) }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.password') }} @if(!$u)<span class="text-danger">*</span>@endif</label>
        <input type="password" name="password" class="form-control" @if(!$u) required @endif>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.branch') }} <span class="text-danger">*</span></label>
        <select name="branch_id" class="form-select" required>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}" @selected(old('branch_id', $u?->branch_id) == $branch->id)>{{ $branch->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.role') }} <span class="text-danger">*</span></label>
        <select name="role" class="form-select" required>
            <option value="">-</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" @selected(old('role', $u?->roles?->first()?->name) === $role->name)>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" @checked(old('is_active', $u?->is_active ?? true))>
            <label for="is_active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
        </div>
    </div>
</div>

<hr class="my-4">

<h6 class="mb-3">{{ __('app.labels.team_profile') }}</h6>

<div class="mb-3">
    <label class="form-label">{{ __('app.labels.photo') }}</label>
    @if ($u?->hasMedia('photo'))
        <div class="mb-2">
            <img src="{{ $u->getFirstMediaUrl('photo') }}" class="rounded" style="width:80px;height:80px;object-fit:cover;">
        </div>
    @endif
    <input type="file" name="photo" class="form-control" accept="image/*">
</div>

<x-language-tabs id="user-team-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="title[ar]" value="{{ old('title.ar', $u?->getTranslationWithoutFallback('title', 'ar')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.bio') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="bio[ar]" class="form-control" rows="3">{{ old('bio.ar', $u?->getTranslationWithoutFallback('bio', 'ar')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.specialties') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="specialties[ar]" class="form-control" rows="4" placeholder="سطر لكل تخصص">{{ old('specialties.ar', $u?->getTranslationWithoutFallback('specialties', 'ar')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.education') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="education[ar]" class="form-control" rows="4" placeholder="سطر لكل مؤهل">{{ old('education.ar', $u?->getTranslationWithoutFallback('education', 'ar')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.experience') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="experience[ar]" class="form-control" rows="4" placeholder="سطر لكل خبرة">{{ old('experience.ar', $u?->getTranslationWithoutFallback('experience', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="title[en]" value="{{ old('title.en', $u?->getTranslationWithoutFallback('title', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.bio') }} ({{ __('app.labels.english') }})</label>
            <textarea name="bio[en]" class="form-control" rows="3">{{ old('bio.en', $u?->getTranslationWithoutFallback('bio', 'en')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.specialties') }} ({{ __('app.labels.english') }})</label>
            <textarea name="specialties[en]" class="form-control" rows="4" placeholder="One specialty per line">{{ old('specialties.en', $u?->getTranslationWithoutFallback('specialties', 'en')) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.education') }} ({{ __('app.labels.english') }})</label>
            <textarea name="education[en]" class="form-control" rows="4" placeholder="One item per line">{{ old('education.en', $u?->getTranslationWithoutFallback('education', 'en')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.experience') }} ({{ __('app.labels.english') }})</label>
            <textarea name="experience[en]" class="form-control" rows="4" placeholder="One item per line">{{ old('experience.en', $u?->getTranslationWithoutFallback('experience', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.category') }}</label>
        <select name="category" class="form-select">
            <option value="">-</option>
            <option value="partners" @selected(old('category', $u?->category) === 'partners')>{{ __('app.public.team.categories.partners') }}</option>
            <option value="lawyers" @selected(old('category', $u?->category) === 'lawyers')>{{ __('app.public.team.categories.lawyers') }}</option>
            <option value="admin_staff" @selected(old('category', $u?->category) === 'admin_staff')>{{ __('app.public.team.categories.admin_staff') }}</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.sort_order') }}</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $u?->sort_order ?? 0) }}" class="form-control" min="0">
    </div>
</div>
<div class="form-check mt-3">
    <input type="checkbox" name="is_team_visible" value="1" id="is_team_visible" class="form-check-input" @checked(old('is_team_visible', $u?->is_team_visible))>
    <label for="is_team_visible" class="form-check-label">{{ __('app.labels.is_team_visible') }}</label>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
