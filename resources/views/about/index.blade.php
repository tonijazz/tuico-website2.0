@extends('layouts.app')

@section('title', $page?->title ?? (localized('About Us', 'Kuhusu Sisi')))

@section('content')

    @php
        // Page blocks may be stored flat (['type' => 'heading', 'content' => ...])
        // or in Filament's nested format (['type' => 'heading', 'data' => ['content' => ...]]).
        $blocks = collect($page?->blocks ?? [])
            ->map(fn($block) => array_merge($block, $block['data'] ?? []))
            ->values();

        // Page intro (header text) is keyed as an "intro" block.
        $introText = $blocks->firstWhere('type', 'intro')['content'] ?? null;

        // The History heading and its paragraphs are shown in their own section, not in the main column.
        $aboutHistoryHeading = localized('Background and History', 'Historia');
        $aboutHistoryIndex = $blocks->search(
            fn($block) => ($block['type'] ?? null) === 'heading' && ($block['content'] ?? null) === $aboutHistoryHeading,
        );
        $aboutHistoryKeys = $aboutHistoryIndex === false
            ? []
            : array_merge(
                [$aboutHistoryIndex],
                $blocks
                    ->slice($aboutHistoryIndex + 1)
                    ->takeWhile(fn($block) => ($block['type'] ?? null) === 'paragraph')
                    ->keys()
                    ->all(),
            );
        $mainBlocks = $blocks->reject(fn($block, $key) => in_array($key, $aboutHistoryKeys, true));
    @endphp


    {{-- =========================
     HERO
========================== --}}

    <x-page-hero :eyebrow="localized('About Us', 'Kuhusu Sisi')" :title="$page?->title ?? localized('About TUICO', 'Kuhusu TUICO')" :intro="$introText" />


    {{-- =========================
     WHO WE ARE + AT A GLANCE
========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Who We Are --}}
            <div class="lg:col-span-2">

                @foreach ($mainBlocks as $block)
                    @if ($block['type'] === 'heading' && $block['content'] !== 'Background and History' && $block['content'] !== 'Historia')
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $block['content'] }}
                        </h2>
                    @elseif ($block['type'] === 'paragraph')
                        <p class="text-gray-600 leading-8 mb-4">
                            {{ $block['content'] }}
                        </p>
                    @elseif ($block['type'] === 'bulleted_list')
                        <ul class="list-disc pl-6 mb-4 space-y-1 text-gray-600 leading-8">
                            @foreach ($block['items'] ?? [] as $row)
                                <li>{{ $row['item'] ?? '' }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach

            </div>


            {{-- TUICO at a Glance --}}
            <div class="bg-gray-50 border border-gray-100 rounded-lg p-6">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('TUICO at a Glance', 'TUICO kwa Ufupi') }}
                </p>

                <div class="grid grid-cols-2 gap-px bg-gray-200 mt-5 border border-gray-200 rounded-lg overflow-hidden">

                    @php
                        $keyFigures = collect($blocks)
                            ->where('type', 'key_figures')
                            ->flatMap(fn($block) => $block['items'] ?? []);
                    @endphp

                    @foreach ($keyFigures as $figure)
                        <div class="bg-white p-4">
                            <p class="text-2xl font-bold text-main">
                                {{ $figure['value'] ?? '' }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $figure['label'] ?? '' }}
                            </p>
                        </div>
                    @endforeach

                    @if (isset($sectorsCount))
                        <div class="bg-white p-4">
                            <p class="text-2xl font-bold text-main">
                                {{ $sectorsCount }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ localized('Sectors', 'Sekta') }}
                            </p>
                        </div>
                    @endif

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-main">
                            {{ $zonesCount }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ localized('Zones', 'Kanda') }}
                        </p>
                    </div>

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-main">
                            {{ $regionalOfficesCount }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ localized('Regional Offices', 'Ofisi za Mikoa') }}
                        </p>
                    </div>

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-main">
                            {{ $subOfficesCount }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ localized('Sub-Offices', 'Ofisi Ndogo') }}
                        </p>
                    </div>

                </div>

                <div class="mt-4 flex flex-col gap-3">

                    <a href="{{ localized('/sectors', '/sw/sectors') }}"
                        class="inline-flex w-full items-center justify-center bg-action hover:bg-main text-white font-semibold px-6 py-3 rounded-md border border-action hover:border-main transition">
                        {{ localized('Explore our sectors', 'Tazama sekta zetu') }}

                        <span class="ml-2 text-lg">→</span>
                    </a>

                    <a href="{{ localized('/regions', '/sw/regions') }}"
                        class="inline-flex w-full items-center justify-center bg-white text-action hover:bg-action/10 font-semibold px-6 py-3 rounded-md border border-action transition">
                        {{ localized('Find your regional office', 'Tafuta ofisi ya mkoa wako') }}

                        <span class="ml-2 text-lg">→</span>
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
     HISTORY
