<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'TUICO')</title>

    <meta name="description" content="@yield('meta_description', 'Tanzania Union of Industrial and Commercial Workers (TUICO) — representing workers across industries, commerce, financial institutions, services, and consultancy in Tanzania.')">

    <meta property="og:title" content="@yield('title', 'TUICO')">
    <meta property="og:description" content="@yield('meta_description', 'Tanzania Union of Industrial and Commercial Workers (TUICO)')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

</head>

<body class="bg-white text-gray-900">

    @php
        $currentPath = request()->path();

        $isSwahili = str_starts_with($currentPath, 'sw/') || $currentPath === 'sw';

        $basePath = $isSwahili ? substr($currentPath, 3) : $currentPath;
        $basePath = $basePath === '/' ? '' : $basePath;

        $englishUrl = '/' . $basePath;
        $swahiliUrl = $basePath === '' ? '/sw' : '/sw/' . $basePath;
    @endphp


    {{-- =========================================================
     UTILITY BAR
========================================================= --}}

    <div class="bg-blue-950 text-white">

        <div class="max-w-[1600px] mx-auto px-6">

            <div class="flex items-center justify-end h-9">

                <div class="flex items-center gap-5">

                    @if ($siteSettings->facebook_url)
                        <a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-100 hover:text-white transition" aria-label="Facebook">

                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.128 22 16.991 22 12z" />
                            </svg>

                        </a>
                    @endif

                    @if ($siteSettings->instagram_url)
                        <a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-100 hover:text-white transition" aria-label="Instagram">

                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-.1-.07-1.644-.07-4.849-.059-1.28-.073-1.689-.073-4.948 0-3.259.014-3.668.072-4.948.2-4.358 2.618-6.78 6.98-6.98 1.281-.058 1.689-.072 4.948-.072 3.259 0 3.668.014 4.948.072 4.354.2 6.782 2.618 6.98 6.98.059 1.28.073 1.689.073 4.948 0 3.204-.013 3.583-.07 4.849-.149 3.227-1.664 4.771-4.919 4.919-1.266.057-1.645.069-4.849.069zm0 5.838a6.163 6.163 0 100 12.326 6.163 6.163 0 000-12.326zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                            </svg>

                        </a>
                    @endif

                    @if ($siteSettings->youtube_url)
                        <a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-100 hover:text-white transition" aria-label="YouTube">

                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>

                        </a>
                    @endif

                    @if ($siteSettings->tiktok_url)
                        <a href="{{ $siteSettings->tiktok_url }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-100 hover:text-white transition" aria-label="TikTok">

                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>

                        </a>
                    @endif

                    @if ($siteSettings->linkedin_url)
                        <a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-100 hover:text-white transition" aria-label="LinkedIn">

                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>

                        </a>
                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
     BRANDING + NAVIGATION
