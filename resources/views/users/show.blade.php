<x-app-layout :title="$user->name">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">{{ $user->name }}</span>
            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-secondary">{{ __('app.actions.edit') }}</a>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.email') }}</span><span>{{ $user->email }}</span></li>
            <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.phone') }}</span><span>{{ $user->phone ?? '-' }}</span></li>
            <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.branch') }}</span><span>{{ $user->branch->name ?? '-' }}</span></li>
            <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">{{ __('app.labels.role') }}</span><span>{{ $user->roles->pluck('name')->join(', ') }}</span></li>
        </ul>
    </div>
</x-app-layout>
