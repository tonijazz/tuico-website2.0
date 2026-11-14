@props(['name' => null])

@php
    $paths = [
        'factory' => 'M3 21h18M5 21V5l7-3 7 3v16M9 9h2m-2 4h2m2-4h2m-2 4h2',
        'store' => 'M3 10h18M5 10l1.2-5h11.6L19 10M5 10v9h14v-9M8 14h3v5H8v-5zm6 0h3v5h-3v-5zM3 10c0 1.1.9 2 2 2s2-.9 2-2c0 1.1.9 2 2 2s2-.9 2-2c0 1.1.9 2 2 2s2-.9 2-2c0 1.1.9 2 2 2s2-.9 2-2',
        'bank' => 'M3 10h18L12 4 3 10zM5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M3 21h18',
        'bolt' => 'M13 10V3L4 14h7v7l9-11h-7z',
    ];
@endphp

<svg {{ $attributes->merge(['class' => 'h-6 w-6']) }} fill="none" viewBox="0 0 24 24" stroke="currentColor"
    aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $paths[$name] ?? $paths['bolt'] }}" />
</svg>
