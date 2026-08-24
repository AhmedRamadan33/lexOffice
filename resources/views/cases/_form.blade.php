@php $cs = $case ?? null; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.client') }} <span class="text-danger">*</span></label>
        <select name="client_id" class="form-select" required>
            <option value="">-</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}" @selected(old('client_id', $cs?->client_id) == $client->id)>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.status') }}</label>
        <select name="status" class="form-select">
            @foreach (['open', 'pending', 'closed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $cs?->status ?? 'open') === $status)>{{ __('app.status.'.$status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.court') }}</label>
        <select name="court_id" class="form-select">
            <option value="">-</option>
            @foreach ($courts as $court)
                <option value="{{ $court->id }}" @selected(old('court_id', $cs?->court_id) == $court->id)>{{ $court->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.case_type') }}</label>
        <select name="case_type_id" class="form-select">
            <option value="">-</option>
            @foreach ($caseTypes as $type)
                <option value="{{ $type->id }}" @selected(old('case_type_id', $cs?->case_type_id) == $type->id)>{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.assigned_lawyer') }}</label>
        <select name="assigned_lawyer_id" class="form-select">
            <option value="">-</option>
            @foreach ($lawyers as $lawyer)
                <option value="{{ $lawyer->id }}" @selected(old('assigned_lawyer_id', $cs?->assigned_lawyer_id) == $lawyer->id)>{{ $lawyer->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.start_date') }}</label>
        <input type="date" name="start_date" value="{{ old('start_date', $cs?->start_date?->format('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.labels.opponent_phone') }}</label>
        <input type="text" name="opponent_phone" value="{{ old('opponent_phone', $cs?->opponent_phone) }}" class="form-control">
    </div>
</div>

<x-language-tabs id="case-lang">
    <x-slot:ar>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.subject') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="subject[ar]" value="{{ old('subject.ar', $cs?->getTranslationWithoutFallback('subject', 'ar')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.opponent_name') }} ({{ __('app.labels.arabic') }})</label>
            <input type="text" name="opponent_name[ar]" value="{{ old('opponent_name.ar', $cs?->getTranslationWithoutFallback('opponent_name', 'ar')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.arabic') }})</label>
            <textarea name="notes[ar]" rows="3" class="form-control">{{ old('notes.ar', $cs?->getTranslationWithoutFallback('notes', 'ar')) }}</textarea>
        </div>
    </x-slot:ar>
    <x-slot:en>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.subject') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="subject[en]" value="{{ old('subject.en', $cs?->getTranslationWithoutFallback('subject', 'en')) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('app.labels.opponent_name') }} ({{ __('app.labels.english') }})</label>
            <input type="text" name="opponent_name[en]" value="{{ old('opponent_name.en', $cs?->getTranslationWithoutFallback('opponent_name', 'en')) }}" class="form-control">
        </div>
        <div>
            <label class="form-label">{{ __('app.labels.notes') }} ({{ __('app.labels.english') }})</label>
            <textarea name="notes[en]" rows="3" class="form-control">{{ old('notes.en', $cs?->getTranslationWithoutFallback('notes', 'en')) }}</textarea>
        </div>
    </x-slot:en>
</x-language-tabs>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
    <a href="{{ route('cases.index') }}" class="btn btn-outline-secondary">{{ __('app.actions.cancel') }}</a>
</div>
