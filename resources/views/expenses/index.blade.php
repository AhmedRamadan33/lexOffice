<x-app-layout :title="__('app.nav.expenses')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.expenses') }}</h4>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('expenses.index')" :placeholder="__('app.labels.category').' / '.__('app.labels.description')" />

    <x-table-card :paginator="$expenses">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.expense_date') }}</th>
                    <th>{{ __('app.labels.category') }}</th>
                    <th class="text-end">{{ __('app.labels.amount') }}</th>
                    <th>{{ __('app.labels.description') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->expense_date->format('Y-m-d') }}</td>
                        <td class="fw-semibold">{{ $expense->category }}</td>
                        <td class="cell-num">{{ number_format($expense->amount, 2) }}</td>
                        <td class="cell-muted">{{ \Illuminate\Support\Str::limit($expense->description, 50) }}</td>
                        <td class="text-end">
                            <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('expenses.destroy', $expense)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="5" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
