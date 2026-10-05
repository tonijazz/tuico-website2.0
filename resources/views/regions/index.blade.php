@extends('layouts.app')

@section('title', app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices')

@section('content')

    {{-- HERO --}}

    <section class="bg-tuico-navy text-white">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Uwepo wa TUICO Nchini' : 'TUICO Presence Across Tanzania' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices' }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                {{ app()->getLocale() === 'sw'
                    ? 'Ofisi za TUICO zinazoratibu shughuli za Chama na huduma kwa wanachama katika maeneo mbalimbali nchini.'
                    : 'TUICO regional offices coordinate the Union’s activities and services to members across different parts of Tanzania.' }}
            </p>

        </div>
    </section>


    {{-- AT A GLANCE --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <div class="border border-gray-100 rounded-lg p-5 bg-white">
                <p class="text-3xl font-bold text-tuico-navy">
                    {{ $regions->count() }}
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices' }}
                </p>
            </div>

            <div class="border border-gray-100 rounded-lg p-5 bg-white">
                <p class="text-3xl font-bold text-tuico-navy">
                    8
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    {{ app()->getLocale() === 'sw' ? 'Kanda' : 'Zones' }}
                </p>
            </div>

            <div class="border border-gray-100 rounded-lg p-5 bg-white">
                <p class="text-3xl font-bold text-tuico-navy">
                    3
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    {{ app()->getLocale() === 'sw' ? 'Ofisi Ndogo' : 'Sub-Offices' }}
                </p>
            </div>

        </div>

    </section>


    {{-- REGIONAL OFFICES --}}

    <section class="max-w-7xl mx-auto px-6 pb-12">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Ofisi Zetu' : 'Our Offices' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices' }}
            </h2>

        </div>


        @if ($regions->count())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($regions as $region)

                    <article class="border border-gray-100 rounded-lg bg-white p-6 hover:border-blue-200 transition">

                        <div class="flex items-start justify-between gap-4">

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">
                                    {{ $region->name }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ app()->getLocale() === 'sw'
                                        ? 'Ofisi ya Mkoa'
                                        : 'Regional Office' }}
                                </p>
                            </div>

                            @if ($region->is_zonal_seat)

                                <span class="shrink-0 inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700">
                                    {{ app()->getLocale() === 'sw' ? 'Ofisi ya Kanda' : 'Zonal Office' }}
                                </span>

                            @endif

                        </div>


                        @if ($region->zone)

                            <div class="mt-5 pt-4 border-t border-gray-100">

                                <p class="text-xs uppercase tracking-wider text-gray-400">
                                    {{ app()->getLocale() === 'sw' ? 'Kanda' : 'Zone' }}
                                </p>

                                <p class="text-sm font-medium text-gray-800 mt-1">
                                    {{ $region->zone->name }}
                                </p>

                            </div>

                        @endif


                        <div class="mt-5 space-y-2">

                            @if ($region->address)

                                <p class="text-sm text-gray-600 leading-6">
                                    <span class="font-medium text-gray-800">
                                        {{ app()->getLocale() === 'sw' ? 'Anwani:' : 'Address:' }}
                                    </span>
                                    {{ $region->address }}
                                </p>

                            @endif

                            @if ($region->phone)

                                <p class="text-sm text-gray-600">
                                    <span class="font-medium text-gray-800">
                                        {{ app()->getLocale() === 'sw' ? 'Simu:' : 'Phone:' }}
                                    </span>
                                    {{ $region->phone }}
                                </p>

                            @endif

                            @if ($region->email)

                                <p class="text-sm text-gray-600 break-all">
                                    <span class="font-medium text-gray-800">
                                        {{ app()->getLocale() === 'sw' ? 'Barua pepe:' : 'Email:' }}
                                    </span>
                                    {{ $region->email }}
                                </p>

                            @endif

                        </div>


                        @if ($region->subOffices->count())

                            <div class="mt-5 pt-4 border-t border-gray-100">

                                <p class="text-xs uppercase tracking-wider text-gray-400">
                                    {{ app()->getLocale() === 'sw' ? 'Ofisi Ndogo' : 'Sub-Offices' }}
                                </p>

                                <p class="text-sm font-medium text-gray-800 mt-1">
                                    {{ $region->subOffices->count() }}
                                    {{ app()->getLocale() === 'sw' ? 'Ofisi Ndogo' : 'Sub-Office(s)' }}
                                </p>

                            </div>

                        @endif


                        <div class="mt-6">

                            <a
                                href="{{ route('regions.show', $region->slug) }}"
                                class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-900"
                            >
                                {{ app()->getLocale() === 'sw' ? 'Tazama Ofisi' : 'View Office' }}

                                <span class="ml-2">→</span>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="border border-gray-100 rounded-lg p-8 text-center text-gray-500">
                {{ app()->getLocale() === 'sw'
                    ? 'Hakuna ofisi za mikoa zilizopatikana.'
                    : 'No regional offices found.' }}
            </div>

        @endif

    </section>

@endsection