========================================================= --}}

    <header class="bg-white shadow-sm" x-data="{ mobileOpen: false }">

        {{-- BRANDING AREA --}}

        <div class="bg-white">

            <div class="max-w-[1600px] mx-auto px-4 sm:px-6">

                <div class="flex items-center min-h-28 py-5">

                    {{-- LOGO --}}

                    <a href="{{ $isSwahili ? '/sw' : '/' }}" class="shrink-0">

                        @if ($siteSettings->logo)
                            <img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="TUICO"
                                class="h-24 w-auto object-contain">
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
                                class="font-sans text-base sm:text-lg lg:text-2xl font-medium leading-snug tracking-wide text-tuico-navy">
                                Tanzania Union of Industrial and Commercial Workers (TUICO)
                            </div>

                            {{-- SWAHILI SUB --}}

                            <div
                                class="hidden lg:block mt-2 font-sans text-sm font-normal leading-relaxed tracking-wide text-gray-500">
                                Chama cha Wafanyakazi wa Viwanda, Biashara, Taasisi za Fedha, Huduma na Ushauri (TUICO)
                            </div>
                        @else
                            {{-- SWAHILI MAIN --}}

                            <div
                                class="font-sans text-base sm:text-lg lg:text-2xl font-medium leading-snug tracking-wide text-tuico-navy">
                                Chama cha Wafanyakazi wa Viwanda, Biashara, Taasisi za Fedha, Huduma na Ushauri (TUICO)
                            </div>

                            {{-- ENGLISH SUB --}}

                            <div
                                class="hidden lg:block mt-2 font-sans text-sm font-normal leading-relaxed tracking-wide text-gray-500">
                                Tanzania Union of Industrial and Commercial Workers (TUICO)
                            </div>
                        @endif

                    </div>


                    {{-- MOBILE MENU BUTTON --}}

                    <div class="lg:hidden ml-2 shrink-0 relative z-50">

                        <button type="button" @click="mobileOpen = !mobileOpen"
                            class="inline-flex items-center justify-center p-2 text-tuico-navy hover:text-tuico-blue focus:outline-none"
                            aria-label="Toggle navigation">

                            {{-- HAMBURGER --}}

                            <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>


                            {{-- CLOSE ICON --}}

                            <svg x-show="mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
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

                        <a href="{{ $isSwahili ? '/sw' : '/' }}" class="transition hover:text-blue-800">
                            {{ $isSwahili ? 'NYUMBANI' : 'HOME' }}
                        </a>


                        {{-- ABOUT US --}}

                        <div class="relative" x-data="{ open: false }">

                            <button type="button" @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-1 transition hover:text-blue-800">

                                {{ $isSwahili ? 'KUHUSU SISI' : 'ABOUT US' }}

                                <span class="text-xs">▾</span>

                            </button>

                            <div x-show="open" x-transition class="absolute left-0 top-full pt-3 z-50"
                                style="display: none;">

                                <div class="w-56 bg-white rounded-md shadow-lg border border-gray-100 py-2">

                                    <a href="{{ $isSwahili ? '/sw/about#who-we-are' : '/about#who-we-are' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Sisi ni Nani' : 'Who We Are' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/about#history' : '/about#history' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Historia' : 'History' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/about#structure-meetings' : '/about#structure-meetings' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Muundo na Mikutano' : 'Structure & Meetings' }}
                                    </a>

                                </div>

                            </div>

                        </div>


                        {{-- ORGANIZATION --}}

                        <div class="relative" x-data="{ open: false }">

                            <button type="button" @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-1 transition hover:text-blue-800">

                                {{ $isSwahili ? 'UONGOZI' : 'ORGANIZATION' }}

                                <span class="text-xs">▾</span>

                            </button>

                            <div x-show="open" x-transition class="absolute left-0 top-full pt-3 z-50"
                                style="display: none;">

                                <div class="w-56 bg-white rounded-md shadow-lg border border-gray-100 py-2">

                                    <a href="{{ $isSwahili ? '/sw/leadership' : '/leadership' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Uongozi Taifa' : 'Leadership' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/sectors' : '/sectors' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Sekta' : 'Sectors' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/departments' : '/departments' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Idara' : 'Departments' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/units' : '/units' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Vitengo' : 'Units' }}
                                    </a>

                                </div>

                            </div>

                        </div>


                        {{-- OFFICES --}}

                        <div class="relative" x-data="{ open: false }">

                            <button type="button" @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-1 transition hover:text-blue-800">

                                {{ $isSwahili ? 'OFISI' : 'OFFICES' }}

                                <span class="text-xs">▾</span>

                            </button>

                            <div x-show="open" x-transition class="absolute left-0 top-full pt-3 z-50"
                                style="display: none;">

                                <div class="w-48 bg-white rounded-md shadow-lg border border-gray-100 py-2">

                                    <a href="{{ $isSwahili ? '/sw/zones' : '/zones' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Kanda' : 'Zones' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/regions' : '/regions' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Mikoa' : 'Regions' }}
                                    </a>

                                </div>

                            </div>

                        </div>


                        {{-- NEWS & EVENTS --}}

                        <a href="{{ $isSwahili ? '/sw/news-events' : '/news-events' }}"
                            class="transition hover:text-blue-800">
                            {{ $isSwahili ? 'HABARI & MATUKIO' : 'NEWS & EVENTS' }}
                        </a>


                        {{-- RESOURCES --}}

                        <div class="relative" x-data="{ open: false }">

                            <button type="button" @click="open = !open" @click.outside="open = false"
                                class="flex items-center gap-1 transition hover:text-blue-800">

                                {{ $isSwahili ? 'NYARAKA' : 'RESOURCES' }}

                                <span class="text-xs">▾</span>

                            </button>

                            <div x-show="open" x-transition class="absolute left-0 top-full pt-3 z-50"
                                style="display: none;">

                                <div class="w-56 bg-white rounded-md shadow-lg border border-gray-100 py-2">

                                    <a href="{{ $isSwahili ? '/sw/resources' : '/resources' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Rasilimali' : 'Resources' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/resources' : '/resources' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Machapisho' : 'Publications' }}
                                    </a>

                                    <a href="{{ $isSwahili ? '/sw/faq' : '/faq' }}"
                                        class="block px-4 py-3 text-sm hover:bg-gray-50 hover:text-blue-800">
                                        {{ $isSwahili ? 'Maswali Yanayoulizwa Mara kwa Mara' : 'FAQs' }}
                                    </a>

                                </div>

                            </div>

                        </div>


                        {{-- AFFILIATIONS --}}

                        <a href="{{ $isSwahili ? '/sw/affiliations' : '/affiliations' }}"
                            class="transition hover:text-blue-800">
                            {{ $isSwahili ? 'WASHIRIKA' : 'AFFILIATIONS' }}
                        </a>


                        {{-- STRATEGIC PLAN --}}

                        <a href="{{ $isSwahili ? '/sw/strategic-plan' : '/strategic-plan' }}"
                            class="transition hover:text-blue-800">
                            {{ $isSwahili ? 'MPANGO MKAKATI' : 'STRATEGIC PLAN' }}
                        </a>


                        {{-- CONTACT --}}

                        <a href="{{ $isSwahili ? '/sw/contact' : '/contact' }}"
                            class="transition hover:text-blue-800">
                            {{ $isSwahili ? 'WASILIANA NASI' : 'CONTACT US' }}
                        </a>


                        {{-- JOIN US --}}

                        <a href="{{ $isSwahili ? '/sw/join-us' : '/join-us' }}"
                            class="rounded-md bg-blue-800 px-4 py-2 text-white text-sm transition hover:bg-blue-900 whitespace-nowrap">
                            {{ $isSwahili ? 'JIUNGE NASI' : 'JOIN US NOW' }}
                        </a>


                        {{-- LANGUAGE SWITCHER --}}

                        <div class="flex items-center gap-2 ml-2 text-sm font-medium whitespace-nowrap">

                            <a href="{{ $englishUrl }}"
                                class="{{ !$isSwahili ? 'font-bold text-blue-800' : 'text-gray-400 hover:text-blue-800' }}">
                                EN
                            </a>

                            <span class="text-gray-300">|</span>

                            <a href="{{ $swahiliUrl }}"
                                class="{{ $isSwahili ? 'font-bold text-blue-800' : 'text-gray-400 hover:text-blue-800' }}">
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

        <div x-show="mobileOpen" x-cloak
            class="lg:hidden border-t border-gray-100 px-6 pb-4 pt-2 space-y-1 text-sm font-semibold text-gray-700">

            <a href="{{ $isSwahili ? '/sw' : '/' }}" class="block py-2">
                {{ $isSwahili ? 'NYUMBANI' : 'HOME' }}
            </a>


            {{-- ABOUT US --}}

            <div class="border-t border-gray-100 pt-2 mt-2">

                <div class="py-2 text-gray-900">
                    {{ $isSwahili ? 'KUHUSU SISI' : 'ABOUT US' }}
                </div>

                <a href="{{ $isSwahili ? '/sw/about#who-we-are' : '/about#who-we-are' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Sisi ni Nani' : 'Who We Are' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/about#history' : '/about#history' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Historia' : 'History' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/about#structure-meetings' : '/about#structure-meetings' }}"
                    class="block py-2 pl-4">
                    {{ $isSwahili ? 'Muundo na Mikutano' : 'Structure & Meetings' }}
                </a>

            </div>


            {{-- ORGANIZATION --}}

            <div class="border-t border-gray-100 pt-2 mt-2">

                <div class="py-2 text-gray-900">
                    {{ $isSwahili ? 'UONGOZI' : 'ORGANIZATION' }}
                </div>

                <a href="{{ $isSwahili ? '/sw/leadership' : '/leadership' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Uongozi Taifa' : 'Leadership' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/sectors' : '/sectors' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Sekta' : 'Sectors' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/departments' : '/departments' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Idara' : 'Departments' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/units' : '/units' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Vitengo' : 'Units' }}
                </a>

            </div>


            {{-- OFFICES --}}

            <div class="border-t border-gray-100 pt-2 mt-2">

                <div class="py-2 text-gray-900">
                    {{ $isSwahili ? 'OFISI' : 'OFFICES' }}
                </div>

                <a href="{{ $isSwahili ? '/sw/zones' : '/zones' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Kanda' : 'Zones' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/regions' : '/regions' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Mikoa' : 'Regions' }}
                </a>

            </div>


            {{-- NEWS & EVENTS --}}

            <a href="{{ $isSwahili ? '/sw/news-events' : '/news-events' }}" class="block py-2">
                {{ $isSwahili ? 'HABARI NA MATUKIO' : 'NEWS & EVENTS' }}
            </a>


            {{-- RESOURCES --}}

            <div class="border-t border-gray-100 pt-2 mt-2">

                <div class="py-2 text-gray-900">
                    {{ $isSwahili ? 'RASILIMALI' : 'RESOURCES' }}
                </div>

                <a href="{{ $isSwahili ? '/sw/resources' : '/resources' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Rasilimali' : 'Resources' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/resources' : '/resources' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Machapisho' : 'Publications' }}
                </a>

                <a href="{{ $isSwahili ? '/sw/faq' : '/faq' }}" class="block py-2 pl-4">
                    {{ $isSwahili ? 'Maswali Yanayoulizwa Mara kwa Mara' : 'FAQs' }}
                </a>

            </div>


            {{-- OTHER LINKS --}}

            <a href="{{ $isSwahili ? '/sw/affiliations' : '/affiliations' }}" class="block py-2">
                {{ $isSwahili ? 'WASHIRIKA' : 'AFFILIATIONS' }}
            </a>

            <a href="{{ $isSwahili ? '/sw/strategic-plan' : '/strategic-plan' }}" class="block py-2">
                {{ $isSwahili ? 'MPANGO MKAKATI' : 'STRATEGIC PLAN' }}
            </a>

            <a href="{{ $isSwahili ? '/sw/contact' : '/contact' }}" class="block py-2">
                {{ $isSwahili ? 'WASILIANA NASI' : 'CONTACT US' }}
            </a>

            <a href="{{ $isSwahili ? '/sw/join-us' : '/join-us' }}" class="block py-2 font-bold text-blue-800">
                {{ $isSwahili ? 'JIUNGE NASI' : 'JOIN US NOW' }}
            </a>


            {{-- MOBILE LANGUAGE SWITCHER --}}

            <div class="border-t border-gray-100 mt-2 pt-3 flex items-center gap-2">

                <a href="{{ $englishUrl }}"
                    class="{{ !$isSwahili ? 'font-bold text-blue-800' : 'text-gray-400 hover:text-blue-800' }}">
                    EN
                </a>

                <span class="text-gray-300">|</span>

                <a href="{{ $swahiliUrl }}"
                    class="{{ $isSwahili ? 'font-bold text-blue-800' : 'text-gray-400 hover:text-blue-800' }}">
                    SW
                </a>

            </div>

        </div>

    </header>


    {{-- =========================================================
     MAIN CONTENT
========================================================= --}}

    <main>
        @yield('content')
    </main>


    {{-- =========================================================
     FOOTER
========================================================= --}}

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
                                ? 'Chama cha Wafanyakazi wa Viwanda, Biashara, Taasisi za Fedha Huduma na Ushauri (TUICO)'
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
                            <a href="mailto:{{ $siteSettings->email }}" class="hover:text-white transition">
                                {{ $siteSettings->email }}
                            </a>
                        </p>

                        <p>
                            <a href="tel:{{ $siteSettings->phone }}" class="hover:text-white transition">
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

                                <a href="{{ str_starts_with($link->url, 'http')
                                    ? $link->url
                                    : (app()->getLocale() === 'sw'
                                        ? '/sw' . $link->url
                                        : $link->url) }}"
                                    @if (str_starts_with($link->url, 'http')) target="_blank" @endif
                                    class="hover:text-white transition">

                                    {{ $link->label }}

                                </a>

                            </li>
                        @endforeach

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

                                <a href="{{ str_starts_with($link->url, 'http')
                                    ? $link->url
                                    : (app()->getLocale() === 'sw'
                                        ? '/sw' . $link->url
                                        : $link->url) }}"
                                    @if (str_starts_with($link->url, 'http')) target="_blank" @endif
                                    class="hover:text-white transition">

                                    {{ $link->label }}

                                </a>

                            </li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    </footer>
   <script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
></script>
</body>

</html>
