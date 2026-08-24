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
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
