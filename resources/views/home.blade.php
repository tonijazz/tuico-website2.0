@extends('layouts.app')

@php
    $isSwahili = str_starts_with(request()->path(), 'sw/') || request()->path() === 'sw';
@endphp

@section('title', 'Home')

@section('content')


    {{-- =========================
     HERO SLIDER
========================== --}}

    @if ($slides->count())

        <section
            x-data="{ current: 0, total: {{ $slides->count() }} }"
            x-init="setInterval(() => { current = (current + 1) % total }, 6000)"
            class="relative overflow-hidden"
        >

            @foreach ($slides as $index => $slide)

                <div
                    x-show="current === {{ $index }}"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="relative min-h-[480px] md:min-h-[560px] bg-cover bg-center"
                    style="background-image: url('{{ asset('storage/' . $slide->image) }}')"
                >

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-950/90 via-blue-900/70 to-blue-900/20"></div>

                    {{-- Content --}}
                    <div
                        class="relative z-10 max-w-7xl mx-auto px-6 py-20 md:py-28 min-h-[480px] md:min-h-[560px] flex items-center"
                    >

                        <div class="max-w-2xl text-white">

                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                                {{ $slide->title }}
                            </h1>

                            @if ($slide->subtitle)

                                <p class="mt-5 text-lg md:text-xl text-blue-50 leading-relaxed max-w-xl">
                                    {{ $slide->subtitle }}
                                </p>

                            @endif

                            @if ($slide->cta_label && $slide->cta_url)

                                <div class="mt-8">

                                    <a
                                        href="{{ $slide->cta_url }}"
                                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md transition"
                                    >
                                        {{ $slide->cta_label }}

                                        <span class="ml-2 text-lg">→</span>
                                    </a>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach


            {{-- Slider indicators --}}
            @if ($slides->count() > 1)

                <div class="absolute bottom-6 left-0 right-0 z-20 flex justify-center gap-2">

                    @foreach ($slides as $index => $slide)

                        <button
                            type="button"
                            @click="current = {{ $index }}"
                            class="h-2.5 w-2.5 rounded-full border border-white transition"
                            :class="current === {{ $index }} ? 'bg-white' : 'bg-transparent'"
                            aria-label="Go to slide {{ $index + 1 }}"
                        ></button>

                    @endforeach

                </div>

            @endif

        </section>

    @endif


    {{-- =========================
     GENERAL SECRETARY + TUICO AT A GLANCE
========================== --}}

    <section class="grid grid-cols-1 lg:grid-cols-2">

        {{-- GENERAL SECRETARY MESSAGE --}}
        <div class="bg-blue-900 text-white px-6 py-10 md:px-12 md:py-12 lg:px-16">

            <div class="max-w-xl mx-auto lg:ml-auto lg:mr-0">

                @if ($featuredSecretaryGeneralMessage)

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">
                        {{ app()->getLocale() === 'sw' ? 'Ujumbe wa Katibu Mkuu' : 'Message from the General Secretary' }}
                    </p>

                    <h2 class="mt-3 text-3xl md:text-4xl font-bold leading-tight">
                        {{ $featuredSecretaryGeneralMessage->getTranslation('title', app()->getLocale()) }}
                    </h2>

                    @php
                        $messageExcerpt = \Illuminate\Support\Str::limit(
                            strip_tags($featuredSecretaryGeneralMessage->getTranslation('content', app()->getLocale())),
                            280,
                        );
                    @endphp

                    <p class="mt-6 text-blue-50 leading-relaxed">
                        {{ $messageExcerpt }}
                    </p>

                    <div class="mt-8">

                        <a
                            href="{{ $isSwahili ? '/sw/secretary-general-message' : '/secretary-general-message' }}"
                            class="inline-flex items-center font-semibold text-white hover:text-blue-200 transition"
                        >
                            {{ $isSwahili ? 'Soma ujumbe wote' : 'Read full message' }}
                            <span class="ml-2">→</span>
                        </a>

                    </div>

                @else

                    <p class="text-blue-200">
                        {{ $isSwahili
                            ? 'Hakuna ujumbe wa Katibu Mkuu kwa sasa.'
                            : 'No General Secretary message is currently available.' }}
                    </p>

                @endif

            </div>

        </div>


        {{-- TUICO AT A GLANCE --}}
        <div class="bg-white px-6 py-10 md:px-12 md:py-12 lg:px-16">

            <div class="max-w-xl mx-auto lg:ml-0 lg:mr-auto">

                <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                    {{ app()->getLocale() === 'sw' ? 'TUICO kwa Muhtasari' : 'TUICO at a Glance' }}
                </p>

                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-blue-950 leading-tight">
                    {{ app()->getLocale() === 'sw'
                        ? 'Imejengwa juu ya mshikamano. Imekita mizizi Tanzania.'
                        : 'Built on solidarity. Rooted in Tanzania.' }}
                </h2>

                <p class="mt-5 text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'sw'
                        ? 'Kwa zaidi ya miongo mitatu, TUICO imekuwa mstari wa mbele katika uwakilishi wa wafanyakazi, majadiliano ya pamoja na kazi zenye staha. Kuanzia Makao Makuu hadi mtandao wetu wa kanda na mikoa, tunaleta nguvu ya wafanyakazi waliopangwa karibu na maeneo ya kazi kote nchini.'
                        : "For more than three decades, TUICO has stood for workers' representation, collective bargaining and decent work. From our headquarters to our regional and zonal network, we bring the strength of organised workers closer to workplaces across the country." }}
                </p>

                <div class="mt-8 grid grid-cols-2 gap-6">

                    {{-- Founded --}}
                    <div class="border-l-4 border-blue-700 pl-4">

                        <div class="text-3xl md:text-4xl font-bold text-blue-900">
                            1995
                        </div>

                        <div class="mt-1 text-sm text-gray-600">
                            {{ app()->getLocale() === 'sw' ? 'Ilianzishwa' : 'Founded' }}
                        </div>

                    </div>


                    {{-- Zones --}}
                    <div class="border-l-4 border-blue-700 pl-4">

                        <div class="text-3xl md:text-4xl font-bold text-blue-900">
                            {{ $zonesCount }}
                        </div>

                        <div class="mt-1 text-sm text-gray-600">
                            {{ app()->getLocale() === 'sw' ? 'Kanda' : 'Zones' }}
                        </div>

                    </div>


                    {{-- Regional Offices --}}
                    <div class="border-l-4 border-blue-700 pl-4">

                        <div class="text-3xl md:text-4xl font-bold text-blue-900">
                            {{ $regionalOfficesCount }}
                        </div>

                        <div class="mt-1 text-sm text-gray-600">
                            {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices' }}
                        </div>

                    </div>


                    {{-- Sub-offices --}}
                    <div class="border-l-4 border-blue-700 pl-4">

                        <div class="text-3xl md:text-4xl font-bold text-blue-900">
                            {{ $subOfficesCount }}
                        </div>

                        <div class="mt-1 text-sm text-gray-600">
                            {{ app()->getLocale() === 'sw' ? 'Ofisi Ndogo' : 'Sub-offices' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
     MISSION & VISION
========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-12 md:px-12 md:py-16 lg:px-16">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">

                {{-- MISSION --}}
                <div class="bg-white p-8 md:p-10 border-t-4 border-blue-700 shadow-sm">

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                        {{ $isSwahili ? 'Dhamira' : 'Our Mission' }}
                    </p>

                    <h2 class="mt-3 text-2xl md:text-3xl font-bold text-blue-950">
                        {{ $isSwahili ? 'Dhamira Yetu' : 'Our Mission' }}
                    </h2>

                    <p class="mt-5 text-gray-600 leading-relaxed">
                        {{ $siteSettings->mission }}
                    </p>

                </div>


                {{-- VISION --}}
                <div class="bg-white p-8 md:p-10 border-t-4 border-blue-700 shadow-sm">

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                        {{ $isSwahili ? 'Dira' : 'Our Vision' }}
                    </p>

                    <h2 class="mt-3 text-2xl md:text-3xl font-bold text-blue-950">
                        {{ $isSwahili ? 'Dira Yetu' : 'Our Vision' }}
                    </h2>

                    <p class="mt-5 text-gray-600 leading-relaxed">
                        {{ $siteSettings->vision }}
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
     WHAT WE DO
========================== --}}

    <section class="bg-white">

        <div class="max-w-7xl mx-auto px-6 py-12 md:px-12 md:py-16 lg:px-16">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center">

                {{-- INTRODUCTION --}}
                <div>

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                        {{ $isSwahili ? 'Tunachofanya' : 'What We Do' }}
                    </p>

                    <h2 class="mt-3 text-3xl md:text-4xl lg:text-5xl font-bold leading-tight text-blue-950">
                        {{ $isSwahili
                            ? 'Tunageuza mshikamano kuwa nguvu ya wafanyakazi.'
                            : 'Turning solidarity into strength for workers.' }}
                    </h2>

                    <p class="mt-5 text-lg leading-relaxed text-gray-600">
                        {{ $isSwahili
                            ? 'TUICO inafanya kazi kulinda na kuendeleza maslahi ya wafanyakazi kupitia uwakilishi, majadiliano, elimu, msaada wa kisheria na ushirikiano na wadau mbalimbali.'
                            : 'TUICO works to protect and advance workers’ interests through representation, collective bargaining, education, legal support and engagement with key stakeholders.' }}
                    </p>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        {{ $isSwahili
                            ? 'Kazi hii inatekelezwa kupitia mtandao wetu wa viongozi, ofisi na wanachama katika sekta mbalimbali za uchumi.'
                            : 'This work is carried out through our network of leaders, offices and members across diverse sectors of the economy.' }}
                    </p>


                    {{-- AREAS OF WORK INDICATOR --}}
                    <div class="mt-6 flex items-center gap-4">

                        <div class="text-3xl font-bold text-blue-900">
                            06
                        </div>

                        <div class="h-8 w-px bg-gray-300"></div>

                        <div class="text-sm font-semibold uppercase tracking-wider text-gray-500">
                            {{ $isSwahili ? 'Maeneo ya Kazi' : 'Areas of Work' }}
                        </div>

                    </div>


                    <div class="mt-6">

                        <a
                            href="{{ $isSwahili ? '/sw/strategic-plan' : '/strategic-plan' }}"
                            class="inline-flex items-center font-semibold text-tuico-navy hover:text-blue-950 transition"
                        >
                            {{ $isSwahili ? 'Angalia maeneo yetu ya kimkakati' : 'Explore our strategic areas' }}
                            <span class="ml-2">→</span>
                        </a>

                    </div>

                </div>


                {{-- AREAS OF WORK --}}
                <div>

                    <div class="border-t border-gray-200">

                        {{-- ITEM 01 --}}
                        <div class="flex gap-4 py-3 border-b border-gray-200">

                            <div class="text-sm font-bold text-blue-700 pt-1">
                                01
                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-blue-950">
                                    {{ $isSwahili ? 'Uwakilishi wa Wafanyakazi' : 'Workers’ Representation' }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    {{ $isSwahili
                                        ? 'Kuwakilisha wafanyakazi na kuendeleza maslahi yao mahali pa kazi.'
                                        : 'Representing workers and advancing their interests in the workplace.' }}
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 02 --}}
                        <div class="flex gap-4 py-3 border-b border-gray-200">

                            <div class="text-sm font-bold text-blue-700 pt-1">
                                02
                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-blue-950">
                                    {{ $isSwahili ? 'Majadiliano ya Pamoja' : 'Collective Bargaining' }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    {{ $isSwahili
                                        ? 'Kushiriki katika majadiliano kuhusu mishahara, mazingira na masharti ya kazi.'
                                        : 'Supporting negotiations on wages, working conditions and terms of employment.' }}
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 03 --}}
                        <div class="flex gap-4 py-3 border-b border-gray-200">

                            <div class="text-sm font-bold text-blue-700 pt-1">
                                03
                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-blue-950">
                                    {{ $isSwahili ? 'Haki za Wafanyakazi' : 'Workers’ Rights' }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    {{ $isSwahili
                                        ? 'Kukuza haki mahali pa kazi, kazi zenye staha na mazingira salama ya kazi.'
                                        : 'Promoting workplace rights, decent work and safe working environments.' }}
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 04 --}}
                        <div class="flex gap-4 py-3 border-b border-gray-200">

                            <div class="text-sm font-bold text-blue-700 pt-1">
                                04
                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-blue-950">
                                    {{ $isSwahili ? 'Elimu na Ujenzi wa Uwezo' : 'Education & Capacity Building' }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    {{ $isSwahili
                                        ? 'Kuwawezesha wafanyakazi na viongozi kwa maarifa na ujuzi unaohitajika.'
                                        : 'Equipping workers and leaders with relevant knowledge and skills.' }}
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 05 --}}
                        <div class="flex gap-4 py-3 border-b border-gray-200">

                            <div class="text-sm font-bold text-blue-700 pt-1">
                                05
                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-blue-950">
                                    {{ $isSwahili ? 'Msaada wa Kisheria' : 'Legal Support' }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    {{ $isSwahili
                                        ? 'Kusaidia wafanyakazi katika masuala ya sheria za kazi na migogoro ya ajira.'
                                        : 'Supporting workers on labour matters, employment disputes and related legal issues.' }}
                                </p>

                            </div>

                        </div>


                        {{-- ITEM 06 --}}
                        <div class="flex gap-4 py-3 border-b border-gray-200">

                            <div class="text-sm font-bold text-blue-700 pt-1">
                                06
                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-blue-950">
                                    {{ $isSwahili ? 'Mazungumzo ya Kijamii' : 'Social Dialogue' }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    {{ $isSwahili
                                        ? 'Kushirikiana na waajiri, serikali na wadau wengine katika masuala ya ajira.'
                                        : 'Engaging employers, government and other stakeholders on employment matters.' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
     OUR SECTORS
========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-12 md:px-12 md:py-16 lg:px-16">

            <div class="text-center">

                <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                    {{ $isSwahili ? 'Sekta Zetu' : 'Our Sectors' }}
                </p>

                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-blue-950">
                    {{ $isSwahili ? 'Sekta Tunazowakilisha' : 'The Sectors We Represent' }}
                </h2>

            </div>


            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($sectors as $sector)

                    <a
                        href="{{ $isSwahili
                            ? '/sw/sectors/' . \Illuminate\Support\Str::slug($sector->getTranslation('name', 'en'))
                            : '/sectors/' . \Illuminate\Support\Str::slug($sector->getTranslation('name', 'en')) }}"
                        class="group bg-white border border-gray-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center bg-blue-50 text-blue-700 group-hover:bg-blue-700 group-hover:text-white transition"
                            >

                                {{-- INDUSTRIAL --}}
                                @if ($loop->iteration === 1)

                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M3 21h18M5 21V5l7-3 7 3v16M9 9h2m-2 4h2m2-4h2m-2 4h2"
                                        />
                                    </svg>

                                {{-- COMMERCIAL --}}
                                @elseif ($loop->iteration === 2)

                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M4 10h16M5 10v9h14v-9M4 10l2-5h12l2 5M8 14h3v5H8v-5M14 14h3v5h-3v-5"
                                        />
                                    </svg>

                                {{-- FINANCIAL INSTITUTIONS --}}
                                @elseif ($loop->iteration === 3)

                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M3 10h18L12 4 3 10zM5 10v8m4-8v8m6-8v8m4-8v8M3 18h18"
                                        />
                                    </svg>

                                {{-- SERVICES & CONSULTANCY --}}
                                @else

                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"
                                        />
                                    </svg>

                                @endif

                            </div>


                            <h3
                                class="text-lg font-bold text-blue-950 leading-tight group-hover:text-blue-700 transition"
                            >
                                {{ $sector->getTranslation('name', app()->getLocale()) }}
                            </h3>

                        </div>


                        <p class="mt-5 text-sm text-gray-600 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($sector->getTranslation('description', app()->getLocale()), 150) }}
                        </p>


                        <span class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700">

                            {{ $isSwahili ? 'Angalia Sekta' : 'View Sector' }}

                            <span class="ml-2 group-hover:translate-x-1 transition">
                                →
                            </span>

                        </span>

                    </a>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =========================
     LATEST NEWS
========================== --}}

    <section class="bg-white">

        <div class="max-w-7xl mx-auto px-6 py-12 md:px-12 md:py-16 lg:px-16">

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                        {{ $isSwahili ? 'Habari za Hivi Karibuni' : 'Latest News' }}
                    </p>

                    <h2 class="mt-3 text-3xl md:text-4xl font-bold text-blue-950">
                        {{ $isSwahili ? 'Habari na Matukio ya TUICO' : 'TUICO News & Updates' }}
                    </h2>

                </div>


                <a
                    href="{{ $isSwahili ? '/sw/news' : '/news' }}"
                    class="inline-flex items-center font-semibold text-blue-700 hover:text-blue-950 transition"
                >
                    {{ $isSwahili ? 'Angalia Habari Zote' : 'View All News' }}
                    <span class="ml-2">→</span>
                </a>

            </div>


            @if ($featuredNews->count())

                <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">

                    @foreach ($featuredNews as $news)

                        <article
                            class="group bg-white border border-gray-200 overflow-hidden hover:shadow-md transition duration-300"
                        >

                            {{-- IMAGE --}}
                            @if ($news->featured_image)

                                <div class="aspect-[16/9] overflow-hidden bg-gray-100">

                                    <img
                                        src="{{ asset('storage/' . $news->featured_image) }}"
                                        alt="{{ $news->getTranslation('title', app()->getLocale()) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    >

                                </div>

                            @else

                                <div class="aspect-[16/9] bg-blue-950 flex items-center justify-center">

                                    <span class="text-white text-sm font-semibold uppercase tracking-widest">
                                        TUICO
                                    </span>

                                </div>

                            @endif


                            {{-- CONTENT --}}
                            <div class="p-6">

                                @if ($news->published_at)

                                    <p class="text-xs font-semibold uppercase tracking-widest text-blue-700">
                                        {{ $news->published_at->format('d M Y') }}
                                    </p>

                                @endif


                                <h3
                                    class="mt-3 text-xl font-bold text-blue-950 leading-snug group-hover:text-blue-700 transition"
                                >
                                    {{ $news->getTranslation('title', app()->getLocale()) }}
                                </h3>


                                @if ($news->excerpt)

                                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($news->getTranslation('excerpt', app()->getLocale())), 120) }}
                                    </p>

                                @endif


                                <a
                                    href="{{ $isSwahili ? '/sw/news/' . $news->slug : '/news/' . $news->slug }}"
                                    class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700 hover:text-blue-950 transition"
                                >
                                    {{ $isSwahili ? 'Soma Zaidi' : 'Read More' }}
                                    <span class="ml-2 group-hover:translate-x-1 transition">
                                        →
                                    </span>
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="mt-10 border border-gray-200 bg-gray-50 px-6 py-10 text-center">

                    <p class="text-gray-600">
                        {{ $isSwahili
                            ? 'Hakuna habari zilizochapishwa kwa sasa.'
                            : 'No published news is currently available.' }}
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================
     AFFILIATIONS & PARTNERS
