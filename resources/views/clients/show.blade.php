<x-app-layout :title="$client->name">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h4 class="mb-0">{{ $client->name }}</h4>
            <span class="text-secondary">{{ __('app.labels.'.$client->type) }}</span>
        </div>
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-outline-secondary"><i class="bi bi-pencil me-1"></i>{{ __('app.actions.edit') }}</a>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header fw-semibold">{{ __('app.labels.name') }}</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.phone') }}</span><span>{{ $client->phone ?? '-' }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.email') }}</span><span>{{ $client->email ?? '-' }}</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.national_id') }}</span><span>{{ $client->national_id ?? '-' }}</span></li>
                    <li class="list-group-item"><span class="text-secondary d-block mb-1">{{ __('app.labels.address') }}</span>{{ $client->address ?? '-' }}</li>
                    @if ($client->notes)
                        <li class="list-group-item"><span class="text-secondary d-block mb-1">{{ __('app.labels.notes') }}</span>{{ $client->notes }}</li>
                    @endif
                </ul>
            </div>

            <div class="card">
                <div class="card-header fw-semibold">{{ __('app.labels.documents') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('documents.store', ['client', $client->id]) }}" enctype="multipart/form-data" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" required>
                            <button class="btn btn-outline-primary" type="submit">{{ __('app.actions.upload') }}</button>
                        </div>
                    </form>
                    <ul class="list-group list-group-flush">
                        @forelse ($client->media as $media)
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
                <div class="card-header fw-semibold">{{ __('app.nav.cases') }}</div>
                <ul class="list-group list-group-flush">
                    @forelse ($client->cases as $case)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('cases.show', $case) }}">{{ $case->case_number }} - {{ $case->subject }}</a>
                            <x-status-badge :status="$case->status" />
                        </li>
                    @empty
                        <li class="list-group-item text-secondary">{{ __('app.messages.no_results') }}</li>
                    @endforelse
                </ul>
            </div>

            <div class="card">
                <div class="card-header fw-semibold">{{ __('app.nav.invoices') }}</div>
                <ul class="list-group list-group-flush">
                    @forelse ($client->invoices as $invoice)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->invoice_number }}</a>
                            <div>
                                <span class="me-2">{{ number_format($invoice->total, 2) }}</span>
                                <x-status-badge :status="$invoice->status" />
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-secondary">{{ __('app.messages.no_results') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
