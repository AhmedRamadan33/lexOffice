<x-app-layout :title="__('app.nav.contact_messages')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.contact_messages') }}</h4>
    </div>

    <x-table-filters :action="route('contact-messages.index')" :placeholder="__('app.labels.name').' / '.__('app.labels.email')">
        <select name="is_read" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_read') }}</option>
            <option value="1" @selected(request('is_read') === '1')>{{ __('app.labels.is_read') }}</option>
            <option value="0" @selected(request('is_read') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$messages">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.created_at') }}</th>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.labels.email') }}</th>
                    <th>{{ __('app.labels.subject') }}</th>
                    <th>{{ __('app.labels.message') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="{{ ! $message->is_read ? 'fw-semibold' : '' }}">
                        <td class="cell-muted">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $message->name }}</td>
                        <td class="cell-muted">{{ $message->email }}</td>
                        <td>{{ $message->subject ?? '-' }}</td>
                        <td class="cell-muted">{{ \Illuminate\Support\Str::limit($message->message, 60) }}</td>
                        <td class="text-end">
                            @unless ($message->is_read)
                                <form method="POST" action="{{ route('contact-messages.read', $message) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="{{ __('app.actions.mark_read') }}"><i class="bi bi-envelope-open"></i></button>
                                </form>
                            @endunless
                            <x-delete-button :action="route('contact-messages.destroy', $message)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="6" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
