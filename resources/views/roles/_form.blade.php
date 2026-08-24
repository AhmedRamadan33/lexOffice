@php $r = $role ?? null; $selected = old('permissions', $r?->permissions?->pluck('name')->toArray() ?? []); @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.name') }} <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $r?->name) }}" class="form-control" required>
    </div>
    <div class="col-12">
        <label class="form-label">{{ __('app.labels.permissions') }}</label>
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm-{{ $permission->id }}" class="form-check-input" @checked(in_array($permission->name, $selected))>
                        <label for="perm-{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
