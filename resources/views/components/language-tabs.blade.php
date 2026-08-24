@props(['id' => 'lang-'.uniqid()])
<div class="mb-3">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="{{ $id }}-ar-tab" data-bs-toggle="tab" data-bs-target="#{{ $id }}-ar" type="button" role="tab">
                <i class="bi bi-flag me-1"></i>{{ __('app.labels.arabic') }}
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="{{ $id }}-en-tab" data-bs-toggle="tab" data-bs-target="#{{ $id }}-en" type="button" role="tab">
                <i class="bi bi-flag me-1"></i>{{ __('app.labels.english') }}
            </button>
        </li>
    </ul>
    <div class="tab-content border border-top-0 rounded-bottom p-3">
        <div class="tab-pane fade show active" id="{{ $id }}-ar" role="tabpanel">
            {{ $ar }}
        </div>
        <div class="tab-pane fade" id="{{ $id }}-en" role="tabpanel">
            {{ $en }}
        </div>
    </div>
</div>
