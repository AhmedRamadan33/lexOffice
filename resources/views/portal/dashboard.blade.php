<x-portal-layout :title="__('app.portal.nav.dashboard')">
    <section class="pub-section py-4">
        <div class="container">
            <h4 class="mb-4" style="color:var(--pub-navy);">{{ __('app.portal.dashboard.welcome', ['name' => auth('client')->user()->name]) }}</h4>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="pub-detail-card pub-stat">
                        <div class="pub-stat-value">{{ $stats['open_cases'] }}</div>
                        <div class="pub-stat-label">{{ __('app.portal.dashboard.open_cases') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pub-detail-card pub-stat">
                        <div class="pub-stat-value">{{ $stats['upcoming_sessions'] }}</div>
                        <div class="pub-stat-label">{{ __('app.portal.dashboard.upcoming_sessions') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pub-detail-card pub-stat">
                        <div class="pub-stat-value">{{ $stats['unpaid_invoices'] }}</div>
                        <div class="pub-stat-label">{{ __('app.portal.dashboard.unpaid_invoices') }}</div>
                    </div>
                </div>
            </div>

            <div class="pub-detail-card">
                <h6><i class="bi bi-calendar-event text-warning"></i>{{ __('app.portal.dashboard.upcoming_sessions_title') }}</h6>
                @forelse ($upcomingSessions as $session)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <a href="{{ route('portal.cases.show', $session->case) }}" class="fw-semibold text-decoration-none">{{ $session->case->case_number }}</a>
                            <div class="text-muted small">{{ $session->case->subject }}</div>
                        </div>
                        <div class="text-end">
                            <div class="fw-semibold">{{ $session->session_date->format('Y-m-d') }}</div>
                            <x-status-badge :status="$session->status" />
                        </div>
                    </div>
                @empty
                    <p class="text-muted small mb-0 mt-2">{{ __('app.messages.no_results') }}</p>
                @endforelse
            </div>
        </div>
    </section>
</x-portal-layout>
