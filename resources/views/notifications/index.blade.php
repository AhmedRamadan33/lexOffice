<x-app-layout :title="__('app.nav.notifications')">
    <div class="d-flex justify-content-end mb-3">
        <form method="POST" action="{{ route('notifications.read-all') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm">{{ __('app.actions.mark_read') }}</button>
        </form>
    </div>

    <div class="card">
        <ul class="list-group list-group-flush">
            @forelse ($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center {{ $notification->read_at ? '' : 'bg-light' }}">
                    <span>{{ __($notification->data['message_key'], $notification->data) }}</span>
                    @if (! $notification->read_at)
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">{{ __('app.actions.mark_read') }}</button>
                        </form>
                    @endif
                </li>
            @empty
                <li class="list-group-item text-secondary text-center py-4">{{ __('app.notifications.empty') }}</li>
            @endforelse
        </ul>
    </div>

    <div class="mt-3">{{ $notifications->links() }}</div>
</x-app-layout>
