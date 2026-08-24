<x-app-layout :title="__('app.nav.clients')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.clients') }}</h4>
        <a href="{{ route('clients.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('clients.index')" :placeholder="__('app.labels.name').' / '.__('app.labels.phone')">
        <select name="type" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.type') }}</option>
            <option value="individual" @selected(request('type') === 'individual')>{{ __('app.labels.individual') }}</option>
            <option value="company" @selected(request('type') === 'company')>{{ __('app.labels.company') }}</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$clients">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.labels.type') }}</th>
                    <th>{{ __('app.labels.phone') }}</th>
                    <th>{{ __('app.labels.email') }}</th>
                    <th class="text-end">{{ __('app.actions.edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td>
                            <a href="{{ route('clients.show', $client) }}" class="d-flex align-items-center gap-2 text-decoration-none">
                                <span class="row-avatar">{{ mb_substr($client->name, 0, 1) }}</span>
                                <span class="fw-semibold">{{ $client->name }}</span>
                            </a>
                        </td>
                        <td>{{ __('app.labels.'.$client->type) }}</td>
                        <td>{{ $client->phone ?? '-' }}</td>
                        <td class="cell-muted">{{ $client->email ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('clients.destroy', $client)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="5" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
