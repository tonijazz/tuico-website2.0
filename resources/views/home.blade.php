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
        class="relative overflow-hidden min-h-[480px] md:min-h-[560px]"
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
                class="absolute inset-0 bg-cover bg-center"
                style="{{ $index > 0 ? 'display: none; ' : '' }}background-image: url('{{ asset('storage/' . $slide->image) }}')"
            >

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-blue-950/90 via-blue-900/70 to-blue-900/20"></div>

                {{-- Content --}}
                <div
                    class="relative z-10 max-w-7xl mx-auto px-6 py-10 md:py-12 min-h-[480px] md:min-h-[560px] flex items-center"
                >

                    <div class="max-w-2xl text-white">

                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight line-clamp-3">
                            {{ $slide->title }}
                        </h1>

                        @if ($slide->subtitle)

                            <p class="mt-5 text-lg md:text-xl text-blue-50 leading-relaxed max-w-xl line-clamp-4">
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
 GENERAL SECRETARY + STANDING TOGETHER


========================== --}}


<section class="grid grid-cols-1 lg:grid-cols-2">

    {{-- GENERAL SECRETARY MESSAGE --}}
    <div class="bg-blue-900 text-white px-6 py-8 md:px-12 md:py-10 lg:px-16">

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


    {{-- STANDING TOGETHER --}}
    <div class="bg-white px-6 py-8 md:px-12 md:py-10 lg:px-16">

        <div class="max-w-xl mx-auto lg:ml-0 lg:mr-auto">

            <h2 class="text-3xl md:text-4xl font-bold text-blue-950 leading-tight">
                {{ $isSwahili ? 'Pamoja kwa maslahi bora ya wafanyakazi' : 'Standing together for better working lives' }}
            </h2>

            <p class="mt-5 text-gray-600 leading-relaxed">
                {{ $isSwahili
                    ? 'TUICO ni chama huru cha wafanyakazi katika sekta za viwanda, biashara, taasisi za fedha, na huduma na ushauri. Kupitia matawi yetu mahali pa kazi na ofisi za mikoa, wanachama huhamasishana, huwasilisha hoja zao na hushiriki katika majadiliano ya pamoja ili kuboresha masharti na mazingira ya kazi.'
                    : 'TUICO is an independent trade union for workers in industry, commerce, financial institutions, and services and consultancy. Through our workplace branches and regional offices, members organise, raise concerns and bargain together for better terms and conditions of employment.' }}
            </p>

            <div class="mt-6 grid grid-cols-2 gap-5">

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

            <div class="mt-6 flex flex-col sm:flex-row gap-3">

                <a
                    href="{{ $isSwahili ? '/sw/join-us' : '/join-us' }}"
                    class="inline-flex w-full sm:w-auto items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md border border-blue-600 hover:border-blue-700 transition"
                >
                    {{ $isSwahili ? 'Jiunge na TUICO' : 'Join TUICO' }}

                    <span class="ml-2 text-lg">→</span>
                </a>

                <a
                    href="{{ $isSwahili ? '/sw/regions' : '/regions' }}"
                    class="inline-flex w-full sm:w-auto items-center justify-center bg-white text-blue-800 hover:bg-blue-50 font-semibold px-6 py-3 rounded-md border border-blue-700 transition"
                >
                    {{ $isSwahili ? 'Tafuta ofisi ya mkoa wako' : 'Find your regional office' }}

                    <span class="ml-2 text-lg">→</span>
                </a>

            </div>

        </div>

    </div>

</section>


{{-- =========================
 WHAT WE DO


========================== --}}


@php
    $pillars = [
        [
            'number' => '01',
            'title_en' => 'Representation',
            'title_sw' => 'Uwakilishi',
            'text_en' => "Your workplace representative or regional office can help you raise a concern, understand your rights or seek support with a workplace dispute. TUICO also trains members and representatives to take part in workplace decisions.",
            'text_sw' => "Mwakilishi wako mahali pa kazi au ofisi ya mkoa inaweza kukusaidia kuwasilisha hoja, kuelewa haki zako au kupata msaada katika mgogoro wa kazi. TUICO pia hutoa mafunzo kwa wanachama na wawakilishi ili waweze kushiriki katika maamuzi mahali pa kazi.",
        ],
        [
            'number' => '02',
            'title_en' => 'Influence',
            'title_sw' => 'Ushawishi',
            'text_en' => "We bring workers' concerns into negotiations with employers and into dialogue with government and other labour stakeholders. We work with trade unions in Tanzania and internationally on issues workers share.",
            'text_sw' => "Tunawasilisha hoja za wafanyakazi katika majadiliano na waajiri, serikali na wadau wengine wa masuala ya kazi. Tunashirikiana na vyama vya wafanyakazi nchini Tanzania na kimataifa katika masuala yanayowahusu wafanyakazi kwa pamoja.",
        ],
        [
            'number' => '03',
            'title_en' => 'Results',
            'title_sw' => 'Matokeo',
            'text_en' => "Follow updates on collective bargaining agreements and other documented outcomes for workers. Our Strategic Plan 2026-2030 sets out what TUICO aims to achieve during the period.",
            'text_sw' => "Fuatilia taarifa kuhusu Mikataba ya Hali Bora na matokeo mengine yaliyothibitishwa kwa wafanyakazi. Mpango Mkakati wa TUICO wa 2026-2030 unaeleza malengo ambayo Chama kimejiwekea kwa kipindi hicho.",
        ],
    ];
