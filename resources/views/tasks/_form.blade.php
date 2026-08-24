@php $t = $task ?? null; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.case') }}</label>
        <select name="case_id" class="form-select">
            <option value="">-</option>
            @foreach ($cases as $case)
                <option value="{{ $case->id }}" @selected(old('case_id', $t?->case_id) == $case->id)>{{ $case->case_number }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.assigned_to') }} <span class="text-danger">*</span></label>
        <select name="assigned_to" class="form-select" required>
            <option value="">-</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('assigned_to', $t?->assigned_to) == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.labels.due_date') }}</label>
        <input type="date" name="due_date" value="{{ old('due_date', $t?->due_date?->format('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.labels.status') }}</label>
        <select name="status" class="form-select">
            @foreach (['pending', 'in_progress', 'done'] as $status)
                <option value="{{ $status }}" @selected(old('status', $t?->status ?? 'pending') === $status)>{{ __('app.status.'.$status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.labels.priority') }}</label>
        <select name="priority" class="form-select">
            @foreach (['low', 'normal', 'high'] as $priority)
                <option value="{{ $priority }}" @selected(old('priority', $t?->priority ?? 'normal') === $priority)>{{ __('app.status.'.$priority) }}</option>
            @endforeach
        </select>
    </div>
</div>

<x-language-tabs id="task-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.arabic') }}) <span class="text-danger">*</span></label>
            <input type="text" name="title[ar]" value="{{ old('title.ar', $t?->getTranslationWithoutFallback('title', 'ar')) }}" class="form-control" required>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.description') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="description[ar]" rows="3" class="form-control">{{ old('description.ar', $t?->getTranslationWithoutFallback('description', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.title') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="title[en]" value="{{ old('title.en', $t?->getTranslationWithoutFallback('title', 'en')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.description') }} ({{ __('app.labels.english') }})</label>
            <textarea name="description[en]" rows="3" class="form-control">{{ old('description.en', $t?->getTranslationWithoutFallback('description', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
