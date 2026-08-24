@props(['status'])
@php
$colors = [
    'open' => 'primary', 'pending' => 'warning', 'closed' => 'secondary',
    'scheduled' => 'info', 'held' => 'success', 'postponed' => 'warning',
    'unpaid' => 'danger', 'partial' => 'warning', 'paid' => 'success',
    'in_progress' => 'info', 'done' => 'success',
    'low' => 'secondary', 'normal' => 'info', 'high' => 'danger',
];
$color = $colors[$status] ?? 'secondary';
@endphp
<span class="badge rounded-pill bg-{{ $color }}-subtle text-{{ $color }}-emphasis border border-{{ $color }}-subtle">{{ __('app.status.'.$status) }}</span>