@endphp


<section class="bg-white">

    <div class="max-w-7xl mx-auto px-6 py-8 md:px-12 md:py-10 lg:px-16">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 items-start">

            {{-- INTRODUCTION --}}
            <div>

                <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                    {{ $isSwahili ? 'Tunachofanya' : 'What We Do' }}
                </p>

                <h2 class="mt-3 text-3xl md:text-4xl lg:text-5xl font-bold leading-tight text-blue-950">
                    {{ $isSwahili ? 'Uwakilishi. Ushawishi. Matokeo.' : 'Representation. Influence. Results.' }}
                </h2>


                <div class="mt-6">

                    <a
                        href="{{ $isSwahili ? '/sw/news' : '/news' }}"
                        class="inline-flex items-center font-semibold text-tuico-navy hover:text-blue-950 transition"
                    >
                        {{ $isSwahili ? 'Soma habari za TUICO' : 'Read TUICO news' }}
                        <span class="ml-2">→</span>
                    </a>

                </div>

                <div class="mt-3">

                    <a
                        href="{{ $isSwahili ? '/sw/strategic-plan' : '/strategic-plan' }}"
                        class="inline-flex items-center font-semibold text-tuico-navy hover:text-blue-950 transition"
                    >
                        {{ $isSwahili ? 'Tazama Mpango Mkakati' : 'Explore the strategic plan' }}
                        <span class="ml-2">→</span>
                    </a>

                </div>

            </div>


            {{-- PILLARS --}}
            <div>

                <div class="border-t border-gray-200">

                    @foreach ($pillars as $pillar)

                        <div class="flex gap-4 py-3 border-b border-gray-200">

                            <div class="w-6 shrink-0 text-sm font-bold text-blue-700 pt-1">
                                {{ $pillar['number'] }}
                            </div>

                            <div>

                                <h3 class="text-lg font-bold text-blue-950">
                                    {{ $isSwahili ? $pillar['title_sw'] : $pillar['title_en'] }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                                    {{ $isSwahili ? $pillar['text_sw'] : $pillar['text_en'] }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================
 OUR SECTORS


========================== --}}


<section class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-6 py-8 md:px-12 md:py-10 lg:px-16">

        <div class="text-center">

            <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">
                {{ $isSwahili ? 'Sekta Zetu' : 'Our Sectors' }}
            </p>

            <h2 class="mt-3 text-3xl md:text-4xl font-bold text-blue-950">
                {{ $isSwahili ? 'Tambua sekta yako' : 'Find your sector' }}
            </h2>

        </div>


        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

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

        <p class="mt-5 text-center text-sm text-gray-500">
            {{ $isSwahili
                ? 'Kama hujui sekta au ofisi inayohudumia eneo lako la kazi, wasiliana na '
                : 'If you are unsure which sector or office covers your workplace, contact your ' }}<a
                href="{{ $isSwahili ? '/sw/regions' : '/regions' }}"
                class="underline underline-offset-2 hover:text-blue-700 transition"
            >{{ $isSwahili ? 'ofisi ya TUICO iliyo karibu nawe' : 'nearest TUICO office' }}</a>.
        </p>

    </div>

</section>


{{-- =========================
 LATEST NEWS


========================== --}}


<section class="bg-white">

    <div class="max-w-7xl mx-auto px-6 py-8 md:px-12 md:py-10 lg:px-16">

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

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">

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

            <div class="mt-6 border border-gray-200 bg-gray-50 px-6 py-10 text-center">

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

        <div class="max-w-7xl mx-auto px-6 py-8 md:px-12 md:py-10 lg:px-16">

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
                class="relative mt-6"
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

                            @php
                                $affiliationAttributes = $affiliation->getAttributes();
                                $affiliationUrl = null;

                                foreach (['website_url', 'url', 'website', 'link'] as $field) {
                                    if (! empty($affiliationAttributes[$field])) {
                                        $affiliationUrl = $affiliationAttributes[$field];
                                        break;
                                    }
                                }

                                if ($affiliationUrl && ! preg_match('#^https?://#i', $affiliationUrl)) {
                                    $affiliationUrl = 'https://' . $affiliationUrl;
                                }

                                $affiliationCardClasses = 'h-40 bg-white border border-gray-200 flex flex-col items-center justify-center px-5 py-6 hover:border-blue-200 hover:shadow-md transition duration-300';
                            @endphp

                            <div
                                class="flex-none w-1/2 md:w-1/4 px-2"
                            >

                                @if ($affiliationUrl)

                                    <a
                                        href="{{ $affiliationUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="{{ $affiliation->name }}"
                                        class="{{ $affiliationCardClasses }} focus:outline-none focus:ring-2 focus:ring-blue-600"
                                    >

                                @else

                                    <div class="{{ $affiliationCardClasses }}">

                                @endif

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

                                @if ($affiliationUrl)
                                    </a>
                                @else
                                    </div>
                                @endif

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

    <div class="max-w-7xl mx-auto px-6 py-8 md:px-12 md:py-10 lg:px-16">

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
                    {{ $isSwahili ? 'Jiunge na TUICO' : 'Join TUICO' }}

                    <span class="ml-2">→</span>
                </a>

            </div>

        </div>

    </div>

</section>


@endsection
