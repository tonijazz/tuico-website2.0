<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if ($siteSettings->logo)
        <link rel="icon" href="{{ asset('storage/' . $siteSettings->logo) }}">
    @endif

    <title>@yield('title', 'TUICO')</title>

    <meta name="description"
        content="@yield('meta_description', 'Tanzania Union of Industrial and Commercial Workers (TUICO) — representing workers across industries, commerce, financial institutions, services, and consultancy in Tanzania.')">

    <meta property="og:title" content="@yield('title', 'TUICO')">
    <meta property="og:description"
        content="@yield('meta_description', 'Tanzania Union of Industrial and Commercial Workers (TUICO)')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900" x-data="{ showBackToTop: false }"
    @scroll.window="showBackToTop = window.scrollY > 500">

@php
    /*
    |--------------------------------------------------------------------------
    | Locale + URL helpers
    |--------------------------------------------------------------------------
    */
    $isSwahili = app()->getLocale() === 'sw';

    $t = fn(string $en, string $sw) => $isSwahili ? $sw : $en;

    $localeUrl = fn(string $path = '') => ($isSwahili ? '/sw' : '') .
        ($path === '' ? ($isSwahili ? '' : '/') : '/' . ltrim($path, '/'));

    // Language switcher: same page in the other language, query string preserved
    $currentPath = request()->path();
    $basePath = str_starts_with($currentPath, 'sw/') ? substr($currentPath, 3) : ($currentPath === 'sw' ? '' : $currentPath);
    $basePath = $basePath === '/' ? '' : $basePath;

    $suffix = request()->getQueryString() ? '?' . request()->getQueryString() : '';
    $englishUrl = '/' . $basePath . $suffix;
    $swahiliUrl = ($basePath === '' ? '/sw' : '/sw/' . $basePath) . $suffix;

    /*
    |--------------------------------------------------------------------------
    | Organisation name (main line in the current language, sub line in the other)
    |--------------------------------------------------------------------------
    */
    $orgNameEn = 'Tanzania Union of Industrial and Commercial Workers (TUICO)';
    $orgNameSw = 'Chama cha Wafanyakazi wa Viwanda, Biashara, Taasisi za Fedha, Huduma na Ushauri (TUICO)';

    /*
    |--------------------------------------------------------------------------
    | Social links (utility bar)
    |--------------------------------------------------------------------------
    */
    $socials = [
        'facebook_url' => [
            'label' => 'Facebook',
            'fill' => true,
            'svg' => '<path d="M13.5 8H16V4.5C15.57 4.44 14.52 4.35 13.3 4.35C10.75 4.35 9 5.9 9 8.75V11H6v4h3v8h4v-8h3.2l.5-4H13V9c0-.67.18-1 1-1.0Z" />',
        ],
        'instagram_url' => [
            'label' => 'Instagram',
            'fill' => false,
            'svg' => '<rect x="3" y="3" width="18" height="18" rx="5" /><circle cx="12" cy="12" r="4" /><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />',
        ],
        'youtube_url' => [
            'label' => 'YouTube',
            'fill' => true,
            'svg' => '<path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1c.5-1.9.5-5.8.5-5.8s0-3.9-.5-5.8ZM9.6 15.6V8.4l6.3 3.6-6.3 3.6Z" />',
        ],
        'tiktok_url' => [
            'label' => 'TikTok',
            'fill' => true,
            'svg' => '<path d="M16.6 2c.2 1.8 1.1 3.2 2.8 4.1.7.4 1.5.6 2.3.7v3.4c-1.5 0-2.9-.4-4.2-1.1v6.8c0 4.1-2.8 6.8-6.6 6.8-3.7 0-6.3-2.5-6.3-5.9 0-3.5 2.7-6.1 6.2-6.1.5 0 1 .1 1.5.2v3.5c-.4-.1-.8-.2-1.3-.2-1.6 0-2.8 1-2.8 2.5 0 1.4 1 2.5 2.5 2.5 1.7 0 2.8-1.2 2.8-3.2V2h3.1Z" />',
        ],
        'linkedin_url' => [
            'label' => 'LinkedIn',
            'fill' => true,
            'svg' => '<path d="M6.5 8.5H3V21h3.5V8.5ZM4.75 3A2.1 2.1 0 1 0 4.75 7.2 2.1 2.1 0 0 0 4.75 3ZM21 13.8c0-3.8-2-5.6-4.8-5.6-2.2 0-3.2 1.2-3.8 2v-1.7H9V21h3.4v-6.2c0-1.6.3-3.2 2.3-3.2 2 0 2 1.8 2 3.3V21H21v-7.2Z" />',
        ],
    ];

    /*
    |--------------------------------------------------------------------------
    | Main menu: defined once, rendered in both desktop and mobile navigation
    |--------------------------------------------------------------------------
    */
    $menu = [
        ['label' => $t('HOME', 'NYUMBANI'), 'url' => $localeUrl()],
        ['label' => $t('ABOUT US', 'KUHUSU SISI'), 'url' => $localeUrl('about')],
        [
            'label' => $t('ORGANIZATION', 'UONGOZI'),
            'children' => [
                ['label' => $t('Leadership', 'Uongozi Taifa'), 'url' => $localeUrl('leadership')],
                ['label' => $t('Sectors', 'Sekta'), 'url' => $localeUrl('sectors')],
                ['label' => $t('Departments', 'Idara'), 'url' => $localeUrl('departments')],
                ['label' => $t('Units', 'Vitengo'), 'url' => $localeUrl('units')],
            ],
        ],
        [
            'label' => $t('OFFICES', 'OFISI'),
            'children' => [
                ['label' => $t('Zones', 'Kanda'), 'url' => $localeUrl('zones')],
                ['label' => $t('Regions', 'Mikoa'), 'url' => $localeUrl('regions')],
            ],
        ],
        ['label' => $t('NEWS & EVENTS', 'HABARI NA MATUKIO'), 'url' => $localeUrl('news-events')],
        ['label' => $t('AFFILIATIONS', 'WASHIRIKA'), 'url' => $localeUrl('affiliations')],
        ['label' => $t('RESOURCES', 'NYARAKA'), 'url' => $localeUrl('resources')],
        ['label' => $t('STRATEGIC PLAN', 'MPANGO MKAKATI'), 'url' => $localeUrl('strategic-plan')],
        [
            'label' => $t('INQUIRIES', 'MAWASILIANO'),
            'children' => [
                ['label' => $t('Send an Inquiry', 'Tuma Swali / Ombi'), 'url' => $localeUrl('contact')],
                ['label' => $t('FAQs', 'Maswali Yanayoulizwa Mara kwa Mara'), 'url' => $localeUrl('faq')],
            ],
        ],
    ];

    $joinLabel = $t('JOIN US NOW', 'JIUNGE NASI');
    $joinUrl = $localeUrl('join-us');

    /*
    |--------------------------------------------------------------------------
    | Footer
    |--------------------------------------------------------------------------
    */
    $footerHref = fn(string $url) => str_starts_with($url, 'http') ? $url : $localeUrl($url);

    $footerLinkGroups = [
        [
            'title' => $t('Important Links', 'Viungo Muhimu'),
            'links' => $footerImportantLinks,
            'withFaq' => true,
        ],
        [
            'title' => $t('Quick Links', 'Viungo vya Haraka'),
            'links' => $footerPartnerLinks,
            'withFaq' => false,
        ],
    ];
