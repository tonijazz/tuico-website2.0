@props(['name', 'title' => null, 'photo' => null, 'vacant' => false])

@php
    $initials = $vacant
        ? '?'
        : collect(explode(' ', $name))
            ->filter()
            ->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))
            ->take(2)
            ->implode('');
@endphp

<div>

    {{-- PHOTO (square, 1:1) --}}
    <div class="aspect-square overflow-hidden bg-action/10">
        @if ($photo)
            <img src="{{ asset('storage/' . $photo) }}" alt="{{ $name }}" loading="lazy"
                class="h-full w-full object-cover object-top">
        @else
            <div class="flex h-full w-full items-center justify-center text-5xl font-bold text-action">
                {{ $initials }}
            </div>
        @endif
    </div>

    {{-- NAME + OFFICE TITLE --}}
    <h3 class="mt-4 text-lg font-bold leading-snug {{ $vacant ? 'text-gray-500' : 'text-main' }}">
        {{ $name }}
    </h3>

    @if ($title)
        <p class="mt-1 text-sm text-gray-600">{{ $title }}</p>
    @endif

</div>
