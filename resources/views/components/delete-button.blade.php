@props(['action', 'message' => null])
<form method="POST" action="{{ $action }}" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm btn-outline-danger" title="{{ __('app.actions.delete') }}"
        data-confirm-delete
        @if ($message) data-confirm-message="{{ $message }}" @endif>
        <i class="bi bi-trash"></i>
    </button>
</form>
