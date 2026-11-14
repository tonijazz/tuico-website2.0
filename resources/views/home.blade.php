@extends('layouts.app')

@use('Illuminate\Support\Str')

@php
    /*
    |--------------------------------------------------------------------------
    | Helpers (move to app/helpers.php once the layout and other pages share them)
    |--------------------------------------------------------------------------
    */
    $locale = app()->getLocale();
    $isSwahili = $locale === 'sw';

    /*
    |--------------------------------------------------------------------------
    | Shared class strings (palette: main, action, chrome)
    |--------------------------------------------------------------------------
    */
    $container = 'max-w-7xl mx-auto px-6 py-8 md:px-12 md:py-10 lg:px-16';
    $eyebrow = 'text-sm font-semibold uppercase tracking-widest';
    $heading = 'text-3xl md:text-4xl font-bold leading-tight';

    // Solid button on light backgrounds
    $btnPrimary =
        'inline-flex w-full sm:w-auto items-center justify-center bg-action hover:bg-main text-white font-semibold px-6 py-3 rounded-md border border-action hover:border-main transition';
    // Outline button on light backgrounds
    $btnOutline =
        'inline-flex w-full sm:w-auto items-center justify-center bg-white text-action hover:bg-action/10 font-semibold px-6 py-3 rounded-md border border-action transition';
    // Button on dark (main) backgrounds
    $btnLight =
        'inline-flex items-center justify-center bg-white text-main hover:bg-white/90 font-semibold px-6 py-3 rounded-md transition';
    // Text link on light backgrounds
    $link = 'inline-flex items-center font-semibold text-action hover:text-main transition';

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */
    $stats = [
        ['value' => '1995', 'label' => localized('Founded', 'Ilianzishwa')],
        ['value' => $zonesCount, 'label' => localized('Zones', 'Kanda')],
        ['value' => $regionalOfficesCount, 'label' => localized('Regional Offices', 'Ofisi za Mikoa')],
        ['value' => $subOfficesCount, 'label' => localized('Sub-offices', 'Ofisi Ndogo')],
    ];

    $pillars = [
        [
            'number' => '01',
            'title' => localized('Representation', 'Uwakilishi'),
            'text' => localized(
                'Your workplace representative or regional office can help you raise a concern, understand your rights or seek support with a workplace dispute. TUICO also trains members and representatives to take part in workplace decisions.',
                'Mwakilishi wako mahali pa kazi au ofisi ya mkoa inaweza kukusaidia kuwasilisha hoja, kuelewa haki zako au kupata msaada katika mgogoro wa kazi. TUICO pia hutoa mafunzo kwa wanachama na wawakilishi ili waweze kushiriki katika maamuzi mahali pa kazi.',
            ),
        ],
        [
            'number' => '02',
            'title' => localized('Influence', 'Ushawishi'),
            'text' => localized(
                'We bring workers\' concerns into negotiations with employers and into dialogue with government and other labour stakeholders. We work with trade unions in Tanzania and internationally on issues workers share.',
                'Tunawasilisha hoja za wafanyakazi katika majadiliano na waajiri, serikali na wadau wengine wa masuala ya kazi. Tunashirikiana na vyama vya wafanyakazi nchini Tanzania na kimataifa katika masuala yanayowahusu wafanyakazi kwa pamoja.',
            ),
        ],
        [
            'number' => '03',
            'title' => localized('Results', 'Matokeo'),
            'text' => localized(
                'Follow updates on collective bargaining agreements and other documented outcomes for workers. Our Strategic Plan 2026-2030 sets out what TUICO aims to achieve during the period.',
                'Fuatilia taarifa kuhusu Mikataba ya Hali Bora na matokeo mengine yaliyothibitishwa kwa wafanyakazi. Mpango Mkakati wa TUICO wa 2026-2030 unaeleza malengo ambayo Chama kimejiwekea kwa kipindi hicho.',
            ),
        ],
    ];

    // Sector icons by position: industrial, commercial, financial, services.
    // TODO: replace with an `icon` column on the Sector model so reordering never swaps icons.
    $sectorIcons = [
        'M3 21h18M5 21V5l7-3 7 3v16M9 9h2m-2 4h2m2-4h2m-2 4h2',
        'M4 10h16M5 10v9h14v-9M4 10l2-5h12l2 5M8 14h3v5H8v-5M14 14h3v5h-3v-5',
        'M3 10h18L12 4 3 10zM5 10v8m4-8v8m6-8v8m4-8v8M3 18h18',
        'M13 10V3L4 14h7v7l9-11h-7z',
    ];
