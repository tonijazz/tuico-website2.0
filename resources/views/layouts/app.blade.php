<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if ($siteSettings->logo)
        <link rel="icon" href="{{ asset('storage/' . $siteSettings->logo) }}">
    @endif

    <title>@yield('title', 'TUICO')</title>

    <meta
        name="description"
        content="@yield('meta_description', 'Tanzania Union of Industrial and Commercial Workers (TUICO) — representing workers across industries, commerce, financial institutions, services, and consultancy in Tanzania.')"
    >

    <meta property="og:title" content="@yield('title', 'TUICO')">

    <meta
        property="og:description"
        content="@yield('meta_description', 'Tanzania Union of Industrial and Commercial Workers (TUICO)')"
    >

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""
    >

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

</head>

<body
    class="bg-white text-gray-900"
    x-data="{ showBackToTop: false }"
    @scroll.window="showBackToTop = window.scrollY > 500"
>

@php
    $currentPath = request()->path();

    $isSwahili = str_starts_with($currentPath, 'sw/') || $currentPath === 'sw';

    $basePath = $isSwahili ? substr($currentPath, 3) : $currentPath;
    $basePath = $basePath === '/' ? '' : $basePath;

    // Keep the query string (e.g. ?page=2) when switching language
    $query = request()->getQueryString();
    $suffix = $query ? '?' . $query : '';

    $englishUrl = '/' . $basePath . $suffix;
    $swahiliUrl = ($basePath === '' ? '/sw' : '/sw/' . $basePath) . $suffix;
@endphp



{{-- =========================================================
     UTILITY BAR
========================================================== --}}

<div class="bg-tuico-navy text-white">

    <div class="max-w-[1600px] mx-auto px-6">

        <div class="flex w-full items-center justify-between h-10">

            {{-- MOBILE LANGUAGE SWITCHER --}}
            <div class="flex lg:hidden items-center -ml-3 text-sm font-medium whitespace-nowrap">

                <a
                    href="{{ $englishUrl }}"
                    lang="en"
                    hreflang="en"
                    @if (!$isSwahili) aria-current="true" @endif
                    class="px-3 py-2 {{ !$isSwahili ? 'font-bold text-white' : 'text-gray-300 hover:text-white' }} transition"
                    aria-label="Switch to English"
                >
                    EN
                </a>

                <span class="text-white/50" aria-hidden="true">|</span>

                <a
                    href="{{ $swahiliUrl }}"
                    lang="sw"
                    hreflang="sw"
                    @if ($isSwahili) aria-current="true" @endif
                    class="px-3 py-2 {{ $isSwahili ? 'font-bold text-white' : 'text-gray-300 hover:text-white' }} transition"
                    aria-label="Badili lugha iwe Kiswahili"
                >
                    SW
                </a>

            </div>

            <div
                class="flex items-center gap-3 sm:gap-5"
                style="margin-left: auto;"
            >

                {{-- FACEBOOK --}}
                @if ($siteSettings->facebook_url)

                    <a
                        href="{{ $siteSettings->facebook_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-tuico-sky hover:text-white transition"
                        aria-label="Facebook"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M13.5 8H16V4.5C15.57 4.44 14.52 4.35 13.3 4.35C10.75 4.35 9 5.9 9 8.75V11H6v4h3v8h4v-8h3.2l.5-4H13V9c0-.67.18-1 1-1.0Z" />
                        </svg>
                    </a>

                @endif


                {{-- INSTAGRAM --}}
                @if ($siteSettings->instagram_url)

                    <a
                        href="{{ $siteSettings->instagram_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-tuico-sky hover:text-white transition"
                        aria-label="Instagram"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <rect x="3" y="3" width="18" height="18" rx="5" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />
                        </svg>
                    </a>

                @endif


                {{-- YOUTUBE --}}
                @if ($siteSettings->youtube_url)

                    <a
                        href="{{ $siteSettings->youtube_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-tuico-sky hover:text-white transition"
                        aria-label="YouTube"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1c.5-1.9.5-5.8.5-5.8s0-3.9-.5-5.8ZM9.6 15.6V8.4l6.3 3.6-6.3 3.6Z" />
                        </svg>
                    </a>

                @endif


                {{-- TIKTOK --}}
                @if ($siteSettings->tiktok_url)

                    <a
                        href="{{ $siteSettings->tiktok_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-tuico-sky hover:text-white transition"
                        aria-label="TikTok"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M16.6 2c.2 1.8 1.1 3.2 2.8 4.1.7.4 1.5.6 2.3.7v3.4c-1.5 0-2.9-.4-4.2-1.1v6.8c0 4.1-2.8 6.8-6.6 6.8-3.7 0-6.3-2.5-6.3-5.9 0-3.5 2.7-6.1 6.2-6.1.5 0 1 .1 1.5.2v3.5c-.4-.1-.8-.2-1.3-.2-1.6 0-2.8 1-2.8 2.5 0 1.4 1 2.5 2.5 2.5 1.7 0 2.8-1.2 2.8-3.2V2h3.1Z" />
                        </svg>
                    </a>

                @endif


                {{-- LINKEDIN --}}
                @if ($siteSettings->linkedin_url)

                    <a
                        href="{{ $siteSettings->linkedin_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-tuico-sky hover:text-white transition"
                        aria-label="LinkedIn"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path d="M6.5 8.5H3V21h3.5V8.5ZM4.75 3A2.1 2.1 0 1 0 4.75 7.2 2.1 2.1 0 0 0 4.75 3ZM21 13.8c0-3.8-2-5.6-4.8-5.6-2.2 0-3.2 1.2-3.8 2v-1.7H9V21h3.4v-6.2c0-1.6.3-3.2 2.3-3.2 2 0 2 1.8 2 3.3V21H21v-7.2Z" />
                        </svg>
                    </a>

                @endif

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     BRANDING + NAVIGATION
========================================================== --}}

