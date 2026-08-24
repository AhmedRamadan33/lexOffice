<x-app-layout :title="__('app.nav.courts')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.courts') }}</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courtModal" onclick="openCourtModal()">
            <i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}
        </button>
    </div>

    <x-table-filters :action="route('courts.index')" :placeholder="__('app.labels.name')">
        <select name="is_active" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_active') }}</option>
            <option value="1" @selected(request('is_active') === '1')>{{ __('app.labels.is_active') }}</option>
            <option value="0" @selected(request('is_active') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$courts">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.labels.type') }}</th>
                    <th>{{ __('app.labels.is_active') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courts as $court)
                    <tr>
                        <td class="fw-semibold">{{ $court->name }}</td>
                        <td class="cell-muted">{{ $court->type ?? '-' }}</td>
                        <td>{{ $court->is_active ? '✓' : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal" data-bs-target="#courtModal"
                                onclick='openCourtModal(@json($court))'>
                                <i class="bi bi-pencil"></i>
                            </button>
                            <x-delete-button :action="route('courts.destroy', $court)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="4" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>

    <div class="modal fade" id="courtModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="courtForm" class="modal-content">
                @csrf
                <input type="hidden" name="_method" id="court-method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.nav.courts') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.arabic') }})</label>
                        <input type="text" name="name[ar]" id="court-name-ar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.name') }} ({{ __('app.labels.english') }})</label>
                        <input type="text" name="name[en]" id="court-name-en" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.type') }} ({{ __('app.labels.arabic') }})</label>
                        <input type="text" name="type[ar]" id="court-type-ar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.type') }} ({{ __('app.labels.english') }})</label>
                        <input type="text" name="type[en]" id="court-type-en" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.address') }} ({{ __('app.labels.arabic') }})</label>
                        <input type="text" name="address[ar]" id="court-address-ar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('app.labels.address') }} ({{ __('app.labels.english') }})</label>
                        <input type="text" name="address[en]" id="court-address-en" class="form-control">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" id="court-active" class="form-check-input" checked>
                        <label for="court-active" class="form-check-label">{{ __('app.labels.is_active') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCourtModal(court) {
            const form = document.getElementById('courtForm');
            form.action = court ? `{{ url('courts') }}/${court.id}` : `{{ route('courts.store') }}`;
            document.getElementById('court-method').value = court ? 'PUT' : 'POST';
            document.getElementById('court-name-ar').value = court ? (court.name?.ar ?? '') : '';
            document.getElementById('court-name-en').value = court ? (court.name?.en ?? '') : '';
            document.getElementById('court-type-ar').value = court ? (court.type?.ar ?? '') : '';
            document.getElementById('court-type-en').value = court ? (court.type?.en ?? '') : '';
            document.getElementById('court-address-ar').value = court ? (court.address?.ar ?? '') : '';
            document.getElementById('court-address-en').value = court ? (court.address?.en ?? '') : '';
            document.getElementById('court-active').checked = court ? !!court.is_active : true;
        }
    </script>
</x-app-layout>
