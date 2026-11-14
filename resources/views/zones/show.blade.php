@extends('layouts.app')

@section('title', $zone->name)

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <x-page-hero :eyebrow="localized('Zone', 'Kanda')" :title="$zone->name" />


    {{-- =========================
         ZONE INFORMATION
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- CHAIRPERSON --}}
            @if ($zone->chairperson)
                <div class="border border-gray-100 bg-gray-50 p-6">

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('Zone Chairperson', 'Mwenyekiti wa Kanda') }}
                    </p>

                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $zone->chairperson->name }}
                    </h2>

                </div>
            @endif


            {{-- MEMBER REGIONS --}}
            <div class="{{ $zone->chairperson ? 'lg:col-span-2' : 'lg:col-span-3' }}">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('Member Regions', 'Mikoa Wanachama') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('Regions in this Zone', 'Mikoa ya Kanda') }}
                </h2>

                <div class="mt-6 space-y-3">

                    @foreach ($zone->offices as $office)
                        <a href="{{ is_sw() ? url('/sw/regions/' . $office->slug) : route('regions.show', $office->slug) }}"
                            class="group flex items-center justify-between gap-4 border border-gray-100 bg-white px-5 py-4 hover:border-action/20 hover:bg-action/10 transition">

                            <div class="min-w-0">

                                <span class="font-medium text-gray-900 group-hover:text-action">
                                    {{ $office->name }}
                                </span>

                                @if ($office->is_zonal_seat)
                                    <span
                                        class="inline-flex items-center rounded-full bg-action/20 px-2.5 py-0.5 text-xs font-medium text-action ml-2">
                                        {{ localized('Zonal Office', 'Ofisi ya Kanda') }}
                                    </span>
                                @endif

                            </div>

                            <span class="text-action group-hover:translate-x-1 transition">
                                →
                            </span>

                        </a>
                    @endforeach

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
         BACK TO ZONES
    ========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <a href="{{ is_sw() ? url('/sw/zones') : route('zones.index') }}"
                class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition">

                <span class="mr-2">←</span>

                {{ localized('Back to Zones', 'Rudi kwenye Kanda') }}

            </a>

        </div>

    </section>

@endsection
