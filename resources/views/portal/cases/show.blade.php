<x-portal-layout :title="$case->case_number">
    <section class="pub-section py-4">
        <div class="container">
            <a href="{{ route('portal.cases.index') }}" class="text-decoration-none small text-muted d-inline-block mb-3">
                <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>{{ __('app.portal.cases.back') }}
            </a>

            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="mb-1" style="color:var(--pub-navy);">{{ $case->case_number }}</h4>
                    <span class="text-muted">{{ $case->subject }}</span>
                </div>
                <x-status-badge :status="$case->status" />
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.court') }}</div><div class="fw-semibold">{{ $case->court->name ?? '-' }}</div></div></div>
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.case_type') }}</div><div class="fw-semibold">{{ $case->caseType->name ?? '-' }}</div></div></div>
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.assigned_lawyer') }}</div><div class="fw-semibold">{{ $case->assignedLawyer->name ?? '-' }}</div></div></div>
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.start_date') }}</div><div class="fw-semibold">{{ $case->start_date?->format('Y-m-d') ?? '-' }}</div></div></div>
            </div>

            <div class="row g-3">
                <div class="col-lg-7">
                    <div class="pub-detail-card">
                        <h6><i class="bi bi-calendar-event text-warning"></i>{{ __('app.portal.cases.sessions_title') }}</h6>
                        @forelse ($case->sessions as $session)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">{{ $session->session_date->format('Y-m-d') }} @if ($session->session_time) - {{ $session->session_time }} @endif</div>
                                    @if ($session->judge_name)
                                        <div class="small text-muted">{{ __('app.labels.judge_name') }}: {{ $session->judge_name }}</div>
                                    @endif
                                    @if ($session->decision)
                                        <div class="small text-muted">{{ __('app.labels.decision') }}: {{ $session->decision }}</div>
                                    @endif
                                </div>
                                <x-status-badge :status="$session->status" />
                            </div>
                        @empty
                            <p class="text-muted small mb-0 mt-2">{{ __('app.messages.no_results') }}</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="pub-detail-card">
                        <h6><i class="bi bi-file-earmark-text text-warning"></i>{{ __('app.portal.cases.documents_title') }}</h6>
                        @forelse ($documents as $media)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <a href="{{ $media->getUrl() }}" target="_blank" class="text-truncate" style="max-width:220px;">{{ $media->file_name }}</a>
                                <i class="bi bi-download text-muted"></i>
                            </div>
                        @empty
                            <p class="text-muted small mb-0 mt-2">{{ __('app.messages.no_results') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-portal-layout>