<header
    class="bg-white shadow-sm sticky top-0 z-40"
    x-data="{ mobileOpen: false }"
>

    {{-- BRANDING AREA --}}

    <div class="bg-white">

        <div class="max-w-[1600px] mx-auto px-4 sm:px-6">

            <div class="flex items-center min-h-28 py-5">

                {{-- LOGO --}}

                <a
                    href="{{ $isSwahili ? '/sw' : '/' }}"
                    class="shrink-0"
                >

                    @if ($siteSettings->logo)

                        <img
                            src="{{ asset('storage/' . $siteSettings->logo) }}"
                            alt="TUICO"
                            class="h-24 w-auto object-contain"
                        >

                    @else

                        <span class="text-3xl font-display font-extrabold tracking-tight text-tuico-navy">
                            TUICO
                        </span>

                    @endif

                </a>



                {{-- ORGANISATION NAME --}}

                <div class="flex-1 min-w-0 ml-4 lg:ml-10 text-center">

                    @if (!$isSwahili)

                        {{-- ENGLISH MAIN --}}

                        <div
                            class="font-sans text-lg sm:text-xl lg:text-2xl xl:text-3xl font-semibold leading-snug tracking-wide text-tuico-navy"
                        >
                            Tanzania Union of Industrial and Commercial Workers (TUICO)
                        </div>

                        {{-- SWAHILI SUB --}}

                        <div
                            class="hidden lg:block mt-2 font-sans text-sm font-normal leading-relaxed tracking-wide text-gray-500"
                        >
                            Chama cha Wafanyakazi wa Viwanda, Biashara, Taasisi za Fedha, Huduma na Ushauri (TUICO)
                        </div>

                    @else

                        {{-- SWAHILI MAIN --}}

                        <div
                            class="font-sans text-lg sm:text-xl lg:text-2xl xl:text-3xl font-semibold leading-snug tracking-wide text-tuico-navy"
                        >
                            Chama cha Wafanyakazi wa Viwanda, Biashara, Taasisi za Fedha, Huduma na Ushauri (TUICO)
                        </div>

                        {{-- ENGLISH SUB --}}

                        <div
                            class="hidden lg:block mt-2 font-sans text-sm font-normal leading-relaxed tracking-wide text-gray-500"
                        >
                            Tanzania Union of Industrial and Commercial Workers (TUICO)
                        </div>

                    @endif

                </div>



                {{-- MOBILE MENU BUTTON --}}

                <div class="lg:hidden ml-2 shrink-0 relative z-50">

                    <button
                        type="button"
                        @click="mobileOpen = !mobileOpen"
                        class="inline-flex items-center justify-center p-2 text-tuico-navy hover:text-tuico-sky focus:outline-none"
                        aria-label="Toggle navigation"
                    >

                        {{-- HAMBURGER --}}

                        <svg
                            x-show="!mobileOpen"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>


                        {{-- CLOSE ICON --}}

                        <svg
                            x-show="mobileOpen"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         DESKTOP NAVIGATION BAR
    ====================================================== --}}

    <div class="hidden lg:block border-t border-gray-100">

        <div class="max-w-[1600px] mx-auto px-6">

            <div class="flex items-center justify-end min-h-14">

                <nav class="flex items-center gap-6 text-sm font-semibold text-gray-700 whitespace-nowrap">

                    <a
                        href="{{ $isSwahili ? '/sw' : '/' }}"
                        class="transition hover:text-tuico-navy"
                    >
                        {{ $isSwahili ? 'NYUMBANI' : 'HOME' }}
                    </a>


                    {{-- ABOUT US --}}

                    <a
                        href="{{ $isSwahili ? '/sw/about' : '/about' }}"
                        class="transition hover:text-tuico-navy"
                    >
                        {{ $isSwahili ? 'KUHUSU SISI' : 'ABOUT US' }}
                    </a>


                    {{-- ORGANIZATION --}}

                    <div class="relative" x-data="{ open: false }">

                        <button
                            type="button"
                            @click="open = !open"
                            @click.outside="open = false"
                            class="flex items-center gap-1 transition hover:text-tuico-navy"
                        >
                            {{ $isSwahili ? 'UONGOZI' : 'ORGANIZATION' }}
                            <span class="text-xs">▾</span>
                        </button>

                        <div
                            x-show="open"
                            x-transition
                            class="absolute left-0 top-full pt-3 z-50"
                            style="display: none;"
                        >

                            <div class="w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-2">

                                <a
                                    href="{{ $isSwahili ? '/sw/leadership' : '/leadership' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Uongozi Taifa' : 'Leadership' }}
                                </a>

                                <a
                                    href="{{ $isSwahili ? '/sw/sectors' : '/sectors' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Sekta' : 'Sectors' }}
                                </a>

                                <a
                                    href="{{ $isSwahili ? '/sw/departments' : '/departments' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Idara' : 'Departments' }}
                                </a>

                                <a
                                    href="{{ $isSwahili ? '/sw/units' : '/units' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Vitengo' : 'Units' }}
                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- OFFICES --}}

                    <div class="relative" x-data="{ open: false }">

                        <button
                            type="button"
                            @click="open = !open"
                            @click.outside="open = false"
                            class="flex items-center gap-1 transition hover:text-tuico-navy"
                        >
                            {{ $isSwahili ? 'OFISI' : 'OFFICES' }}
                            <span class="text-xs">▾</span>
                        </button>

                        <div
                            x-show="open"
                            x-transition
                            class="absolute left-0 top-full pt-3 z-50"
                            style="display: none;"
                        >

                            <div class="w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2">

                                <a
                                    href="{{ $isSwahili ? '/sw/zones' : '/zones' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Kanda' : 'Zones' }}
                                </a>

                                <a
                                    href="{{ $isSwahili ? '/sw/regions' : '/regions' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Mikoa' : 'Regions' }}
                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- NEWS & EVENTS --}}

                    <a
                        href="{{ $isSwahili ? '/sw/news-events' : '/news-events' }}"
                        class="transition hover:text-tuico-navy"
                    >
                        {{ $isSwahili ? 'HABARI & MATUKIO' : 'NEWS & EVENTS' }}
                    </a>


                    {{-- AFFILIATIONS --}}

                    <a
                        href="{{ $isSwahili ? '/sw/affiliations' : '/affiliations' }}"
                        class="transition hover:text-tuico-navy"
                    >
                        {{ $isSwahili ? 'WASHIRIKA' : 'AFFILIATIONS' }}
                    </a>


                    {{-- RESOURCES --}}

                    <a
                        href="{{ $isSwahili ? '/sw/resources' : '/resources' }}"
                        class="transition hover:text-tuico-navy"
                    >
                        {{ $isSwahili ? 'NYARAKA' : 'RESOURCES' }}
                    </a>


                    {{-- STRATEGIC PLAN --}}

                    <a
                        href="{{ $isSwahili ? '/sw/strategic-plan' : '/strategic-plan' }}"
                        class="transition hover:text-tuico-navy"
                    >
                        {{ $isSwahili ? 'MPANGO MKAKATI' : 'STRATEGIC PLAN' }}
                    </a>


                    {{-- INQUIRIES --}}

                    <div class="relative" x-data="{ open: false }">

                        <button
                            type="button"
                            @click="open = !open"
                            @click.outside="open = false"
                            class="flex items-center gap-1 transition hover:text-tuico-navy"
                        >
                            {{ $isSwahili ? 'MAWASILIANO' : 'INQUIRIES' }}
                            <span class="text-xs">▾</span>
                        </button>

                        <div
                            x-show="open"
                            x-transition
                            class="absolute left-0 top-full pt-3 z-50"
                            style="display: none;"
                        >

                            <div class="w-64 bg-white rounded-lg shadow-lg border border-gray-100 py-2">

                                <a
                                    href="{{ $isSwahili ? '/sw/contact' : '/contact' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Tuma Swali / Ombi' : 'Send an Inquiry' }}
                                </a>

                                <a
                                    href="{{ $isSwahili ? '/sw/faq' : '/faq' }}"
                                    class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-tuico-navy"
                                >
                                    {{ $isSwahili ? 'Maswali Yanayoulizwa Mara kwa Mara' : 'FAQs' }}
                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- JOIN US --}}

                    <a
                        href="{{ $isSwahili ? '/sw/join-us' : '/join-us' }}"
                        class="rounded-lg bg-tuico-sky px-4 py-2 text-white text-sm font-semibold transition hover:bg-tuico-navy whitespace-nowrap"
                    >
                        {{ $isSwahili ? 'JIUNGE NASI' : 'JOIN US NOW' }}
                    </a>


                    {{-- LANGUAGE SWITCHER --}}

                    <div class="flex items-center gap-2 ml-2 text-sm font-medium whitespace-nowrap">

                        <a
                            href="{{ $englishUrl }}"
                            class="{{ !$isSwahili ? 'font-bold text-tuico-navy' : 'text-gray-400 hover:text-tuico-navy' }}"
                        >
                            EN
                        </a>

                        <span class="text-gray-300">|</span>

                        <a
                            href="{{ $swahiliUrl }}"
                            class="{{ $isSwahili ? 'font-bold text-tuico-navy' : 'text-gray-400 hover:text-tuico-navy' }}"
                        >
                            SW
                        </a>

                    </div>

                </nav>

            </div>

        </div>

    </div>



    {{-- =====================================================
         MOBILE NAVIGATION
    ====================================================== --}}

    <div
        x-show="mobileOpen"
        x-cloak
        class="lg:hidden border-t border-gray-100 px-6 pb-4 pt-2 space-y-1 text-sm font-semibold text-gray-700"
    >

        <a
            href="{{ $isSwahili ? '/sw' : '/' }}"
            class="block py-2 hover:text-tuico-navy"
        >
            {{ $isSwahili ? 'NYUMBANI' : 'HOME' }}
        </a>


        {{-- ABOUT US --}}

        <a
            href="{{ $isSwahili ? '/sw/about' : '/about' }}"
            class="block py-2 border-t border-gray-100 pt-2 mt-2 hover:text-tuico-navy"
        >
            {{ $isSwahili ? 'KUHUSU SISI' : 'ABOUT US' }}
        </a>


        {{-- ORGANIZATION --}}

        <div class="border-t border-gray-100 pt-2 mt-2">

            <div class="py-2 text-tuico-navy">
                {{ $isSwahili ? 'UONGOZI' : 'ORGANIZATION' }}
            </div>

            <a
                href="{{ $isSwahili ? '/sw/leadership' : '/leadership' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Uongozi Taifa' : 'Leadership' }}
            </a>

            <a
                href="{{ $isSwahili ? '/sw/sectors' : '/sectors' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Sekta' : 'Sectors' }}
            </a>

            <a
                href="{{ $isSwahili ? '/sw/departments' : '/departments' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Idara' : 'Departments' }}
            </a>

            <a
                href="{{ $isSwahili ? '/sw/units' : '/units' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Vitengo' : 'Units' }}
            </a>

        </div>


        {{-- OFFICES --}}

        <div class="border-t border-gray-100 pt-2 mt-2">

            <div class="py-2 text-tuico-navy">
                {{ $isSwahili ? 'OFISI' : 'OFFICES' }}
            </div>

            <a
                href="{{ $isSwahili ? '/sw/zones' : '/zones' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Kanda' : 'Zones' }}
            </a>

            <a
                href="{{ $isSwahili ? '/sw/regions' : '/regions' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Mikoa' : 'Regions' }}
            </a>

        </div>


        {{-- NEWS & EVENTS --}}

        <a
            href="{{ $isSwahili ? '/sw/news-events' : '/news-events' }}"
            class="block py-2 hover:text-tuico-navy"
        >
            {{ $isSwahili ? 'HABARI NA MATUKIO' : 'NEWS & EVENTS' }}
        </a>


        {{-- AFFILIATIONS --}}

        <a
            href="{{ $isSwahili ? '/sw/affiliations' : '/affiliations' }}"
            class="block py-2 hover:text-tuico-navy"
        >
            {{ $isSwahili ? 'WASHIRIKA' : 'AFFILIATIONS' }}
        </a>


        {{-- RESOURCES --}}

        <a
            href="{{ $isSwahili ? '/sw/resources' : '/resources' }}"
            class="block py-2 border-t border-gray-100 pt-2 mt-2 hover:text-tuico-navy"
        >
            {{ $isSwahili ? 'NYARAKA' : 'RESOURCES' }}
        </a>


        {{-- STRATEGIC PLAN --}}

        <a
            href="{{ $isSwahili ? '/sw/strategic-plan' : '/strategic-plan' }}"
            class="block py-2 hover:text-tuico-navy"
        >
            {{ $isSwahili ? 'MPANGO MKAKATI' : 'STRATEGIC PLAN' }}
        </a>


        {{-- INQUIRIES --}}

        <div class="border-t border-gray-100 pt-2 mt-2">

            <div class="py-2 text-tuico-navy">
                {{ $isSwahili ? 'MAWASILIANO' : 'INQUIRIES' }}
            </div>

            <a
                href="{{ $isSwahili ? '/sw/contact' : '/contact' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Tuma Swali / Ombi' : 'Send an Inquiry' }}
            </a>

            <a
                href="{{ $isSwahili ? '/sw/faq' : '/faq' }}"
                class="block py-2 pl-4 hover:text-tuico-navy"
            >
                {{ $isSwahili ? 'Maswali Yanayoulizwa Mara kwa Mara' : 'FAQs' }}
            </a>

        </div>


        {{-- JOIN US --}}

        <a
            href="{{ $isSwahili ? '/sw/join-us' : '/join-us' }}"
            class="block py-2 font-bold text-tuico-navy hover:text-tuico-sky"
        >
            {{ $isSwahili ? 'JIUNGE NASI' : 'JOIN US NOW' }}
        </a>


    </div>

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