@endphp


{{-- =========================================================
     UTILITY BAR
========================================================== --}}
<div class="bg-chrome text-white">
    <div class="max-w-[1600px] mx-auto px-6">
        <div class="flex h-10 w-full items-center justify-between">

            {{-- MOBILE LANGUAGE SWITCHER --}}
            <div class="flex lg:hidden items-center -ml-3 text-sm font-medium whitespace-nowrap">
                <a href="{{ $englishUrl }}" lang="en" hreflang="en"
                    @if (!$isSwahili) aria-current="true" @endif aria-label="Switch to English"
                    class="px-3 py-2 transition {{ !$isSwahili ? 'font-bold text-white' : 'text-white/70 hover:text-white' }}">EN</a>

                <span class="text-white/50" aria-hidden="true">|</span>

                <a href="{{ $swahiliUrl }}" lang="sw" hreflang="sw"
                    @if ($isSwahili) aria-current="true" @endif aria-label="Badili lugha iwe Kiswahili"
                    class="px-3 py-2 transition {{ $isSwahili ? 'font-bold text-white' : 'text-white/70 hover:text-white' }}">SW</a>
            </div>

            {{-- SOCIAL LINKS --}}
            <div class="ml-auto flex items-center gap-3 sm:gap-5">
                @foreach ($socials as $field => $social)
                    @if ($siteSettings->$field)
                        <a href="{{ $siteSettings->$field }}" target="_blank" rel="noopener noreferrer"
                            aria-label="{{ $social['label'] }}" class="text-white/80 hover:text-white transition">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" aria-hidden="true"
                                @if ($social['fill']) fill="currentColor"
                                @else fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" @endif>
                                {!! $social['svg'] !!}
                            </svg>
                        </a>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
