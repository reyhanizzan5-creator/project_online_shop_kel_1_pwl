@props(['name', 'class' => ''])

@php
$paths = [
    'dashboard' => '<rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/>',
    'tag' => '<path d="M11.5 3H5a2 2 0 00-2 2v6.5a2 2 0 00.6 1.4l8.5 8.5a2 2 0 002.8 0l6.5-6.5a2 2 0 000-2.8l-8.5-8.5a2 2 0 00-1.4-.6z"/><circle cx="8" cy="8" r="1.4"/>',
    'box' => '<path d="M3.5 7.5L12 3l8.5 4.5v9L12 21l-8.5-4.5v-9z"/><path d="M3.8 7.3L12 12l8.2-4.7"/><path d="M12 12v9"/>',
    'users' => '<circle cx="9" cy="8" r="3.2"/><path d="M2.5 20c0-3.6 2.9-6 6.5-6s6.5 2.4 6.5 6"/><path d="M16 4.3c1.7.4 3 2 3 3.9 0 1.9-1.3 3.5-3 3.9"/><path d="M18.5 14.3c2 .6 3.5 2.6 3.5 5.1"/>',
    'receipt' => '<path d="M6 3h12v17.2c0 .6-.6 1-1.2.8L14 19.5l-2 1.5-2-1.5-2.8 1.5c-.6.2-1.2-.2-1.2-.8V3z"/><path d="M9 8h6M9 12h6M9 16h3.5"/>',
    'cart' => '<circle cx="9.5" cy="20" r="1.3"/><circle cx="17.5" cy="20" r="1.3"/><path d="M2.5 3h2.3l2.2 12.1a2 2 0 002 1.65h8.6a2 2 0 002-1.55L21 8H6.1"/>',
    'user' => '<circle cx="12" cy="8" r="3.6"/><path d="M4.5 20c0-4 3.4-7 7.5-7s7.5 3 7.5 7"/>',
    'logout' => '<path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/>',
    'menu' => '<path d="M3.5 6.5h17M3.5 12h17M3.5 17.5h17"/>',
    'x' => '<path d="M6 6l12 12M18 6L6 18"/>',
    'search' => '<circle cx="10.5" cy="10.5" r="6.5"/><path d="M20 20l-4.8-4.8"/>',
    'trash' => '<path d="M4 7h16"/><path d="M9.5 7V4.8c0-.4.4-.8.8-.8h3.4c.4 0 .8.4.8.8V7"/><path d="M6.5 7l.8 12.2c0 .9.8 1.8 1.7 1.8h6c1 0 1.7-.8 1.8-1.8L17.5 7"/><path d="M10.3 11v6M13.7 11v6"/>',
    'plus' => '<path d="M12 5v14M5 12h14"/>',
    'minus' => '<path d="M5 12h14"/>',
    'chevron-down' => '<path d="M6 9l6 6 6-6"/>',
    'chevron-left' => '<path d="M15 18l-6-6 6-6"/>',
    'check-circle' => '<circle cx="12" cy="12" r="9"/><path d="M8.3 12.3l2.6 2.6 5-5.2"/>',
    'alert-circle' => '<circle cx="12" cy="12" r="9"/><path d="M12 7.5v6"/><circle cx="12" cy="16.7" r="1"/>',
    'eye' => '<path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12z"/><circle cx="12" cy="12" r="2.8"/>',
    'image' => '<rect x="3" y="4" width="18" height="16" rx="2.2"/><circle cx="8.5" cy="9.5" r="1.7"/><path d="M21 16l-5.5-5.5a1.5 1.5 0 00-2.1 0L4 19"/>',
    'truck' => '<path d="M2.5 6.5h11v10h-11z"/><path d="M13.5 10.5h4l3 3v3h-7z"/><circle cx="7" cy="18" r="1.8"/><circle cx="17.5" cy="18" r="1.8"/>',
    'package-check' => '<path d="M3.5 7.5L12 3l8.5 4.5v9L12 21l-8.5-4.5v-9z"/><path d="M3.8 7.3L12 12l8.2-4.7"/><path d="M12 12v9"/><path d="M9 4.8l6.2 3.4"/>',
    'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5.5l3.8 2.2"/>',
    'map-pin' => '<path d="M12 21.5S4.5 14.8 4.5 9.5a7.5 7.5 0 1115 0c0 5.3-7.5 12-7.5 12z"/><circle cx="12" cy="9.5" r="2.6"/>',
    'phone' => '<path d="M5.5 4h3.2l1.4 4.3-2 1.6a11.6 11.6 0 005.9 5.9l1.6-2 4.3 1.4v3.2c0 1-.9 1.8-1.9 1.6C10.4 18.8 5.2 13.6 4 6c-.1-1 .7-2 1.5-2z"/>',
    'star' => '<path d="M12 3.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9-5.3-2.9-5.3 2.9 1.1-5.9L3.5 9.6l5.9-.7z"/>',
    'inbox' => '<path d="M3.5 12.5h5l1.7 2.6h3.6l1.7-2.6h5"/><path d="M5.3 5.5h13.4l2 7v6a2 2 0 01-2 2H5.3a2 2 0 01-2-2v-6z"/>',
    'wallet' => '<rect x="3" y="6" width="18" height="13" rx="2"/><path d="M3 10h18"/><circle cx="16.5" cy="14" r="1"/>',
    'edit' => '<path d="M4 20h4.2L18.8 9.4a2 2 0 000-2.8l-1.4-1.4a2 2 0 00-2.8 0L4 15.8V20z"/><path d="M13.5 6.5l4 4"/>',
];
$icon = $paths[$name] ?? $paths['box'];
@endphp

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" aria-hidden="true" {{ $attributes }}>{!! $icon !!}</svg>