<footer class="bg-gray-900 text-gray-300">

    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">


            {{-- GENERAL SECRETARY OFFICE --}}

            <div>

                <h4 class="text-white font-semibold text-lg mb-4">
                    {{ $isSwahili ? 'Ofisi ya Katibu Mkuu' : 'General Secretary Office' }}
                </h4>

                <div class="space-y-2 text-sm">

                    <p>
                        {{ $isSwahili
                            ? 'Chama cha Wafanyakazi wa Viwanda, Biashara, Taasisi za Fedha, Huduma na Ushauri (TUICO)'
                            : 'Tanzania Union of Industrial and Commercial Workers (TUICO)' }}
                    </p>

                    <p>
                        {{ $siteSettings->street_address }}
                    </p>

                    <p>
                        {{ $isSwahili ? 'S.L.P.' : 'P.O. Box' }}
                        {{ $siteSettings->po_box }}
                    </p>

                    <p>
                        <a
                            href="mailto:{{ $siteSettings->email }}"
                            class="hover:text-white transition"
                        >
                            {{ $siteSettings->email }}
                        </a>
                    </p>

                    <p>
                        <a
                            href="tel:{{ $siteSettings->phone }}"
                            class="hover:text-white transition"
                        >
                            {{ $siteSettings->phone }}
                        </a>
                    </p>

                    <p>
                        {{ $isSwahili ? 'Faksi:' : 'Fax:' }}
                        {{ $siteSettings->fax }}
                    </p>

                </div>

            </div>



            {{-- IMPORTANT LINKS --}}

            <div>

                <h4 class="text-white font-semibold text-lg mb-4">
                    {{ $isSwahili ? 'Viungo Muhimu' : 'Important Links' }}
                </h4>

                <ul class="space-y-2 text-sm">

                    @foreach ($footerImportantLinks as $link)

                        <li>

                            <a
                                href="{{ str_starts_with($link->url, 'http')
                                    ? $link->url
                                    : (app()->getLocale() === 'sw'
                                        ? '/sw' . $link->url
                                        : $link->url) }}"
                                @if (str_starts_with($link->url, 'http')) target="_blank" @endif
                                class="hover:text-white transition"
                            >
                                {{ $link->label }}
                            </a>

                        </li>

                    @endforeach


                    {{-- FAQ --}}

                    <li>

                        <a
                            href="{{ $isSwahili ? '/sw/faq' : '/faq' }}"
                            class="hover:text-white transition"
                        >
                            {{ $isSwahili ? 'Maswali Yanayoulizwa Mara kwa Mara' : 'FAQs' }}
                        </a>

                    </li>

                </ul>

            </div>



            {{-- QUICK LINKS --}}

            <div>

                <h4 class="text-white font-semibold text-lg mb-4">
                    {{ $isSwahili ? 'Viungo vya Haraka' : 'Quick Links' }}
                </h4>

                <ul class="space-y-2 text-sm">

                    @foreach ($footerPartnerLinks as $link)

                        <li>

                            <a
                                href="{{ str_starts_with($link->url, 'http')
                                    ? $link->url
                                    : (app()->getLocale() === 'sw'
                                        ? '/sw' . $link->url
                                        : $link->url) }}"
                                @if (str_starts_with($link->url, 'http')) target="_blank" @endif
                                class="hover:text-white transition"
                            >
                                {{ $link->label }}
                            </a>

                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>


    {{-- FOOTER CREDIT --}}

    <div class="border-t border-white/10">

        <div class="max-w-7xl mx-auto px-6 py-4 text-center text-xs sm:text-sm text-gray-400">
            {{ $siteSettings->footer_credit }}
        </div>

    </div>

</footer>



{{-- =========================================================
     BACK TO TOP
========================================================== --}}

<button
    type="button"
    x-show="showBackToTop"
    x-transition
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="fixed bottom-6 right-6 z-50 inline-flex items-center justify-center h-11 w-11 rounded-full bg-tuico-sky text-white shadow-lg hover:bg-tuico-navy focus:outline-none"
    aria-label="Back to top"
    style="display: none;"
>

    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M5 10l7-7m0 0l7 7m-7-7v18"
        />
    </svg>

</button>



<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</body>

</html>
