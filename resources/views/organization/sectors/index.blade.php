@extends('layouts.app')

@section('title', localized('Sectors', 'Sekta'))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <x-page-hero :eyebrow="localized('TUICO Representation', 'Uwakilishi wa TUICO')" :title="localized('The Sectors We Represent', 'Sekta Tunazozihudumia')" :intro="localized('TUICO represents workers across industrial, commercial, financial, services, and consultancy sectors.', 'TUICO inahudumia wafanyakazi katika sekta nne (4): viwanda, biashara, taasisi za fedha, na huduma na ushauri.')" />


    {{-- =========================
         SECTORS
    ========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ($sectors as $sector)

                    <a href="{{ locale_url('sectors/' . \Illuminate\Support\Str::slug($sector->getTranslation('name', 'en'))) }}"
                        class="group bg-white border border-gray-100 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300">

                        {{-- ICON --}}
                        <div class="flex h-11 w-11 items-center justify-center bg-action/10 text-action
                                    group-hover:bg-action group-hover:text-white transition">

                            @if ($loop->iteration === 1)

                                {{-- Industrial — Factory --}}
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 21h18M5 21V5l7-3 7 3v16M9 9h2m-2 4h2m2-4h2m-2 4h2" />
                                </svg>

                            @elseif ($loop->iteration === 2)

                                {{-- Commercial — Storefront --}}
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 10h18M5 10l1.2-5h11.6L19 10M5 10v9h14v-9M8 14h3v5H8v-5zm6 0h3v5h-3v-5zM3 10c0 1.1.9 2 2 2s2-.9 2-2c0 1.1.9 2 2 2s2-.9 2-2c0 1.1.9 2 2 2s2-.9 2-2c0 1.1.9 2 2 2s2-.9 2-2" />
                                </svg>

                            @elseif ($loop->iteration === 3)

                                {{-- Financial Institutions — Bank --}}
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 10h18L12 4 3 10zM5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M3 21h18" />
                                </svg>

                            @else

                                {{-- Services & Consultancy — Service --}}
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>

                            @endif

                        </div>


                        {{-- NAME --}}
                        <h2 class="mt-6 text-xl font-bold text-main">
                            {{ $sector->getTranslation('name', app()->getLocale()) }}
                        </h2>


                        {{-- DESCRIPTION --}}
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit(
                                $sector->getTranslation('description', app()->getLocale()),
                                150
                            ) }}
                        </p>


                        {{-- LINK --}}
                        <div class="mt-5 text-sm font-semibold text-action group-hover:text-main">
                            {{ localized('View Sector →', 'Angalia Sekta →') }}
                        </div>

                    </a>

                @endforeach

            </div>

        </div>

    </section>

@endsection
