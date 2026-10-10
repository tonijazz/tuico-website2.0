@extends('layouts.app')

@section('title', $page?->title ?? (app()->getLocale() === 'sw' ? 'Kuhusu Sisi' : 'About Us'))

@section('content')


    {{-- =========================
     HERO
========================== --}}

    <section class="bg-tuico-navy text-white">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Kuhusu Sisi' : 'About Us' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $page?->title ?? (app()->getLocale() === 'sw' ? 'Kuhusu TUICO' : 'About TUICO') }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                {{ app()->getLocale() === 'sw'
                    ? 'Fahamu zaidi kuhusu TUICO, historia yetu, madhumuni yetu na namna Chama kinavyojiendesha.'
                    : 'Learn more about TUICO, our history, purpose and the way we operate.' }}
            </p>

        </div>
    </section>


    {{-- =========================
     WHO WE ARE + AT A GLANCE
========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Who We Are --}}
            <div class="lg:col-span-2">

                @foreach ($page?->blocks ?? [] as $block)
                    @if ($block['type'] === 'heading' && $block['content'] !== 'Background and History' && $block['content'] !== 'Historia')
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $block['content'] }}
                        </h2>
                    @elseif ($block['type'] === 'paragraph')
                        <p class="text-gray-600 leading-8 mb-4">
                            {{ $block['content'] }}
                        </p>
                    @endif
                @endforeach

            </div>


            {{-- TUICO at a Glance --}}
            <div class="bg-gray-50 border border-gray-100 rounded-lg p-6">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ app()->getLocale() === 'sw' ? 'TUICO kwa Ufupi' : 'TUICO at a Glance' }}
                </p>

                <div class="grid grid-cols-2 gap-px bg-gray-200 mt-5 border border-gray-200 rounded-lg overflow-hidden">

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-tuico-navy">
                            1995
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ app()->getLocale() === 'sw' ? 'Tulianzishwa' : 'Established' }}
                        </p>
                    </div>

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-tuico-navy">
                            120K+
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ app()->getLocale() === 'sw' ? 'Wanachama' : 'Members' }}
                        </p>
                    </div>

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-tuico-navy">
                            4
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ app()->getLocale() === 'sw' ? 'Sekta' : 'Sectors' }}
                        </p>
                    </div>

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-tuico-navy">
                            {{ $zonesCount }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ app()->getLocale() === 'sw' ? 'Kanda' : 'Zones' }}
                        </p>
                    </div>

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-tuico-navy">
                            {{ $regionalOfficesCount }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices' }}
                        </p>
                    </div>

                    <div class="bg-white p-4">
                        <p class="text-2xl font-bold text-tuico-navy">
                            {{ $subOfficesCount }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ app()->getLocale() === 'sw' ? 'Ofisi Ndogo' : 'Sub-Offices' }}
                        </p>
                    </div>

                </div>

                <div class="mt-4 border border-gray-100 rounded-lg bg-white p-5">
                    <p class="text-lg font-bold text-gray-900">
                        {{ app()->getLocale() === 'sw' ? 'Wanachama Kwanza' : 'Members First' }}
                    </p>

                    <p class="text-sm text-tuico-navy mt-1 font-medium">
                        {{ app()->getLocale() === 'sw' ? 'Jeuri ya TUICO' : 'TUICO’s Strength' }}
                    </p>
                </div>

            </div>

        </div>

    </section>


    {{-- =========================
     HISTORY
========================== --}}

    @php
        $historyHeading = app()->getLocale() === 'sw' ? 'Historia' : 'Background and History';

        $historyBlock = collect($page?->blocks ?? [])->firstWhere('content', $historyHeading);
    @endphp

    @if ($historyBlock)

        @php
            $historyIndex = collect($page?->blocks ?? [])->search(
                fn($block) => $block['type'] === 'heading' && $block['content'] === $historyHeading,
            );

            $historyParagraphs = collect($page?->blocks ?? [])
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
     MISSION & VISION
========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="max-w-3xl mb-5">

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Mwelekeo wa Chama' : 'Our Direction' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ app()->getLocale() === 'sw' ? 'Dira na Dhima' : 'Mission & Vision' }}
            </h2>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="border border-gray-100 rounded-lg p-6">

                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    {{ app()->getLocale() === 'sw' ? 'Dira' : 'Vision' }}
                </h3>

                <p class="text-gray-600 leading-7">
                    {{ app()->getLocale() === 'sw' ? $siteSettings->vision_sw : $siteSettings->vision }}
                </p>

            </div>

            <div class="border border-gray-100 rounded-lg p-6">

                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    {{ app()->getLocale() === 'sw' ? 'Dhima' : 'Mission' }}
                </h3>

                <p class="text-gray-600 leading-7">
                    {{ app()->getLocale() === 'sw' ? $siteSettings->mission_sw : $siteSettings->mission }}
                </p>

            </div>

        </div>

    </section>


    {{-- =========================
     STRATEGIC AREAS
========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="max-w-3xl mb-6">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ app()->getLocale() === 'sw' ? 'Tunachofanya' : 'What We Do' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ app()->getLocale() === 'sw' ? 'Maeneo ya Kimkakati' : 'Strategic Areas' }}
                </h2>

                <p class="mt-3 text-gray-600 leading-7">
                    {{ app()->getLocale() === 'sw'
                        ? 'Maeneo muhimu yanayoongoza utekelezaji wa vipaumbele vya TUICO.'
                        : 'Key areas that guide the implementation of TUICO’s priorities.' }}
                </p>

            </div>


            @if ($strategicAreas->count())

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($strategicAreas->take(3) as $area)
                        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">

                            <h3 class="text-xl font-semibold text-gray-900 mb-3">
                                {{ $area->title }}
                            </h3>

                            <p class="text-gray-600 leading-7">
                                {{ $area->description }}
                            </p>

                        </div>
                    @endforeach

                </div>

            @endif


            <div class="mt-7">

                <a href="{{ app()->getLocale() === 'sw' ? url('/sw/strategic-plan') : route('programmes.index') }}"
                    class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-950 transition">
                    {{ app()->getLocale() === 'sw' ? 'Tazama Maeneo Yote ya Kimkakati' : 'View All Strategic Areas' }}

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

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Utawala wa Chama' : 'Union Governance' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900 mb-3">
                {{ app()->getLocale() === 'sw' ? 'Mikutano ya Kisheria' : 'Statutory Meetings' }}
            </h2>

            <p class="text-gray-600 leading-7">
                {{ app()->getLocale() === 'sw'
                    ? 'Mikutano hii huendesha na kusimamia shughuli za Chama katika ngazi mbalimbali kwa mujibu wa Katiba na Kanuni za Chama.'
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
