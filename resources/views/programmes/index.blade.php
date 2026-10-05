@extends('layouts.app')

@php
    $isSwahili = app()->getLocale() === 'sw';
@endphp

@section('title', $isSwahili ? 'Mpango Mkakati' : 'Strategic Plan')

@section('content')

    {{-- =========================================================
HERO
========================================================== --}}

    <section class="bg-tuico-navy text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="max-w-3xl">

                <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                    {{ $isSwahili ? 'Mwelekeo wa Kimkakati' : 'Strategic Direction' }}
                </p>

                <h1 class="text-4xl md:text-5xl font-bold">
                    {{ $isSwahili ? 'Mpango Mkakati' : 'Strategic Plan' }}
                </h1>

                <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                    {{ $isSwahili
                        ? 'Mwelekeo unaoongoza vipaumbele na utekelezaji wa TUICO.'
                        : 'The strategic direction guiding TUICO’s priorities and implementation.' }}
                </p>

            </div>

        </div>

    </section>

    {{-- =========================================================
STRATEGIC AREAS
========================================================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-8">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ $isSwahili ? 'Vipaumbele' : 'Priorities' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isSwahili ? 'Maeneo ya Kimkakati' : 'Strategic Areas' }}
                </h2>

            </div>


            @if ($strategicAreas->count())

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($strategicAreas as $area)
                        <article
                            class="group bg-white rounded-lg border border-gray-100 p-6 hover:border-blue-200 hover:shadow-sm transition">

                            @if ($area->icon)
                                <div class="mb-5 text-tuico-navy">
                                    <x-dynamic-component :component="$area->icon" class="w-8 h-8" />
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition">
                                {{ $area->title }}
                            </h3>

                            @if ($area->description)
                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                    {{ \Illuminate\Support\Str::limit($area->description, 150) }}
                                </p>
                            @endif

                            <a href="{{ $isSwahili
    ? url('/sw/strategic-plan/areas/' . $area->id)
    : route('programmes.strategic-area', $area) }}"
                                class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700 hover:text-tuico-navy transition">
                                {{ $isSwahili ? 'Angalia Maelezo' : 'View Details' }}
                                <span class="ml-2">→</span>
                            </a>

                        </article>
                    @endforeach

                </div>


                @if ($strategicAreas->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $strategicAreas->onEachSide(1)->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white rounded-lg border border-gray-100 px-6 py-12 text-center">

                    <p class="text-sm text-gray-500">
                        {{ $isSwahili
                            ? 'Hakuna maeneo ya kimkakati yaliyowekwa kwa sasa.'
                            : 'No strategic areas are currently available.' }}
                    </p>

                </div>

            @endif

        </div>

    </section>

    {{-- =========================================================
PROGRAMMES
========================================================== --}}

    <section class="bg-white">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-8">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ $isSwahili ? 'Utekelezaji' : 'Implementation' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isSwahili ? 'Programu' : 'Programmes' }}
                </h2>

            </div>


            <div x-data="{ tab: 'active' }">

                {{-- TABS --}}
                <div class="flex flex-wrap gap-2 mb-8">

                    <button @click="tab = 'active'"
                        :class="tab === 'active'
                            ?
                            'bg-tuico-navy border-tuico-navy text-white' :
                            'bg-white border-gray-200 text-gray-600 hover:border-blue-200 hover:text-blue-700'"
                        class="px-4 py-2 text-xs font-bold uppercase tracking-wider border rounded-full transition">
                        {{ $isSwahili ? 'Zinazoendelea' : 'Active' }}
                    </button>

                    <button @click="tab = 'past'"
                        :class="tab === 'past'
                            ?
                            'bg-tuico-navy border-tuico-navy text-white' :
                            'bg-white border-gray-200 text-gray-600 hover:border-blue-200 hover:text-blue-700'"
                        class="px-4 py-2 text-xs font-bold uppercase tracking-wider border rounded-full transition">
                        {{ $isSwahili ? 'Zilizopita' : 'Past' }}
                    </button>

                </div>


                {{-- ACTIVE PROGRAMMES --}}
                <div x-show="tab === 'active'" x-cloak>

                    @if ($activeProgrammes->count())

                        <div class="space-y-5">

                            @foreach ($activeProgrammes as $programme)
                                <article
                                    class="bg-white rounded-lg border border-gray-100 p-6 hover:border-blue-200 hover:shadow-sm transition">

                                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                        <div class="max-w-3xl">

                                            <h3 class="text-xl md:text-2xl font-bold leading-snug text-gray-900">
                                                {{ $programme->title }}
                                            </h3>

                                            @if ($programme->description)
                                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                                    {{ \Illuminate\Support\Str::limit($programme->description, 180) }}
                                                </p>
                                            @endif

                                        </div>

                                        <span
                                            class="inline-flex w-fit shrink-0 items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full bg-green-50 text-green-700 border border-green-100">
                                            {{ $isSwahili ? 'Inaendelea' : 'Active' }}
                                        </span>

                                    </div>


                                    <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-x-8 gap-y-3">

                                        @if ($programme->starts_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ $isSwahili ? 'Kuanza' : 'Start Date' }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->starts_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                        @if ($programme->ends_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ $isSwahili ? 'Kumalizika' : 'End Date' }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->ends_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                    </div>


                                    <a href="{{ route('programmes.programme', $programme) }}"
                                        class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700 hover:text-tuico-navy transition">
                                        {{ $isSwahili ? 'Angalia Programu' : 'View Programme' }}
                                        <span class="ml-2">→</span>
                                    </a>

                                </article>
                            @endforeach

                        </div>


                        @if ($activeProgrammes->hasPages())
                            <div class="mt-10 flex justify-center">
                                {{ $activeProgrammes->onEachSide(1)->links() }}
                            </div>
                        @endif
                    @else
                        <div class="rounded-lg border border-gray-100 bg-gray-50 px-6 py-12 text-center">

                            <p class="text-sm text-gray-500">
                                {{ $isSwahili ? 'Hakuna programu zinazoendelea kwa sasa.' : 'No active programmes are currently available.' }}
                            </p>

                        </div>

                    @endif

                </div>


                {{-- PAST PROGRAMMES --}}
                <div x-show="tab === 'past'" x-cloak>

                    @if ($pastProgrammes->count())

                        <div class="space-y-5">

                            @foreach ($pastProgrammes as $programme)
                                <article
                                    class="bg-white rounded-lg border border-gray-100 p-6 hover:border-blue-200 hover:shadow-sm transition">

                                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                        <div class="max-w-3xl">

                                            <h3 class="text-xl md:text-2xl font-bold leading-snug text-gray-900">
                                                {{ $programme->title }}
                                            </h3>

                                            @if ($programme->description)
                                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                                    {{ \Illuminate\Support\Str::limit($programme->description, 180) }}
                                                </p>
                                            @endif

                                        </div>

                                        <span
                                            class="inline-flex w-fit shrink-0 items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ $isSwahili ? 'Iliyopita' : 'Past' }}
                                        </span>

                                    </div>


                                    <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-x-8 gap-y-3">

                                        @if ($programme->starts_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ $isSwahili ? 'Kuanza' : 'Start Date' }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->starts_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                        @if ($programme->ends_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ $isSwahili ? 'Kumalizika' : 'End Date' }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->ends_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                    </div>


                                    <a href="{{ route('programmes.programme', $programme) }}"
                                        class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700 hover:text-tuico-navy transition">
                                        {{ $isSwahili ? 'Angalia Programu' : 'View Programme' }}
                                        <span class="ml-2">→</span>
                                    </a>

                                </article>
                            @endforeach

                        </div>


                        @if ($pastProgrammes->hasPages())
                            <div class="mt-10 flex justify-center">
                                {{ $pastProgrammes->onEachSide(1)->links() }}
                            </div>
                        @endif
                    @else
                        <div class="rounded-lg border border-gray-100 bg-gray-50 px-6 py-12 text-center">

                            <p class="text-sm text-gray-500">
                                {{ $isSwahili ? 'Hakuna programu zilizopita kwa sasa.' : 'No past programmes are currently available.' }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>

@endsection
