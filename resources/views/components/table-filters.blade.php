@props(['action', 'placeholder' => null])
<form method="GET" action="{{ $action }}" class="table-filters d-flex flex-wrap align-items-center gap-2">
    <div class="flex-grow-1" style="min-width: 220px;">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-secondary"></i></span>
            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0"
                placeholder="{{ $placeholder ?? __('app.actions.search') }}">
        </div>
    </div>

    {{ $slot }}

    <select name="per_page" class="form-select" style="width: auto;" onchange="this.form.submit()">
        @foreach ([15, 25, 50, 100] as $n)
            <option value="{{ $n }}" @selected((int) request('per_page', 15) === $n)>{{ $n }} / {{ __('app.actions.show') }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>{{ __('app.actions.search') }}</button>
    <a href="{{ $action }}" class="btn btn-outline-secondary">{{ __('app.messages.reset_filters') }}</a>
</form>