@endphp

@section('title', 'TUICO Tanzania')

@section('content')

    {{-- =========================
         HERO SLIDER
    ========================== --}}
    @if ($slides->count())
        <section x-data="{ current: 0, total: {{ $slides->count() }} }" x-init="setInterval(() => { current = (current + 1) % total }, 6000)"
            class="relative overflow-hidden min-h-[480px] md:min-h-[560px]">

            @foreach ($slides as $index => $slide)
                <div x-show="current === {{ $index }}" x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="absolute inset-0 bg-cover bg-center"
                    style="{{ $index > 0 ? 'display: none; ' : '' }}background-image: url('{{ asset('storage/' . $slide->image) }}')">

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-main/90 via-main/70 to-main/20"></div>

                    {{-- Content --}}
                    <div
                        class="relative z-10 max-w-7xl mx-auto px-6 py-10 md:py-12 min-h-[480px] md:min-h-[560px] flex items-center">
                        <div class="max-w-2xl text-white">

                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight line-clamp-3">
                                {{ $slide->title }}
                            </h1>

                            @if ($slide->subtitle)
                                <p class="mt-5 text-lg md:text-xl text-white/90 leading-relaxed max-w-xl line-clamp-4">
                                    {{ $slide->subtitle }}
                                </p>
                            @endif

                            @if ($slide->cta_label && $slide->cta_url)
                                <div class="mt-8">
                                    <a href="{{ $slide->cta_url }}" class="{{ $btnLight }}">
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
                        <button type="button" @click="current = {{ $index }}"
                            class="h-2.5 w-2.5 rounded-full border border-white transition"
                            :class="current === {{ $index }} ? 'bg-white' : 'bg-transparent'"
                            aria-label="Go to slide {{ $index + 1 }}"></button>
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
        <div class="bg-main text-white px-6 py-8 md:px-12 md:py-10 lg:px-16">
            <div class="max-w-xl mx-auto lg:ml-auto lg:mr-0">

                @if ($featuredSecretaryGeneralMessage)
                    @php
                        $messageContent = $featuredSecretaryGeneralMessage->getTranslation('content', $locale);

                        $messageExcerpt = Str::limit(
                            trim(strip_tags(preg_replace('/<\/(p|div|h[1-6]|li)>|<br\s*\/?>/i', "\n", $messageContent))),
                            280,
                        );
                    @endphp

                    <p class="{{ $eyebrow }} text-white/70">
                        {{ localized('Message from the General Secretary', 'Ujumbe wa Katibu Mkuu') }}
                    </p>

                    <h2 class="mt-3 {{ $heading }}">
                        {{ $featuredSecretaryGeneralMessage->getTranslation('title', $locale) }}
                    </h2>

                    <p class="mt-6 text-white/90 leading-relaxed whitespace-pre-line">
                        {{ $messageExcerpt }}
                    </p>

                    <div class="mt-8">
                        <a href="{{ locale_url('secretary-general-message') }}"
                            class="inline-flex items-center font-semibold text-white hover:text-white/70 transition">
                            {{ localized('Read full message', 'Soma ujumbe wote') }}
                            <span class="ml-2">→</span>
                        </a>
                    </div>
                @else
                    <p class="text-white/70">
                        {{ localized('No General Secretary message is currently available.', 'Hakuna ujumbe wa Katibu Mkuu kwa sasa.') }}
                    </p>
                @endif

            </div>
        </div>

        {{-- STANDING TOGETHER --}}
        <div class="bg-white px-6 py-8 md:px-12 md:py-10 lg:px-16">
            <div class="max-w-xl mx-auto lg:ml-0 lg:mr-auto">

                <h2 class="{{ $heading }} text-main">
                    {{ localized('Standing together for better working lives', 'Pamoja kwa maslahi bora ya wafanyakazi') }}
                </h2>

                <p class="mt-5 text-gray-600 leading-relaxed">
                    {{ localized(
                        'TUICO is an independent trade union for workers in industry, commerce, financial institutions, and services and consultancy. Through our workplace branches and regional offices, members organise, raise concerns and bargain together for better terms and conditions of employment.',
                        'TUICO ni chama huru cha wafanyakazi katika sekta za viwanda, biashara, taasisi za fedha, na huduma na ushauri. Kupitia matawi yetu mahali pa kazi na ofisi za mikoa, wanachama huhamasishana, huwasilisha hoja zao na hushiriki katika majadiliano ya pamoja ili kuboresha masharti na mazingira ya kazi.',
                    ) }}
                </p>

                <div class="mt-6 grid grid-cols-2 gap-5">
                    @foreach ($stats as $stat)
                        <div class="border-l-4 border-action pl-4">
                            <div class="text-3xl md:text-4xl font-bold text-main">{{ $stat['value'] }}</div>
                            <div class="mt-1 text-sm text-gray-600">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ locale_url('join-us') }}" class="{{ $btnPrimary }}">
                        {{ localized('Join TUICO', 'Jiunge na TUICO') }}
                        <span class="ml-2 text-lg">→</span>
                    </a>

                    <a href="{{ locale_url('regions') }}" class="{{ $btnOutline }}">
                        {{ localized('Find your regional office', 'Tafuta ofisi ya mkoa wako') }}
                        <span class="ml-2 text-lg">→</span>
                    </a>
                </div>

            </div>
        </div>

    </section>


    {{-- =========================
         WHAT WE DO
    ========================== --}}
    <section class="bg-white">
        <div class="{{ $container }}">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 items-start">

                {{-- INTRODUCTION --}}
                <div>
                    <p class="{{ $eyebrow }} text-action">
                        {{ localized('What We Do', 'Tunachofanya') }}
                    </p>

                    <h2 class="mt-3 text-2xl md:text-3xl lg:text-4xl font-bold leading-tight text-main">
                        {{ localized('Representation. Influence. Results.', 'Uwakilishi. Ushawishi. Matokeo.') }}
                    </h2>

                    <div class="mt-6">
                        <a href="{{ locale_url('news') }}" class="{{ $link }}">
                            {{ localized('Read TUICO news', 'Soma habari za TUICO') }}
                            <span class="ml-2">→</span>
                        </a>
                    </div>

                    <div class="mt-3">
                        <a href="{{ locale_url('strategic-plan') }}" class="{{ $link }}">
                            {{ localized('Explore the strategic plan', 'Tazama Mpango Mkakati') }}
                            <span class="ml-2">→</span>
                        </a>
                    </div>
                </div>

                {{-- PILLARS --}}
                <div class="border-t border-gray-200">
                    @foreach ($pillars as $pillar)
                        <div class="flex gap-4 py-3 border-b border-gray-200">
                            <div class="w-6 shrink-0 text-sm font-bold text-action pt-1">
                                {{ $pillar['number'] }}
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-main">{{ $pillar['title'] }}</h3>
                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">{{ $pillar['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>


    {{-- =========================
         OUR SECTORS
    ========================== --}}
    <section class="bg-gray-50">
        <div class="{{ $container }}">

            <div class="text-center">
                <p class="{{ $eyebrow }} text-action">
                    {{ localized('Our Sectors', 'Sekta Zetu') }}
                </p>

                <h2 class="mt-3 {{ $heading }} text-main">
                    {{ localized('Find your sector', 'Tambua sekta yako') }}
                </h2>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($sectors as $sector)
                    <a href="{{ locale_url('sectors/' . Str::slug($sector->getTranslation('name', 'en'))) }}"
                        class="group bg-white border border-gray-200 p-6 shadow-sm hover:border-action hover:shadow-md hover:-translate-y-1 transition duration-300">

                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center bg-action/10 text-action group-hover:bg-action group-hover:text-white transition">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="{{ $sectorIcons[min($loop->index, count($sectorIcons) - 1)] }}" />
                                </svg>
                            </div>

                            <h3 class="text-lg font-bold text-main leading-tight group-hover:text-action transition">
                                {{ $sector->getTranslation('name', $locale) }}
                            </h3>
                        </div>

                        <p class="mt-5 text-sm text-gray-600 leading-relaxed">
                            {{ Str::limit($sector->getTranslation('description', $locale), 150) }}
                        </p>

                        <span class="inline-flex items-center mt-5 text-sm font-semibold text-action">
                            {{ localized('View Sector', 'Angalia Sekta') }}
                            <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                        </span>
                    </a>
                @endforeach
            </div>

            <p class="mt-5 text-center text-sm text-gray-500">
                {{ localized('If you are unsure which sector or office covers your workplace, contact your ', 'Kama hujui sekta au ofisi inayohudumia eneo lako la kazi, wasiliana na ') }}<a
                    href="{{ locale_url('regions') }}"
                    class="underline underline-offset-2 hover:text-action transition">{{ localized('nearest TUICO office', 'ofisi ya TUICO iliyo karibu nawe') }}</a>.
            </p>

        </div>
    </section>


    {{-- =========================
         LATEST NEWS
    ========================== --}}
    <section class="bg-white">
        <div class="{{ $container }}">

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <p class="{{ $eyebrow }} text-action">
                        {{ localized('Latest News', 'Habari za Hivi Karibuni') }}
                    </p>

                    <h2 class="mt-3 {{ $heading }} text-main">
                        {{ localized('TUICO News & Updates', 'Habari na Matukio ya TUICO') }}
                    </h2>
                </div>

                <a href="{{ locale_url('news') }}" class="{{ $link }}">
                    {{ localized('View All News', 'Angalia Habari Zote') }}
                    <span class="ml-2">→</span>
                </a>
            </div>

            @if ($featuredNews->count())
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($featuredNews as $news)
                        <article
                            class="group bg-white border border-gray-200 overflow-hidden hover:border-action hover:shadow-md transition duration-300">

                            {{-- IMAGE --}}
                            @if ($news->featured_image)
                                <div class="aspect-[16/9] overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $news->featured_image) }}"
                                        alt="{{ $news->getTranslation('title', $locale) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </div>
                            @else
                                <div class="aspect-[16/9] bg-main flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold uppercase tracking-widest">TUICO</span>
                                </div>
                            @endif

                            {{-- CONTENT --}}
                            <div class="p-6">

                                @if ($news->published_at)
                                    <p class="text-xs font-semibold uppercase tracking-widest text-action">
                                        {{ $news->published_at->format('d M Y') }}
                                    </p>
                                @endif

                                <h3
                                    class="mt-3 text-xl font-bold text-main leading-snug group-hover:text-action transition">
                                    {{ $news->getTranslation('title', $locale) }}
                                </h3>

                                @if ($news->excerpt)
                                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                                        {{ Str::limit(strip_tags($news->getTranslation('excerpt', $locale)), 120) }}
                                    </p>
                                @endif

                                <a href="{{ locale_url('news/' . $news->slug) }}"
                                    class="inline-flex items-center mt-5 text-sm font-semibold text-action hover:text-main transition">
                                    {{ localized('Read More', 'Soma Zaidi') }}
                                    <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                                </a>

                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mt-6 border border-gray-200 bg-gray-50 px-6 py-10 text-center">
                    <p class="text-gray-600">
                        {{ localized('No published news is currently available.', 'Hakuna habari zilizochapishwa kwa sasa.') }}
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
            <div class="{{ $container }}">

                {{-- HEADER --}}
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <p class="{{ $eyebrow }} text-action">
                            {{ localized('Affiliations & Partners', 'Mahusiano na Ushirikiano') }}
                        </p>

                        <h2 class="mt-3 {{ $heading }} text-main">
                            {{ localized('Our Affiliations & Partners', 'Taasisi Tunazoshirikiana Nazo') }}
                        </h2>
                    </div>

                    <a href="{{ locale_url('affiliations') }}" class="{{ $link }}">
                        {{ localized('View All Affiliations', 'Angalia Mahusiano Yote') }}
                        <span class="ml-2">→</span>
                    </a>
                </div>

                {{-- CAROUSEL --}}
                <div class="relative mt-6"
                    x-data="{
                        current: 0,
                        total: {{ $affiliations->count() }},
                        visible: 2,
                        cardWidth: 0,
                        timer: null,

                        maxIndex() {
                            return Math.max(0, this.total - this.visible);
                        },

                        updateLayout() {
                            this.visible = window.innerWidth >= 768 ? 4 : 2;

                            if (this.$refs.viewport) {
                                this.cardWidth = this.$refs.viewport.clientWidth / this.visible;
                            }

                            if (this.current > this.maxIndex()) {
                                this.current = 0;
                            }
                        },

                        next() {
                            this.current = this.current >= this.maxIndex() ? 0 : this.current + 1;
                        },

                        previous() {
                            this.current = this.current <= 0 ? this.maxIndex() : this.current - 1;
                        },

                        start() {
                            this.stop();
                            this.timer = setInterval(() => this.next(), 4000);
                        },

                        stop() {
                            if (this.timer) {
                                clearInterval(this.timer);
                                this.timer = null;
                            }
                        }
                    }"
                    x-init="updateLayout(); start(); window.addEventListener('resize', () => updateLayout());"
                    @mouseenter="stop()" @mouseleave="start()">

                    {{-- PREVIOUS --}}
                    <button type="button" @click="previous()"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 md:-translate-x-5 z-10 h-10 w-10 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-main hover:bg-main hover:text-white transition"
                        aria-label="Previous affiliations">←</button>

                    {{-- VIEWPORT --}}
                    <div x-ref="viewport" class="overflow-hidden px-2">

                        {{-- TRACK --}}
                        <div class="flex transition-transform duration-700 ease-in-out"
                            :style="`transform: translateX(-${current * cardWidth}px);`">

                            @foreach ($affiliations as $affiliation)
                                @php
                                    // TODO: move to an `url` accessor on the Affiliation model.
                                    $attributes = $affiliation->getAttributes();
                                    $affiliationUrl = collect(['website_url', 'url', 'website', 'link'])
                                        ->map(fn($field) => $attributes[$field] ?? null)
                                        ->filter()
                                        ->first();

                                    if ($affiliationUrl && !preg_match('#^https?://#i', $affiliationUrl)) {
                                        $affiliationUrl = 'https://' . $affiliationUrl;
                                    }

                                    $tag = $affiliationUrl ? 'a' : 'div';
                                @endphp

                                <div class="flex-none w-1/2 md:w-1/4 px-2">
                                    <{{ $tag }}
                                        @if ($affiliationUrl) href="{{ $affiliationUrl }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $affiliation->name }}" @endif
                                        class="h-40 bg-white border border-gray-200 flex flex-col items-center justify-center px-5 py-6 hover:border-action hover:shadow-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-action">

                                        @if ($affiliation->logo)
                                            <div class="h-20 w-full flex items-center justify-center">
                                                <img src="{{ asset('storage/' . $affiliation->logo) }}"
                                                    alt="{{ $affiliation->name }}"
                                                    class="max-h-16 max-w-[150px] object-contain">
                                            </div>

                                            <div class="mt-3 text-center text-xs font-semibold text-gray-600">
                                                {{ $affiliation->name }}
                                            </div>
                                        @else
                                            <span class="text-center text-sm font-bold text-main leading-snug">
                                                {{ $affiliation->name }}
                                            </span>
                                        @endif

                                    </{{ $tag }}>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- NEXT --}}
                    <button type="button" @click="next()"
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 md:translate-x-5 z-10 h-10 w-10 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-main hover:bg-main hover:text-white transition"
                        aria-label="Next affiliations">→</button>

                </div>
            </div>
        </section>
    @endif


    {{-- =========================
         JOIN TUICO
    ========================== --}}
    <section class="bg-main text-white">
        <div class="{{ $container }}">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">

                <div class="max-w-3xl">
                    <p class="{{ $eyebrow }} text-white/70">
                        {{ localized('Join TUICO', 'Jiunge na TUICO') }}
                    </p>

                    <h2 class="mt-3 {{ $heading }}">
                        {{ localized('Be Part of the Workers’ Movement', 'Kuwa Sehemu ya Mshikamano wa Wafanyakazi') }}
                    </h2>

                    <p class="mt-4 text-white/80 text-base md:text-lg leading-relaxed">
                        {{ localized(
                            'For information about membership, services and how to get in touch with TUICO, contact us.',
                            'Kwa maelezo kuhusu uanachama, huduma na jinsi ya kuwasiliana na TUICO, wasiliana nasi.',
                        ) }}
                    </p>
                </div>

                <div class="flex-shrink-0">
                    <a href="{{ locale_url('join-us') }}" class="{{ $btnLight }}">
                        {{ localized('Join TUICO', 'Jiunge na TUICO') }}
                        <span class="ml-2">→</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
