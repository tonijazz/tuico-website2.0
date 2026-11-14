@extends('layouts.app')

@section('title', localized('Regional Offices', 'Ofisi za Mikoa'))

@section('content')

    {{-- HERO --}}

    <x-page-hero :eyebrow="localized('TUICO Presence Across Tanzania', 'Uwepo wa TUICO Nchini')" :title="localized('Regional Offices', 'Ofisi za Mikoa')" :intro="localized('TUICO regional offices coordinate the Union’s activities and services to members across different parts of Tanzania.', 'Ofisi za TUICO zinazoratibu shughuli za Chama na huduma kwa wanachama katika maeneo mbalimbali nchini.')" />


    {{-- AT A GLANCE --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <div class="border border-gray-100 rounded-lg p-5 bg-white">
                <p class="text-3xl font-bold text-main">
                    {{ $regions->count() }}
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    {{ localized('Regional Offices', 'Ofisi za Mikoa') }}
                </p>
            </div>

            <div class="border border-gray-100 rounded-lg p-5 bg-white">
                <p class="text-3xl font-bold text-main">
                    8
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    {{ localized('Zones', 'Kanda') }}
                </p>
            </div>

            <div class="border border-gray-100 rounded-lg p-5 bg-white">
                <p class="text-3xl font-bold text-main">
                    3
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    {{ localized('Sub-Offices', 'Ofisi Ndogo') }}
                </p>
            </div>

        </div>

    </section>


    {{-- REGIONAL OFFICES --}}

    <section class="max-w-7xl mx-auto px-6 pb-12">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-action mb-2">
                {{ localized('Our Offices', 'Ofisi Zetu') }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ localized('Regional Offices', 'Ofisi za Mikoa') }}
            </h2>

        </div>


        @if ($regions->count())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($regions as $region)

                    <article class="border border-gray-100 rounded-lg bg-white p-6 hover:border-action/30 transition">

                        <div class="flex items-start justify-between gap-4">

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">
                                    {{ $region->name }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ localized('Regional Office', 'Ofisi ya Mkoa') }}
                                </p>
                            </div>

                            @if ($region->is_zonal_seat)

                                <span class="shrink-0 inline-flex items-center rounded-full bg-action/10 px-3 py-1 text-xs font-medium text-action">
                                    {{ localized('Zonal Office', 'Ofisi ya Kanda') }}
                                </span>

                            @endif

                        </div>


                        @if ($region->zone)

                            <div class="mt-5 pt-4 border-t border-gray-100">

                                <p class="text-xs uppercase tracking-wider text-gray-400">
                                    {{ localized('Zone', 'Kanda') }}
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
                                        {{ localized('Address:', 'Anwani:') }}
                                    </span>
                                    {{ $region->address }}
                                </p>

                            @endif

                            @if ($region->phone)

                                <p class="text-sm text-gray-600">
                                    <span class="font-medium text-gray-800">
                                        {{ localized('Phone:', 'Simu:') }}
                                    </span>
                                    {{ $region->phone }}
                                </p>

                            @endif

                            @if ($region->email)

                                <p class="text-sm text-gray-600 break-all">
                                    <span class="font-medium text-gray-800">
                                        {{ localized('Email:', 'Barua pepe:') }}
                                    </span>
                                    {{ $region->email }}
                                </p>

                            @endif

                        </div>


                        @if ($region->subOffices->count())

                            <div class="mt-5 pt-4 border-t border-gray-100">

                                <p class="text-xs uppercase tracking-wider text-gray-400">
                                    {{ localized('Sub-Offices', 'Ofisi Ndogo') }}
                                </p>

                                <p class="text-sm font-medium text-gray-800 mt-1">
                                    {{ $region->subOffices->count() }}
                                    {{ localized('Sub-Office(s)', 'Ofisi Ndogo') }}
                                </p>

                            </div>

                        @endif


                        <div class="mt-6">

<a
    href="{{ is_sw() ? url('/sw/regions/' . $region->slug . '?from=regions') : route('regions.show', $region->slug) . '?from=regions' }}"
    class="inline-flex items-center text-sm font-semibold text-action hover:text-main"
>
    {{ localized('View Office', 'Tazama Ofisi') }}
    <span class="ml-2">→</span>
</a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="border border-gray-100 rounded-lg p-8 text-center text-gray-500">
                {{ localized('No regional offices found.', 'Hakuna ofisi za mikoa zilizopatikana.') }}
            </div>

        @endif

    </section>

@endsection
