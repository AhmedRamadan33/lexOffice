@props(['code'])
@if ($code === 'eg')
    <svg viewBox="0 0 30 20" class="pub-flag-icon" aria-hidden="true">
        <rect width="30" height="20" fill="#fff" />
        <rect width="30" height="6.67" y="0" fill="#ce1126" />
        <rect width="30" height="6.67" y="13.33" fill="#000" />
        <circle cx="15" cy="10" r="2.2" fill="#c09a3e" />
    </svg>
@else
    <svg viewBox="0 0 60 30" class="pub-flag-icon" aria-hidden="true">
        <rect width="60" height="30" fill="#00247d" />
        <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6" />
        <path d="M0,0 L60,30 M60,0 L0,30" stroke="#cf142b" stroke-width="2" />
        <path d="M30,0 V30 M0,15 H60" stroke="#fff" stroke-width="10" />
        <path d="M30,0 V30 M0,15 H60" stroke="#cf142b" stroke-width="6" />
    </svg>
@endif