========================== --}}

    @php
        $historyHeading = localized('Background and History', 'Historia');

        $historyBlock = collect($blocks)->firstWhere('content', $historyHeading);
    @endphp

    @if ($historyBlock)

        @php
            $historyIndex = collect($blocks)->search(
                fn($block) => $block['type'] === 'heading' && $block['content'] === $historyHeading,
            );

            $historyParagraphs = collect($blocks)
                ->slice($historyIndex + 1)
                ->takeWhile(fn($block) => $block['type'] === 'paragraph');
        @endphp

        <section class="bg-gray-50">

            <div class="max-w-7xl mx-auto px-6 py-8">

                <div class="max-w-4xl">

                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $historyBlock['content'] }}
                    </h2>

                    @foreach ($historyParagraphs as $paragraph)
                        <p class="text-gray-600 leading-8">
                            {{ $paragraph['content'] }}
                        </p>
                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =========================
     VISION & MISSION
========================== --}}

    @php
        $aboutIsSw = is_sw();

        // Numbered commitments under the Mission: keyed on the About page as a "Mission Commitments" block.
        $commitmentsBlock = $blocks->firstWhere('type', 'mission_commitments');
        $commitmentsIntro = $commitmentsBlock['intro'] ?? null;
        $commitmentItems = collect($commitmentsBlock['items'] ?? [])
            ->map(fn($row) => $row['item'] ?? null)
            ->filter()
            ->values();
    @endphp

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="max-w-3xl mb-5">

            <p class="text-sm uppercase tracking-widest text-action mb-2">
                {{ $aboutIsSw ? 'Mwelekeo wa Chama' : 'Our Direction' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ $aboutIsSw ? 'Dira na Dhima' : 'Vision and Mission' }}
            </h2>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

            <div class="border border-gray-100 rounded-lg p-6 md:col-span-1">

                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    {{ $aboutIsSw ? 'Dira' : 'Vision' }}
                </h3>

                <p class="text-gray-600 leading-7">
                    {{ $aboutIsSw ? $siteSettings->vision_sw : $siteSettings->vision }}
                </p>

            </div>

            <div class="border border-gray-100 rounded-lg p-6 md:col-span-2">

                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    {{ $aboutIsSw ? 'Dhima' : 'Mission' }}
                </h3>

                <p class="text-gray-600 leading-7">
                    {{ $aboutIsSw ? $siteSettings->mission_sw : $siteSettings->mission }}
                </p>

                @if ($commitmentItems->isNotEmpty())

                    @if ($commitmentsIntro)
                        <p class="mt-4 text-gray-600 leading-7">
                            {{ $commitmentsIntro }}
                        </p>
                    @endif

                    <ol class="mt-3 list-decimal pl-5 space-y-2 text-gray-600 leading-7">

                        @foreach ($commitmentItems as $item)
                            <li>{{ $item }}</li>
                        @endforeach

                    </ol>

                @endif

            </div>

        </div>

    </section>


    {{-- =========================
     STRATEGIC AREAS
========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="max-w-3xl mb-4">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('What We Do', 'Tunachofanya') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('Strategic Areas', 'Maeneo ya Kimkakati') }}
                </h2>

                <p class="mt-3 text-gray-600 leading-7">
                    {{ localized('Key areas that guide the implementation of TUICO’s priorities.', 'Maeneo muhimu yanayoongoza utekelezaji wa vipaumbele vya TUICO.') }}
                </p>

            </div>




            <div>

                <a href="{{ is_sw() ? url('/sw/strategic-plan') : url('/strategic-plan') }}"
                    class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition">
                    {{ localized('Read the strategic plan', 'Soma Mpango Mkakati') }}

                    <span class="ml-2">→</span>
                </a>

            </div>

        </div>

    </section>

    {{-- =========================
     STATUTORY MEETINGS
========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="max-w-3xl mb-5">

            <p class="text-sm uppercase tracking-widest text-action mb-2">
                {{ localized('Union Governance', 'Utawala wa Chama') }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900 mb-3">
                {{ localized('Statutory Meetings', 'Vikao vya Kikatiba') }}
            </h2>

            <p class="text-gray-600 leading-7">
                {{ is_sw()
                    ? 'Vikao hivi hufanyika ili kusimamia shughuli za Chama katika ngazi mbalimbali kwa mujibu wa Katiba na Kanuni za Chama.'
                    : "These meetings conduct and oversee the affairs of the Union at different levels in accordance with the Union's Constitution and Rules." }}
            </p>

        </div>

        @if ($governanceLevels->count())

            <div class="space-y-6">

                @foreach ($governanceLevels as $level)
                    <div>

                        <h3 class="text-2xl font-semibold text-gray-900 mb-3">
                            {{ $level->name }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach ($level->meetings as $meeting)
                                <div class="border border-gray-100 rounded-lg p-5">

                                    <h4 class="font-semibold text-gray-900">
                                        {{ $meeting->name }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ $meeting->frequency }}
                                    </p>

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endforeach

            </div>

        @endif

    </section>


@endsection
