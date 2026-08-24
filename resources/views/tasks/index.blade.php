<x-app-layout :title="__('app.nav.tasks')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.tasks') }}</h4>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('tasks.index')" :placeholder="__('app.labels.title')">
        <select name="status" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.status') }}</option>
            @foreach (['pending', 'in_progress', 'done'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ __('app.status.'.$status) }}</option>
            @endforeach
        </select>
        <select name="priority" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.priority') }}</option>
            @foreach (['low', 'normal', 'high'] as $priority)
                <option value="{{ $priority }}" @selected(request('priority') === $priority)>{{ __('app.status.'.$priority) }}</option>
            @endforeach
        </select>
        <select name="assigned_to" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.assigned_to') }}</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected((int) request('assigned_to') === $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </x-table-filters>

    <x-table-card :paginator="$tasks">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.title') }}</th>
                    <th>{{ __('app.labels.case') }}</th>
                    <th>{{ __('app.labels.assigned_to') }}</th>
                    <th>{{ __('app.labels.due_date_short') }}</th>
                    <th>{{ __('app.labels.priority') }}</th>
                    <th>{{ __('app.labels.status') }}</th>
                    <th class="text-end">{{ __('app.actions.edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td class="fw-semibold">{{ $task->title }}</td>
                        <td class="cell-muted">{{ $task->case?->case_number ?? '-' }}</td>
                        <td>{{ $task->assignee->name ?? '-' }}</td>
                        <td class="cell-muted">{{ $task->due_date?->format('Y-m-d') ?? '-' }}</td>
                        <td><x-status-badge :status="$task->priority" /></td>
                        <td><x-status-badge :status="$task->status" /></td>
                        <td class="text-end">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('tasks.destroy', $task)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="7" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
