@php $s = $session ?? null; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.session_date') }} <span class="text-danger">*</span></label>
        <input type="date" name="session_date" value="{{ old('session_date', $s?->session_date?->format('Y-m-d')) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.session_time') }}</label>
        <input type="time" name="session_time" value="{{ old('session_time', $s?->session_time) }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.court') }}</label>
        <select name="court_id" class="form-select">
            <option value="">-</option>
            @foreach ($courts as $court)
                <option value="{{ $court->id }}" @selected(old('court_id', $s?->court_id) == $court->id)>{{ $court->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.status') }}</label>
        <select name="status" class="form-select">
            @foreach (['scheduled', 'held', 'postponed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $s?->status ?? 'scheduled') === $status)>{{ __('app.status.'.$status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.next_session_date') }}</label>
        <input type="date" name="next_session_date" value="{{ old('next_session_date', $s?->next_session_date?->format('Y-m-d')) }}" class="form-control">
    </div>
</div>

<x-language-tabs id="session-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.judge_name') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="judge_name[ar]" value="{{ old('judge_name.ar', $s?->getTranslationWithoutFallback('judge_name', 'ar')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.decision') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="decision[ar]" rows="2" class="form-control">{{ old('decision.ar', $s?->getTranslationWithoutFallback('decision', 'ar')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="notes[ar]" rows="2" class="form-control">{{ old('notes.ar', $s?->getTranslationWithoutFallback('notes', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.judge_name') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="judge_name[en]" value="{{ old('judge_name.en', $s?->getTranslationWithoutFallback('judge_name', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.decision') }} ({{ __('app.labels.english') }})</label>
            <textarea name="decision[en]" rows="2" class="form-control">{{ old('decision.en', $s?->getTranslationWithoutFallback('decision', 'en')) }}</textarea>
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.english') }})</label>
            <textarea name="notes[en]" rows="2" class="form-control">{{ old('notes.en', $s?->getTranslationWithoutFallback('notes', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('cases.show', $case) }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
