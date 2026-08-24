<x-app-layout :title="__('app.nav.team_members')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.team_members') }}</h4>
        <a href="{{ route('team-members.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('team-members.index')" :placeholder="__('app.labels.name')">
        <select name="is_active" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_active') }}</option>
            <option value="1" @selected(request('is_active') === '1')>{{ __('app.labels.is_active') }}</option>
            <option value="0" @selected(request('is_active') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$teamMembers">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.labels.title') }}</th>
                    <th>{{ __('app.labels.category') }}</th>
                    <th>{{ __('app.labels.is_featured') }}</th>
                    <th>{{ __('app.labels.is_active') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teamMembers as $teamMember)
                    <tr>
                        <td>
                            @if ($teamMember->hasMedia('photo'))
                                <img src="{{ $teamMember->getFirstMediaUrl('photo') }}" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;">
                            @else
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary fw-bold" style="width:36px;height:36px;">{{ mb_substr($teamMember->name, 0, 1) }}</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $teamMember->name }}</td>
                        <td class="cell-muted">{{ $teamMember->title }}</td>
                        <td>{{ $teamMember->category ?? '-' }}</td>
                        <td>{{ $teamMember->is_featured ? '✓' : '-' }}</td>
                        <td>{{ $teamMember->is_active ? '✓' : '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('team-members.edit', $teamMember) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('team-members.destroy', $teamMember)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="7" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
