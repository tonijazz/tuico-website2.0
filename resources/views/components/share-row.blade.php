@props(['url', 'title'])

@php
    $u = urlencode($url);
    $t = urlencode($title);

    $round = 'inline-flex h-11 w-11 items-center justify-center rounded-full bg-action text-white hover:bg-main transition focus:outline-none focus:ring-2 focus:ring-action focus:ring-offset-2';
    $pill = 'inline-flex h-11 items-center gap-2 rounded-full bg-action px-4 text-sm font-semibold text-white hover:bg-main transition focus:outline-none focus:ring-2 focus:ring-action focus:ring-offset-2';
    $copyBtn = 'inline-flex h-11 w-11 items-center justify-center rounded-full bg-action text-white hover:bg-main transition focus:outline-none focus:ring-2 focus:ring-action focus:ring-offset-2 sm:w-auto sm:gap-2 sm:px-4 sm:text-sm sm:font-semibold';
    $networks = [
        ['WhatsApp', "https://wa.me/?text={$t}%20{$u}", 'M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z'],
        ['Facebook', "https://www.facebook.com/sharer/sharer.php?u={$u}", 'M13.5 8H16V4.5C15.57 4.44 14.52 4.35 13.3 4.35C10.75 4.35 9 5.9 9 8.75V11H6v4h3v8h4v-8h3.2l.5-4H13V9c0-.67.18-1 1-1.0Z'],
        ['X', "https://twitter.com/intent/tweet?text={$t}&url={$u}", 'M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z'],
        ['LinkedIn', "https://www.linkedin.com/sharing/share-offsite/?url={$u}", 'M6.5 8.5H3V21h3.5V8.5ZM4.75 3A2.1 2.1 0 1 0 4.75 7.2 2.1 2.1 0 0 0 4.75 3ZM21 13.8c0-3.8-2-5.6-4.8-5.6-2.2 0-3.2 1.2-3.8 2v-1.7H9V21h3.4v-6.2c0-1.6.3-3.2 2.3-3.2 2 0 2 1.8 2 3.3V21H21v-7.2Z'],
    ];
@endphp

<div class="max-w-3xl mx-auto mt-8" x-data="{ copied: false, canShare: !!navigator.share }">
    <p class="mb-3 text-sm font-semibold uppercase tracking-widest text-action">
        {{ localized('Share this article', 'Shiriki habari hii') }}
    </p>

    <div class="flex flex-wrap items-center gap-3">

        {{-- Phones only: opens the phone's own share menu --}}
        <button type="button" x-show="canShare" x-cloak @click="navigator.share({ title: @js($title), url: @js($url) })"
            aria-label="{{ localized('Share', 'Shiriki') }}" title="{{ localized('Share', 'Shiriki') }}"
            class="{{ $round }} sm:hidden">
            <x-heroicon-o-arrow-up-on-square class="h-5 w-5" />
        </button>

        @foreach ($networks as [$label, $href, $path])
            <a href="{{ $href }}" target="_blank" rel="noopener noreferrer"
                aria-label="{{ localized('Share on', 'Shiriki kwenye') }} {{ $label }}" title="{{ $label }}"
                class="{{ $round }}">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="{{ $path }}" />
                </svg>
            </a>
        @endforeach

        <button type="button"
            @click="navigator.clipboard.writeText(@js($url)).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
            aria-label="{{ localized('Copy link', 'Nakili kiungo') }}"
            title="{{ localized('Copy link', 'Nakili kiungo') }}" class="{{ $copyBtn }}">
            <x-heroicon-o-link class="h-5 w-5" x-show="!copied" />
            <x-heroicon-o-check class="h-5 w-5" x-show="copied" x-cloak />
            <span class="hidden sm:inline" x-show="!copied">{{ localized('Copy link', 'Nakili kiungo') }}</span>
            <span class="hidden sm:inline" x-show="copied" x-cloak>{{ localized('Copied', 'Imenakiliwa') }}</span>
        </button>

    </div>
</div>
