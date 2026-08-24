<x-portal-layout :title="__('app.portal.cases.title')">
    <section class="pub-section py-4">
        <div class="container">
            <h4 class="mb-4" style="color:var(--pub-navy);">{{ __('app.portal.cases.title') }}</h4>

            <div class="row g-3">
                @forelse ($cases as $case)
                    <div class="col-md-6">
                        <a href="{{ route('portal.cases.show', $case) }}" class="pub-detail-card d-block text-decoration-none h-100">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="fw-bold" style="color:var(--pub-navy);">{{ $case->case_number }}</span>
                                <x-status-badge :status="$case->status" />
                            </div>
                            <p class="small text-muted mb-2">{{ $case->subject }}</p>
                            <div class="small text-muted">
                                <div>{{ __('app.labels.court') }}: {{ $case->court->name ?? '-' }}</div>
                                <div>{{ __('app.labels.assigned_lawyer') }}: {{ $case->assignedLawyer->name ?? '-' }}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">{{ __('app.portal.cases.empty') }}</div>
                @endforelse
            </div>
        </div>
    </section>
</x-portal-layout>
