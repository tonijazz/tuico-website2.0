@extends('layouts.app')

@php
    $isSwahili = app()->getLocale() === 'sw';
@endphp

@section('title', $isSwahili ? 'Ushirikiano' : 'Affiliations & Partners')

@section('content')

    {{-- HERO --}}
    <section class="bg-tuico-navy text-white">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="max-w-3xl">

                <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                    {{ $isSwahili ? 'Ushirikiano na Mahusiano' : 'Partnerships & Relations' }}
                </p>

                <h1 class="text-4xl md:text-5xl font-bold">
                    {{ $isSwahili ? 'Washirika na Taasisi Tunazoshirikiana Nazo' : 'Affiliations & Partners' }}
                </h1>

                <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                    {{ $isSwahili
                        ? 'TUICO inashirikiana na taasisi za kitaifa na kimataifa katika kukuza haki, ustawi na maendeleo ya wafanyakazi.'
                        : 'TUICO works with national and international institutions to advance workers’ rights, welfare and development.' }}
                </p>

            </div>

        </div>
    </section>


    {{-- NATIONAL --}}
    @if ($national->count())

        <section class="bg-white">

            <div class="max-w-7xl mx-auto px-6 py-8">

                <div class="max-w-3xl mb-8">

                    <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                        {{ $isSwahili ? 'Taasisi za Kitaifa' : 'National' }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $isSwahili ? 'Mahusiano ya Kitaifa' : 'National Partners & Affiliations' }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($national as $affiliation)

                        <article
                            class="group flex flex-col border border-gray-100 bg-white rounded-lg p-6 hover:border-blue-200 hover:shadow-sm transition"
                        >

                            {{-- LOGO --}}
                            <div class="h-28 flex items-center justify-center mb-6">

                                @if ($affiliation->logo)

                                    <img
                                        src="{{ asset('storage/' . $affiliation->logo) }}"
                                        alt="{{ $affiliation->name }}"
                                        class="max-h-24 max-w-[180px] object-contain"
                                    >

                                @else

                                    <div class="text-2xl font-bold text-tuico-navy text-center">
                                        {{ $affiliation->name }}
                                    </div>

                                @endif

                            </div>


                            {{-- TYPE --}}
                            @if ($affiliation->type)

                                <span
                                    class="self-start inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 border border-blue-100 rounded-full"
                                >
                                    {{ $affiliation->type->getLabel() }}
                                </span>

                            @endif


                            {{-- NAME --}}
                            <h3 class="mt-4 text-lg font-bold leading-snug text-gray-900">
                                {{ $affiliation->name }}
                            </h3>


                            {{-- DESCRIPTION --}}
                            @if ($affiliation->description)

                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                    {{ $affiliation->getTranslation('description', app()->getLocale()) }}
                                </p>

                            @endif


                            {{-- WEBSITE --}}
                            @if ($affiliation->website_url)

                                <div class="mt-auto pt-6">

                                    <a
                                        href="{{ $affiliation->website_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-tuico-navy transition"
                                    >
                                        {{ $isSwahili ? 'Tembelea Tovuti' : 'Visit Website' }}

                                        <span class="ml-2">↗</span>
                                    </a>

                                </div>

                            @endif

                        </article>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- INTERNATIONAL --}}
    @if ($international->count())

        <section class="bg-gray-50 border-t border-gray-100">

            <div class="max-w-7xl mx-auto px-6 py-8">

                <div class="max-w-3xl mb-8">

                    <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                        {{ $isSwahili ? 'Taasisi za Kimataifa' : 'International' }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $isSwahili ? 'Mahusiano ya Kimataifa' : 'International Partners & Affiliations' }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($international as $affiliation)

                        <article
                            class="group flex flex-col border border-gray-100 bg-white rounded-lg p-6 hover:border-blue-200 hover:shadow-sm transition"
                        >

                            {{-- LOGO --}}
                            <div class="h-28 flex items-center justify-center mb-6">

                                @if ($affiliation->logo)

                                    <img
                                        src="{{ asset('storage/' . $affiliation->logo) }}"
                                        alt="{{ $affiliation->name }}"
                                        class="max-h-24 max-w-[180px] object-contain"
                                    >

                                @else

                                    <div class="text-2xl font-bold text-tuico-navy text-center">
                                        {{ $affiliation->name }}
                                    </div>

                                @endif

                            </div>


                            {{-- TYPE --}}
                            @if ($affiliation->type)

                                <span
                                    class="self-start inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 border border-blue-100 rounded-full"
                                >
                                    {{ $affiliation->type->getLabel() }}
                                </span>

                            @endif


                            {{-- NAME --}}
                            <h3 class="mt-4 text-lg font-bold leading-snug text-gray-900">
                                {{ $affiliation->name }}
                            </h3>


                            {{-- DESCRIPTION --}}
                            @if ($affiliation->description)

                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                    {{ $affiliation->getTranslation('description', app()->getLocale()) }}
                                </p>

                            @endif


                            {{-- WEBSITE --}}
                            @if ($affiliation->website_url)

                                <div class="mt-auto pt-6">

                                    <a
                                        href="{{ $affiliation->website_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-tuico-navy transition"
                                    >
                                        {{ $isSwahili ? 'Tembelea Tovuti' : 'Visit Website' }}

                                        <span class="ml-2">↗</span>
                                    </a>

                                </div>

                            @endif

                        </article>

                    @endforeach

                </div>

            </div>

        </section>

    @endif

@endsection
