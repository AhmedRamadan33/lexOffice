<x-app-layout :title="__('app.nav.case_types')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.case_types') }}</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#typeModal" onclick="openTypeModal()">
            <i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}
        </button>
    </div>

    <x-table-filters :action="route('case-types.index')" :placeholder="__('app.labels.name')">
        <select name="is_active" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_active') }}</option>
            <option value="1" @selected(request('is_active') === '1')>{{ __('app.labels.is_active') }}</option>
            <option value="0" @selected(request('is_active') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$caseTypes">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.labels.is_active') }}</th>
                    <th class="text-end">{{ __('app.actions.edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($caseTypes as $type)
                    <tr>
                        <td class="fw-semibold">{{ $type->name }}</td>
                        <td>{{ $type->is_active ? '✓' : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal" data-bs-target="#typeModal"
                                onclick='openTypeModal(@json($type))'>
                                <i class="bi bi-pencil"></i>
                            </button>
                            <x-delete-button :action="route('case-types.destroy', $type)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="3" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>

    <div class="modal fade" id="typeModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="typeForm" class="modal-content">
                @csrf
                <input type="hidden" name="_method" id="type-method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.nav.case_types') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.arabic') }})</label>
                        <input type="text" name="name[ar]" id="type-name-ar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.english') }})</label>
                        <input type="text" name="name[en]" id="type-name-en" class="form-control">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" id="type-active" class="form-check-input" checked>
                        <label for="type-active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openTypeModal(type) {
            const form = document.getElementById('typeForm');
            form.action = type ? `{{ url('case-types') }}/${type.id}` : `{{ route('case-types.store') }}`;
            document.getElementById('type-method').value = type ? 'PUT' : 'POST';
            document.getElementById('type-name-ar').value = type ? (type.name?.ar ?? '') : '';
            document.getElementById('type-name-en').value = type ? (type.name?.en ?? '') : '';
            document.getElementById('type-active').checked = type ? !!type.is_active : true;
        }
    </script>
</x-app-layout>
