@extends('layouts.app')

@section('title')
    {{ app()->getLocale() === 'sw' ? 'Matukio' : 'Events' }}
@endsection

@section('content')

@php
    $isSwahili = app()->getLocale() === 'sw';
@endphp

{{-- =========================================================
HERO
========================================================= --}}

<section class="bg-tuico-navy text-white">
    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="max-w-3xl">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ $isSwahili ? 'Kalenda na Shughuli' : 'Calendar & Activities' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $isSwahili ? 'Matukio ya TUICO' : 'TUICO Events' }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                {{ $isSwahili
                    ? 'Fuatilia mikutano, shughuli, programu na matukio mbalimbali yanayohusiana na kazi za TUICO.'
                    : 'Follow meetings, activities, programmes and other events connected to the work of TUICO.' }}
            </p>

        </div>

    </div>
</section>


{{-- =========================================================
EVENTS
========================================================= --}}

<section class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div x-data="{ tab: 'upcoming' }">

            {{-- Tabs --}}
            <div class="flex flex-wrap items-center gap-3 mb-8">

                <button
                    type="button"
                    @click="tab = 'upcoming'"
                    :class="tab === 'upcoming'
                        ? 'bg-tuico-navy text-white'
                        : 'bg-white text-gray-600 border border-gray-200 hover:border-blue-200 hover:text-blue-700'"
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition"
                >
                    {{ $isSwahili ? 'Matukio Yanayokuja' : 'Upcoming Events' }}
                </button>

                <button
                    type="button"
                    @click="tab = 'past'"
                    :class="tab === 'past'
                        ? 'bg-tuico-navy text-white'
                        : 'bg-white text-gray-600 border border-gray-200 hover:border-blue-200 hover:text-blue-700'"
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition"
                >
                    {{ $isSwahili ? 'Matukio Yaliyopita' : 'Past Events' }}
                </button>

            </div>


            {{-- =================================================
                 UPCOMING EVENTS
            ================================================== --}}
            <div x-show="tab === 'upcoming'" x-cloak>

                @if ($upcoming->isNotEmpty())

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                        @foreach ($upcoming as $event)

                            @php
                                $title = $event->getTranslation('title', app()->getLocale());
                                $description = $event->getTranslation('description', app()->getLocale());
                            @endphp

                            <article
                                class="bg-white rounded-lg overflow-hidden border border-gray-100 hover:shadow-sm transition"
                            >

                                {{-- Banner --}}
                                @if ($event->banner_image)

                                    <div class="aspect-[16/9] overflow-hidden">
                                        <img
                                            src="{{ asset('storage/' . $event->banner_image) }}"
                                            alt="{{ $title }}"
                                            class="w-full h-full object-cover"
                                        >
                                    </div>

                                @else

                                    <div class="aspect-[16/9] bg-tuico-navy flex items-center justify-center">
                                        <span class="text-blue-200 text-sm font-semibold uppercase tracking-wider">
                                            TUICO
                                        </span>
                                    </div>

                                @endif


                                <div class="p-6">

                                    {{-- Date --}}
                                    <div class="flex items-start gap-4 mb-5">

                                        <div class="w-16 h-16 shrink-0 rounded-lg bg-blue-50 border border-blue-100 flex flex-col items-center justify-center">

                                            <span class="text-2xl font-bold text-tuico-navy leading-none">
                                                {{ $event->starts_at->format('d') }}
                                            </span>

                                            <span class="text-[11px] font-semibold uppercase tracking-wide text-blue-700 mt-1">
                                                {{ $event->starts_at->format('M') }}
                                            </span>

                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $event->starts_at->format('F j, Y') }}
                                            </p>

                                            @if ($event->ends_at && !$event->starts_at->isSameDay($event->ends_at))

                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ $isSwahili ? 'Hadi' : 'Until' }}
                                                    {{ $event->ends_at->format('F j, Y') }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>


                                    {{-- Governance meeting --}}
                                    @if ($event->governanceMeeting)

                                        <div class="mb-3">

                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                                                {{ $event->governanceMeeting->name }}
                                            </span>

                                        </div>

                                    @endif


                                    {{-- Title --}}
                                    <h2 class="text-xl font-bold text-gray-900 leading-snug">
                                        {{ $title }}
                                    </h2>


                                    {{-- Description --}}
                                    @if ($description)

                                        <p class="mt-3 text-sm text-gray-600 leading-7">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($description), 150) }}
                                        </p>

                                    @endif


                                    {{-- Location --}}
                                    @if ($event->location)

                                        <div class="mt-5 flex items-start gap-2 text-sm text-gray-500">

                                            <svg
                                                class="w-4 h-4 mt-0.5 shrink-0 text-blue-700"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>

                                            <span>{{ $event->location }}</span>

                                        </div>

                                    @endif

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <div class="bg-white rounded-lg border border-gray-100 p-10 text-center">

                        <div class="w-14 h-14 mx-auto rounded-full bg-blue-50 flex items-center justify-center mb-4">

                            <svg
                                class="w-7 h-7 text-blue-700"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                            </svg>

                        </div>

                        <h2 class="text-xl font-bold text-gray-900">
                            {{ $isSwahili ? 'Hakuna matukio yanayokuja' : 'No upcoming events' }}
                        </h2>

                        <p class="mt-2 text-gray-500">
                            {{ $isSwahili
                                ? 'Hakuna tukio lililopangwa kwa sasa.'
                                : 'There are no upcoming events scheduled at the moment.' }}
                        </p>

                    </div>

                @endif

            </div>


            {{-- =================================================
                 PAST EVENTS
            ================================================== --}}
            <div x-show="tab === 'past'" x-cloak>

                @if ($past->isNotEmpty())

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                        @foreach ($past as $event)

                            @php
                                $title = $event->getTranslation('title', app()->getLocale());
                                $description = $event->getTranslation('description', app()->getLocale());
                            @endphp

                            <article
                                class="bg-white rounded-lg overflow-hidden border border-gray-100 hover:shadow-sm transition"
                            >

                                {{-- Banner --}}
                                @if ($event->banner_image)

                                    <div class="aspect-[16/9] overflow-hidden">
                                        <img
                                            src="{{ asset('storage/' . $event->banner_image) }}"
                                            alt="{{ $title }}"
                                            class="w-full h-full object-cover"
                                        >
                                    </div>

                                @else

                                    <div class="aspect-[16/9] bg-gray-100 flex items-center justify-center">
                                        <span class="text-gray-500 text-sm font-semibold uppercase tracking-wider">
                                            TUICO
                                        </span>
                                    </div>

                                @endif


                                <div class="p-6">

                                    {{-- Date --}}
                                    <div class="flex items-start gap-4 mb-5">

                                        <div class="w-16 h-16 shrink-0 rounded-lg bg-gray-100 border border-gray-200 flex flex-col items-center justify-center">

                                            <span class="text-2xl font-bold text-gray-700 leading-none">
                                                {{ $event->starts_at->format('d') }}
                                            </span>

                                            <span class="text-[11px] font-semibold uppercase tracking-wide text-gray-500 mt-1">
                                                {{ $event->starts_at->format('M') }}
                                            </span>

                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $event->starts_at->format('F j, Y') }}
                                            </p>

                                            @if ($event->ends_at && !$event->starts_at->isSameDay($event->ends_at))

                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ $isSwahili ? 'Hadi' : 'Until' }}
                                                    {{ $event->ends_at->format('F j, Y') }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>


                                    {{-- Past badge --}}
                                    <div class="mb-3">

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">
                                            {{ $isSwahili ? 'Tukio Lililopita' : 'Past Event' }}
                                        </span>

                                    </div>


                                    {{-- Governance meeting --}}
                                    @if ($event->governanceMeeting)

                                        <div class="mb-3">

                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                                                {{ $event->governanceMeeting->name }}
                                            </span>

                                        </div>

                                    @endif


                                    {{-- Title --}}
                                    <h2 class="text-xl font-bold text-gray-900 leading-snug">
                                        {{ $title }}
                                    </h2>


                                    {{-- Description --}}
                                    @if ($description)

                                        <p class="mt-3 text-sm text-gray-600 leading-7">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($description), 150) }}
                                        </p>

                                    @endif


                                    {{-- Location --}}
                                    @if ($event->location)

                                        <div class="mt-5 flex items-start gap-2 text-sm text-gray-500">

                                            <svg
                                                class="w-4 h-4 mt-0.5 shrink-0 text-gray-500"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>

                                            <span>{{ $event->location }}</span>

                                        </div>

                                    @endif

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <div class="bg-white rounded-lg border border-gray-100 p-10 text-center">

                        <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">

                            <svg
                                class="w-7 h-7 text-gray-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 7V3m8 4v4M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                            </svg>

                        </div>

                        <h2 class="text-xl font-bold text-gray-900">
                            {{ $isSwahili ? 'Hakuna matukio yaliyopita' : 'No past events' }}
                        </h2>

                        <p class="mt-2 text-gray-500">
                            {{ $isSwahili
                                ? 'Hakuna matukio yaliyopita ya kuonyesha kwa sasa.'
                                : 'There are no past events to display at the moment.' }}
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
CTA
========================================================= --}}

<section class="bg-tuico-navy text-white">

    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div>

                <p class="text-xl font-bold">
                    {{ $isSwahili ? 'Endelea kufuatilia TUICO' : 'Stay connected with TUICO' }}
                </p>

                <p class="mt-2 text-blue-100">
                    {{ $isSwahili
                        ? 'Soma habari na taarifa za hivi karibuni kutoka TUICO.'
                        : 'Read the latest news and updates from TUICO.' }}
                </p>

            </div>

            <a
                href="{{ $isSwahili ? '/sw/news' : '/news' }}"
                class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-white text-tuico-navy font-semibold hover:bg-blue-50 transition"
            >
                {{ $isSwahili ? 'Soma Habari' : 'Read News' }}
            </a>

        </div>

    </div>

</section>

@endsection
