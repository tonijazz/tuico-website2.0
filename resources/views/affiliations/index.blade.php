@extends('layouts.app')


@section('title', localized('Affiliations & Partners', 'Ushirikiano'))

@section('content')

    {{-- HERO --}}
    <x-page-hero :eyebrow="localized('Partnerships & Relations', 'Ushirikiano na Mahusiano')" :title="localized('Affiliations & Partners', 'Washirika na Taasisi Tunazoshirikiana Nazo')" :intro="localized('TUICO works with national and international institutions to advance workers’ rights, welfare and development.', 'TUICO inashirikiana na taasisi za kitaifa na kimataifa katika kukuza haki, ustawi na maendeleo ya wafanyakazi.')" />


    {{-- NATIONAL --}}
    @if ($national->count())

        <section class="bg-white">

            <div class="max-w-7xl mx-auto px-6 py-8">

                <div class="max-w-3xl mb-8">

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('National', 'Taasisi za Kitaifa') }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ localized('National Partners & Affiliations', 'Mahusiano ya Kitaifa') }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($national as $affiliation)

                        <article
                            class="group flex flex-col border border-gray-100 bg-white rounded-lg p-6 hover:border-action/30 hover:shadow-sm transition"
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

                                    <div class="text-2xl font-bold text-main text-center">
                                        {{ $affiliation->name }}
                                    </div>

                                @endif

                            </div>


                            {{-- TYPE --}}
                            @if ($affiliation->type)

                                <span
                                    class="self-start inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-action bg-action/10 border border-action/20 rounded-full"
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
                            @if ($affiliation->url)

                                <div class="mt-auto pt-6">

                                    <a
                                        href="{{ $affiliation->url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
                                    >
                                        {{ localized('Visit Website', 'Tembelea Tovuti') }}

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

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('International', 'Taasisi za Kimataifa') }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ localized('International Partners & Affiliations', 'Mahusiano ya Kimataifa') }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($international as $affiliation)

                        <article
                            class="group flex flex-col border border-gray-100 bg-white rounded-lg p-6 hover:border-action/30 hover:shadow-sm transition"
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

                                    <div class="text-2xl font-bold text-main text-center">
                                        {{ $affiliation->name }}
                                    </div>

                                @endif

                            </div>


                            {{-- TYPE --}}
                            @if ($affiliation->type)

                                <span
                                    class="self-start inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-action bg-action/10 border border-action/20 rounded-full"
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
                            @if ($affiliation->url)

                                <div class="mt-auto pt-6">

                                    <a
                                        href="{{ $affiliation->url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
                                    >
                                        {{ localized('Visit Website', 'Tembelea Tovuti') }}

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
