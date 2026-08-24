<x-app-layout :title="__('app.nav.dashboard')">
    <h4 class="mb-4 fw-bold">{{ __('app.dashboard.welcome', ['name' => auth()->user()->name]) }}</h4>

    <div class="row g-3 mb-4">
        @can('manage-cases')
        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-primary-subtle text-primary"><i class="bi bi-folder-fill"></i></span>
                    <div>
                        <div class="stat-value">{{ $stats['open_cases'] }}</div>
                        <div class="stat-label">{{ __('app.dashboard.open_cases') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-info-subtle text-info"><i class="bi bi-calendar-event-fill"></i></span>
                    <div>
                        <div class="stat-value">{{ $stats['today_sessions'] }}</div>
                        <div class="stat-label">{{ __('app.dashboard.today_sessions') }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('manage-clients')
        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-success-subtle text-success"><i class="bi bi-people-fill"></i></span>
                    <div>
                        <div class="stat-value">{{ $stats['total_clients'] }}</div>
                        <div class="stat-label">{{ __('app.dashboard.total_clients') }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('manage-invoices')
        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-danger-subtle text-danger"><i class="bi bi-receipt"></i></span>
                    <div>
                        <div class="stat-value">{{ $stats['unpaid_invoices'] }}</div>
                        <div class="stat-label">{{ __('app.dashboard.unpaid_invoices') }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @can('manage-tasks')
        <div class="col-6 col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-warning-subtle text-warning"><i class="bi bi-check2-square"></i></span>
                    <div>
                        <div class="stat-value">{{ $stats['overdue_tasks'] }}</div>
                        <div class="stat-label">{{ __('app.dashboard.overdue_tasks') }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>

    <div class="row g-3">
        @can('manage-cases')
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-header bg-white fw-bold border-0 pt-3">{{ __('app.dashboard.upcoming_sessions') }}</div>
                <ul class="list-group list-group-flush">
                    @forelse ($upcomingSessions as $session)
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-top">
                            <div>
                                <div class="fw-semibold">{{ $session->case->case_number }}</div>
                                <div class="small text-secondary">{{ $session->case->client->name ?? '' }}</div>
                            </div>
                            <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis">{{ $session->session_date->format('Y-m-d') }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-secondary border-0 border-top">{{ __('app.messages.no_results') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
        @endcan
        @can('manage-tasks')
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-header bg-white fw-bold border-0 pt-3">{{ __('app.nav.tasks') }}</div>
                <ul class="list-group list-group-flush">
                    @forelse ($myTasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-top">
                            <div>{{ $task->title }}</div>
                            <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">{{ $task->due_date?->format('Y-m-d') }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-secondary border-0 border-top">{{ __('app.messages.no_results') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
        @endcan
    </div>
</x-app-layout>
