@props(['model', 'type'])
<form method="POST" action="{{ route('documents.store', [$type, $model->id]) }}" enctype="multipart/form-data" class="mb-3">
    @csrf
    <div class="input-group mb-2">
        <input type="file" name="file" class="form-control" required>
        <button class="btn btn-outline-primary" type="submit">{{ __('app.actions.upload') }}</button>
    </div>
    <div class="form-check">
        <input type="checkbox" name="client_visible" value="1" id="client_visible_{{ $type }}_{{ $model->id }}" class="form-check-input">
        <label for="client_visible_{{ $type }}_{{ $model->id }}" class="form-check-label small">{{ __('app.labels.visible_to_client') }}</label>
    </div>
</form>
<ul class="list-group list-group-flush">
    @forelse ($model->media as $media)
        @php $visible = $media->getCustomProperty('client_visible', false); @endphp
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>
                <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->file_name }}</a>
                <span class="badge rounded-pill {{ $visible ? 'bg-success-subtle text-success-emphasis' : 'bg-secondary-subtle text-secondary-emphasis' }} ms-1">
                    {{ $visible ? __('app.labels.visible_to_client') : __('app.labels.not_visible_to_client') }}
                </span>
            </span>
            <span class="d-flex gap-1">
                <form method="POST" action="{{ route('documents.toggle-visibility', $media) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="{{ __('app.actions.toggle_visibility') }}">
                        <i class="bi {{ $visible ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                    </button>
                </form>
                <x-delete-button :action="route('documents.destroy', $media)" />
            </span>
        </li>
    @empty
        <li class="list-group-item text-secondary">{{ __('app.messages.no_results') }}</li>
    @endforelse
</ul>
