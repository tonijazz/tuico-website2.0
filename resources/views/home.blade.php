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

        <section x-data="{ current: 0, total: {{ $slides->count() }} }" x-init="setInterval(() => { current = (current + 1) % total }, 6000)" class="relative overflow-hidden">

            @foreach ($slides as $index => $slide)
                <div x-show="current === {{ $index }}" x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="relative min-h-[480px] md:min-h-[560px] bg-cover bg-center"
                    style="background-image: url('{{ asset('storage/' . $slide->image) }}')">

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-950/90 via-blue-900/70 to-blue-900/20"></div>

                    {{-- Content --}}
                    <div
                        class="relative z-10 max-w-7xl mx-auto px-6 py-20 md:py-28 min-h-[480px] md:min-h-[560px] flex items-center">

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
                                    <a href="{{ $slide->cta_url }}"
                                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-md transition">
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

                        <a href="{{ $isSwahili ? '/sw/secretary-general-message' : '/secretary-general-message' }}"
                            class="inline-flex items-center font-semibold text-white hover:text-blue-200 transition">
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
@endsection