========================== --}}

    @if ($affiliations->count())

        <section class="bg-gray-50 border-t border-gray-200">

            <div class="max-w-7xl mx-auto px-6 py-12 md:px-12 md:py-16 lg:px-16">

                {{-- HEADER --}}
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                            {{ $isSwahili ? 'Mahusiano na Ushirikiano' : 'Affiliations & Partners' }}
                        </p>

                        <h2 class="mt-3 text-3xl md:text-4xl font-bold text-blue-950">
                            {{ $isSwahili ? 'Taasisi Tunazoshirikiana Nazo' : 'Our Affiliations & Partners' }}
                        </h2>

                    </div>


                    <a
                        href="{{ $isSwahili ? '/sw/affiliations' : '/affiliations' }}"
                        class="inline-flex items-center font-semibold text-blue-700 hover:text-blue-950 transition"
                    >
                        {{ $isSwahili ? 'Angalia Mahusiano Yote' : 'View All Affiliations' }}
                        <span class="ml-2">→</span>
                    </a>

                </div>


                {{-- CAROUSEL --}}
                <div
                    class="relative mt-10"
                    x-data="{
                        current: 0,
                        total: {{ $affiliations->count() }},
                        visible: 2,
                        cardWidth: 0,
                        timer: null,

                        updateLayout() {
                            this.visible = window.innerWidth >= 768 ? 4 : 2;

                            const viewport = this.$refs.viewport;

                            if (viewport) {
                                this.cardWidth = viewport.clientWidth / this.visible;
                            }

                            const maxIndex = Math.max(0, this.total - this.visible);

                            if (this.current > maxIndex) {
                                this.current = 0;
                            }
                        },

                        next() {
                            const maxIndex = Math.max(0, this.total - this.visible);

                            this.current = this.current >= maxIndex
                                ? 0
                                : this.current + 1;
                        },

                        previous() {
                            const maxIndex = Math.max(0, this.total - this.visible);

                            this.current = this.current <= 0
                                ? maxIndex
                                : this.current - 1;
                        },

                        start() {
                            this.stop();

                            this.timer = setInterval(() => {
                                this.next();
                            }, 4000);
                        },

                        stop() {
                            if (this.timer) {
                                clearInterval(this.timer);
                                this.timer = null;
                            }
                        }
                    }"
                    x-init="
                        updateLayout();
                        start();
                        window.addEventListener('resize', () => updateLayout());
                    "
                    @mouseenter="stop()"
                    @mouseleave="start()"
                >

                    {{-- PREVIOUS --}}
                    <button
                        type="button"
                        @click="previous()"
                        class="absolute left-0 top-1/2 -translate-y-1/2 z-10
                               -translate-x-3 md:-translate-x-5
                               h-10 w-10 rounded-full bg-white border border-gray-200
                               shadow-sm flex items-center justify-center
                               text-blue-950 hover:bg-blue-950 hover:text-white
                               transition"
                        aria-label="Previous affiliations"
                    >
                        ←
                    </button>


                    {{-- VIEWPORT --}}
                    <div
                        x-ref="viewport"
                        class="overflow-hidden px-2"
                    >

                        {{-- TRACK --}}
                        <div
                            class="flex transition-transform duration-700 ease-in-out"
                            :style="`transform: translateX(-${current * cardWidth}px);`"
                        >

                            @foreach ($affiliations as $affiliation)

                                <div
                                    class="flex-none w-1/2 md:w-1/4 px-2"
                                >

                                    <div
                                        class="h-40 bg-white border border-gray-200
                                               flex flex-col items-center justify-center
                                               px-5 py-6
                                               hover:border-blue-200 hover:shadow-md
                                               transition duration-300"
                                    >

                                        {{-- LOGO --}}
                                        <div class="h-20 w-full flex items-center justify-center">

                                            @if ($affiliation->logo)

                                                <img
                                                    src="{{ asset('storage/' . $affiliation->logo) }}"
                                                    alt="{{ $affiliation->name }}"
                                                    class="max-h-16 max-w-[150px] object-contain"
                                                >

                                            @else

                                                <span class="text-center text-sm font-bold text-blue-950 leading-snug">
                                                    {{ $affiliation->name }}
                                                </span>

                                            @endif

                                        </div>


                                        <div class="mt-3 text-center text-xs font-semibold text-gray-600">
                                            {{ $affiliation->name }}
                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- NEXT --}}
                    <button
                        type="button"
                        @click="next()"
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-10
                               translate-x-3 md:translate-x-5
                               h-10 w-10 rounded-full bg-white border border-gray-200
                               shadow-sm flex items-center justify-center
                               text-blue-950 hover:bg-blue-950 hover:text-white
                               transition"
                        aria-label="Next affiliations"
                    >
                        →
                    </button>

                </div>

            </div>

        </section>

    @endif


    {{-- =========================
     JOIN TUICO
========================== --}}

    <section class="bg-blue-950 text-white">

        <div class="max-w-7xl mx-auto px-6 py-14 md:px-12 md:py-18 lg:px-16">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">

                <div class="max-w-3xl">

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">
                        {{ $isSwahili ? 'Jiunge na TUICO' : 'Join TUICO' }}
                    </p>

                    <h2 class="mt-3 text-3xl md:text-4xl font-bold leading-tight">
                        {{ $isSwahili
                            ? 'Kuwa Sehemu ya Mshikamano wa Wafanyakazi'
                            : 'Be Part of the Workers’ Movement' }}
                    </h2>

                    <p class="mt-4 text-blue-100 text-base md:text-lg leading-relaxed">
                        {{ $isSwahili
                            ? 'Kwa maelezo kuhusu uanachama, huduma na jinsi ya kuwasiliana na TUICO, wasiliana nasi.'
                            : 'For information about membership, services and how to get in touch with TUICO, contact us.' }}
                    </p>

                </div>


                <div class="flex-shrink-0">

                    <a
                        href="{{ $isSwahili ? '/sw/join-us' : '/join-us' }}"
                        class="inline-flex items-center justify-center px-7 py-3.5
                               bg-white text-blue-950 font-bold
                               hover:bg-blue-50 transition duration-300"
                    >
                        {{ $isSwahili ? 'Jiunge Nasi' : 'Join Us' }}

                        <span class="ml-2">→</span>
                    </a>

                </div>

            </div>

        </div>

    </section>

@endsection
