@extends('layouts.app')

@section('title', $zone->name)

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-tuico-navy text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Kanda' : 'Zone' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $zone->name }}
            </h1>

        </div>

    </section>


    {{-- =========================
         ZONE INFORMATION
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- CHAIRPERSON --}}
            @if ($zone->chairperson)
                <div class="border border-gray-100 bg-gray-50 p-6">

                    <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                        {{ app()->getLocale() === 'sw' ? 'Mwenyekiti wa Kanda' : 'Zone Chairperson' }}
                    </p>

                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $zone->chairperson->name }}
                    </h2>

                </div>
            @endif


            {{-- MEMBER REGIONS --}}
            <div class="{{ $zone->chairperson ? 'lg:col-span-2' : 'lg:col-span-3' }}">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ app()->getLocale() === 'sw' ? 'Mikoa Wanachama' : 'Member Regions' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ app()->getLocale() === 'sw' ? 'Mikoa ya Kanda' : 'Regions in this Zone' }}
                </h2>

                <div class="mt-6 space-y-3">

                    @foreach ($zone->offices as $office)
                        <a href="{{ app()->getLocale() === 'sw' ? url('/sw/regions/' . $office->slug) : route('regions.show', $office->slug) }}"
                            class="group flex items-center justify-between gap-4 border border-gray-100 bg-white px-5 py-4 hover:border-blue-100 hover:bg-blue-50 transition">

                            <div class="min-w-0">

                                <span class="font-medium text-gray-900 group-hover:text-blue-800">
                                    {{ $office->name }}
                                </span>

                                @if ($office->is_zonal_seat)
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 ml-2">
                                        {{ app()->getLocale() === 'sw' ? 'Ofisi ya Kanda' : 'Zonal Office' }}
                                    </span>
                                @endif

                            </div>

                            <span class="text-blue-700 group-hover:translate-x-1 transition">
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

            <a href="{{ app()->getLocale() === 'sw' ? url('/sw/zones') : route('zones.index') }}"
                class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-950 transition">

                <span class="mr-2">←</span>

                {{ app()->getLocale() === 'sw' ? 'Rudi kwenye Kanda' : 'Back to Zones' }}

            </a>

        </div>

    </section>

@endsection