</div>


{{-- =========================================================
     BRANDING + NAVIGATION
========================================================== --}}
<header class="bg-white shadow-sm sticky top-0 z-40" x-data="{ mobileOpen: false }">

    {{-- BRANDING --}}
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6">
        <div class="flex items-center min-h-28 py-5">

            {{-- LOGO --}}
            <a href="{{ $localeUrl() }}" class="shrink-0">
                @if ($siteSettings->logo)
                    <img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="TUICO"
                        class="h-24 w-auto object-contain">
                @else
                    <span class="text-3xl font-display font-extrabold tracking-tight text-main">TUICO</span>
                @endif
            </a>

            {{-- ORGANISATION NAME --}}
            <div class="flex-1 min-w-0 ml-4 lg:ml-10 text-center">
                <div
                    class="font-sans text-lg sm:text-xl lg:text-2xl xl:text-3xl font-semibold leading-snug tracking-wide text-main">
                    {{ $t($orgNameEn, $orgNameSw) }}
                </div>

                <div
                    class="hidden lg:block mt-2 font-sans text-sm font-normal leading-relaxed tracking-wide text-gray-500">
                    {{ $t($orgNameSw, $orgNameEn) }}
                </div>
            </div>

            {{-- MOBILE MENU BUTTON --}}
            <div class="lg:hidden ml-2 shrink-0 relative z-50">
                <button type="button" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen"
                    class="inline-flex items-center justify-center p-2 text-main hover:text-action focus:outline-none"
                    aria-label="Toggle navigation">

                    <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>


    {{-- DESKTOP NAVIGATION --}}
    <div class="hidden lg:block border-t border-gray-100">
        <div class="max-w-[1600px] mx-auto px-6">
            <div class="flex items-center justify-end min-h-14">

                <nav class="flex items-center gap-6 text-sm font-semibold text-gray-700 whitespace-nowrap">

                    @foreach ($menu as $item)
                        @if (isset($item['children']))
                            <div class="relative" x-data="{ open: false }">
                                <button type="button" @click="open = !open" @click.outside="open = false"
                                    :aria-expanded="open" class="flex items-center gap-1 transition hover:text-main">
                                    {{ $item['label'] }}
                                    <span class="text-xs" aria-hidden="true">▾</span>
                                </button>

                                <div x-show="open" x-cloak x-transition class="absolute left-0 top-full pt-3 z-50">
                                    <div class="w-64 bg-white rounded-lg shadow-lg border border-gray-100 py-2">
                                        @foreach ($item['children'] as $child)
                                            <a href="{{ $child['url'] }}"
                                                class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-main">
                                                {{ $child['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ $item['url'] }}" class="transition hover:text-main">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endforeach

                    {{-- JOIN US --}}
                    <a href="{{ $joinUrl }}"
                        class="rounded-lg bg-action px-4 py-2 text-white text-sm font-semibold transition hover:bg-main whitespace-nowrap">
                        {{ $joinLabel }}
                    </a>

                    {{-- LANGUAGE SWITCHER --}}
                    <div class="flex items-center gap-2 ml-2 text-sm font-medium whitespace-nowrap">
                        <a href="{{ $englishUrl }}" lang="en" hreflang="en"
                            class="{{ !$isSwahili ? 'font-bold text-main' : 'text-gray-400 hover:text-main' }}">EN</a>

                        <span class="text-gray-300" aria-hidden="true">|</span>

                        <a href="{{ $swahiliUrl }}" lang="sw" hreflang="sw"
                            class="{{ $isSwahili ? 'font-bold text-main' : 'text-gray-400 hover:text-main' }}">SW</a>
                    </div>

                </nav>

            </div>
        </div>
    </div>


    {{-- MOBILE NAVIGATION --}}
    <nav x-show="mobileOpen" x-cloak
        class="lg:hidden border-t border-gray-100 px-6 pb-4 pt-2 text-sm font-semibold text-gray-700 divide-y divide-gray-100">

        @foreach ($menu as $item)
            @if (isset($item['children']))
                <div class="py-2">
                    <div class="py-2 text-main">{{ $item['label'] }}</div>

                    @foreach ($item['children'] as $child)
                        <a href="{{ $child['url'] }}" class="block py-2 pl-4 hover:text-main">
                            {{ $child['label'] }}
                        </a>
                    @endforeach
                </div>
            @else
                <a href="{{ $item['url'] }}" class="block py-3 hover:text-main">
                    {{ $item['label'] }}
                </a>
            @endif
        @endforeach

        <a href="{{ $joinUrl }}" class="block py-3 font-bold text-main hover:text-action">
            {{ $joinLabel }}
        </a>

    </nav>

</header>


{{-- =========================================================
     MAIN CONTENT
========================================================== --}}
<main>
    @yield('content')
</main>


{{-- =========================================================
     FOOTER
========================================================== --}}
<footer class="bg-chrome text-white/80">

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            {{-- GENERAL SECRETARY OFFICE --}}
            <div>
                <h4 class="text-white font-semibold text-lg mb-4">
                    {{ $t('General Secretary Office', 'Ofisi ya Katibu Mkuu') }}
                </h4>

                <div class="space-y-2 text-sm">
                    <p>{{ $t($orgNameEn, $orgNameSw) }}</p>
                    <p>{{ $siteSettings->street_address }}</p>
                    <p>{{ $t('P.O. Box', 'S.L.P.') }} {{ $siteSettings->po_box }}</p>

                    <p>
                        <a href="mailto:{{ $siteSettings->email }}" class="hover:text-white transition">
                            {{ $siteSettings->email }}
                        </a>
                    </p>

                    <p>
                        <a href="tel:{{ $siteSettings->phone }}" class="hover:text-white transition">
                            {{ $siteSettings->phone }}
                        </a>
                    </p>

                    <p>{{ $t('Fax:', 'Faksi:') }} {{ $siteSettings->fax }}</p>
                </div>
            </div>

            {{-- IMPORTANT LINKS + QUICK LINKS --}}
            @foreach ($footerLinkGroups as $group)
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">{{ $group['title'] }}</h4>

                    <ul class="space-y-2 text-sm">
                        @foreach ($group['links'] as $footerLink)
                            @php($external = str_starts_with($footerLink->url, 'http'))
                            <li>
                                <a href="{{ $footerHref($footerLink->url) }}"
                                    @if ($external) target="_blank" rel="noopener noreferrer" @endif
                                    class="hover:text-white transition">
                                    {{ $footerLink->label }}
                                </a>
                            </li>
                        @endforeach

                        @if ($group['withFaq'])
                            <li>
                                <a href="{{ $localeUrl('faq') }}" class="hover:text-white transition">
                                    {{ $t('FAQs', 'Maswali Yanayoulizwa Mara kwa Mara') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @endforeach

        </div>
    </div>

    {{-- FOOTER CREDIT --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 text-center text-xs sm:text-sm text-white/60">
            {{ $siteSettings->footer_credit }}
        </div>
    </div>

</footer>


{{-- =========================================================
     BACK TO TOP
========================================================== --}}
<button type="button" x-show="showBackToTop" x-cloak x-transition
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="fixed bottom-6 right-6 z-50 inline-flex items-center justify-center h-11 w-11 rounded-full bg-action text-white shadow-lg hover:bg-main focus:outline-none"
    aria-label="Back to top">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</body>

</html>
