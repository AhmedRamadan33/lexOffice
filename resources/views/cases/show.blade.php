<x-app-layout :title="$case->case_number">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h4 class="mb-0">{{ $case->case_number }} <x-status-badge :status="$case->status" /></h4>
            <span class="text-secondary">{{ $case->subject }}</span>
        </div>
        <a href="{{ route('cases.edit', $case) }}" class="btn btn-outline-secondary"><i class="bi bi-pencil me-1"></i>{{ __('app.actions.edit') }}</a>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header fw-semibold">{{ __('app.labels.case') }}</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.client') }}</span><a href="{{ route('clients.show', $case->client) }}">{{ $case->client->name ?? '-' }}</a></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.court') }}</span><span>{{ $case->court->name ?? '-' }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.case_type') }}</span><span>{{ $case->caseType->name ?? '-' }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.assigned_lawyer') }}</span><span>{{ $case->assignedLawyer->name ?? '-' }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.opponent_name') }}</span><span>{{ $case->opponent_name ?? '-' }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.start_date') }}</span><span>{{ $case->start_date?->format('Y-m-d') ?? '-' }}</span></li>
                    @if ($case->notes)
                        <li class="list-group-item"><span class="text-secondary d-block mb-1">{{ __('app.labels.notes') }}</span>{{ $case->notes }}</li>
                    @endif
                </ul>
            </div>

            <div class="card">
                <div class="card-header fw-semibold">{{ __('app.labels.documents') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('documents.store', ['case', $case->id]) }}" enctype="multipart/form-data" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" required>
                            <button class="btn btn-outline-primary" type="submit">{{ __('app.actions.upload') }}</button>
                        </div>
                    </form>
                    <ul class="list-group list-group-flush">
                        @forelse ($case->media as $media)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->file_name }}</a>
                                <x-delete-button :action="route('documents.destroy', $media)" />
                            </li>
                        @empty
                            <li class="list-group-item text-secondary">{{ __('app.messages.no_results') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">{{ __('app.nav.sessions') }}</span>
                    <a href="{{ route('cases.sessions.create', $case) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('app.labels.session_date') }}</th>
                                <th>{{ __('app.labels.judge_name') }}</th>
                                <th>{{ __('app.labels.status') }}</th>
                                <th>{{ __('app.labels.next_session_date') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($case->sessions as $session)
                                <tr>
                                    <td>{{ $session->session_date->format('Y-m-d') }}</td>
                                    <td>{{ $session->judge_name ?? '-' }}</td>
                                    <td><x-status-badge :status="$session->status" /></td>
                                    <td>{{ $session->next_session_date?->format('Y-m-d') ?? '-' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('cases.sessions.edit', [$case, $session]) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                                        <x-delete-button :action="route('cases.sessions.destroy', [$case, $session])" />
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-secondary py-4">{{ __('app.messages.no_results') }}</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header fw-semibold">{{ __('app.nav.invoices') }}</div>
                <ul class="list-group list-group-flush">
                    @forelse ($case->invoices as $invoice)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->invoice_number }}</a>
                            <x-status-badge :status="$invoice->status" />
                        </li>
                    @empty
                        <li class="list-group-item text-secondary">{{ __('app.messages.no_results') }}</li>
                    @endforelse
                </ul>
            </div>

            <div class="card">
                <div class="card-header fw-semibold">{{ __('app.nav.tasks') }}</div>
                <ul class="list-group list-group-flush">
                    @forelse ($case->tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $task->title }}</span>
                            <x-status-badge :status="$task->status" />
                        </li>
                    @empty
                        <li class="list-group-item text-secondary">{{ __('app.messages.no_results') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
