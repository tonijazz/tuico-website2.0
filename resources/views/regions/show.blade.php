@extends('layouts.app')

@section('title')
    {{ $region->name }} —
    {{ localized('Regional Office', 'Ofisi ya Mkoa') }}
@endsection

@section('content')

    {{-- HERO --}}

    <x-page-hero :eyebrow="localized('Regional Offices', 'Ofisi za Mikoa')" :title="$region->name" :intro="localized('Regional Office', 'Ofisi ya Mkoa')">
        @if ($region->is_zonal_seat)
            <x-slot:aside>
                <span
                    class="self-start inline-flex items-center rounded-full bg-white/10 border border-white/20 px-4 py-2 text-sm font-medium text-white">
                    {{ localized('Zonal Office', 'Ofisi ya Kanda') }}
                </span>
            </x-slot:aside>
        @endif
    </x-page-hero>


    {{-- OFFICE INFORMATION --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">

                <div class="mb-6">

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('Office Information', 'Taarifa za Ofisi') }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $region->name }}
                        {{ localized('Regional Office', '— Ofisi ya Mkoa') }}
                    </h2>

                </div>

                <div class="space-y-6">

                    @if ($region->address)
                        <div class="border border-gray-100 rounded-lg p-6">

                            <h3 class="text-sm uppercase tracking-wider text-gray-400 mb-2">
                                {{ localized('Address', 'Anwani') }}
                            </h3>

                            <p class="text-gray-700 leading-7">
                                {{ $region->address }}
                            </p>

                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        @if ($region->phone)
                            <div class="border border-gray-100 rounded-lg p-6">

                                <h3 class="text-sm uppercase tracking-wider text-gray-400 mb-2">
                                    {{ localized('Phone', 'Simu') }}
                                </h3>

                                <a href="tel:{{ $region->phone }}" class="text-gray-800 font-medium hover:text-action">
                                    {{ $region->phone }}
                                </a>

                            </div>
                        @endif

                        @if ($region->email)
                            <div class="border border-gray-100 rounded-lg p-6">

                                <h3 class="text-sm uppercase tracking-wider text-gray-400 mb-2">
                                    {{ localized('Email', 'Barua Pepe') }}
                                </h3>

                                <a href="mailto:{{ $region->email }}"
                                    class="text-gray-800 font-medium hover:text-action break-all">
                                    {{ $region->email }}
                                </a>

                            </div>
                        @endif

                    </div>

                </div>

            </div>


            {{-- ZONE INFORMATION --}}

            <aside>

                <div class="bg-gray-50 border border-gray-100 rounded-lg p-6">

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('Zone', 'Kanda') }}
                    </p>

                    @if ($region->zone)
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $region->zone->name }}
                        </h3>

                        @if ($region->is_zonal_seat)
                            <div class="mt-5 border border-action/20 bg-action/10 rounded-lg p-4">

                                <p class="text-sm font-semibold text-action">
                                    {{ localized('Zonal Office', 'Ofisi ya Kanda') }}
                                </p>

                                <p class="text-sm text-action mt-1">
                                    {{ localized('This regional office serves as the zone activity centre.', 'Ofisi hii hutumika kama kituo cha shughuli za Kanda.') }}
                                </p>

                            </div>
                        @endif
                    @else
                        <p class="text-gray-500">
                            {{ localized('Zone not assigned.', 'Kanda haijaainishwa.') }}
                        </p>
                    @endif

                </div>

            </aside>

        </div>

    </section>


    {{-- REGIONAL LEADERSHIP --}}

    @if ($region->chairperson || $region->secretary)

        <section class="bg-gray-50">

            <div class="max-w-7xl mx-auto px-6 py-8">

                <div class="max-w-3xl mb-6">

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('Regional Leadership', 'Uongozi wa Mkoa') }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ localized('Regional Leaders', 'Viongozi wa Mkoa') }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Chairperson --}}

                    @if ($region->chairperson)
                        <article class="bg-white border border-gray-100 rounded-lg p-6">

                            <div class="flex flex-col sm:flex-row gap-5">

                                <div
                                    class="w-24 h-24 flex-shrink-0 rounded-lg bg-action/10 flex items-center justify-center overflow-hidden">

                                    @if ($region->chairperson->photo)
                                        <img src="{{ asset('storage/' . $region->chairperson->photo) }}"
                                            alt="{{ $region->chairperson->name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-10 h-10 text-action/40" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632Z" />
                                        </svg>
                                    @endif

                                </div>

                                <div class="min-w-0">

                                    <p class="text-xs uppercase tracking-wider text-action">
                                        {{ localized('Regional Chairperson', 'Mwenyekiti wa Mkoa') }}
                                    </p>

                                    <h3 class="text-xl font-semibold text-gray-900 mt-1">
                                        {{ $region->chairperson->name }}
                                    </h3>

                                </div>

                            </div>

                            @if ($region->chairperson->bio)
                                <p class="text-sm text-gray-600 leading-7 mt-5">
                                    {{ $region->chairperson->bio }}
                                </p>
                            @endif

                        </article>
                    @endif


                    {{-- Secretary --}}

                    @if ($region->secretary)
                        <article class="bg-white border border-gray-100 rounded-lg p-6">

                            <div class="flex flex-col sm:flex-row gap-5">

                                <div
                                    class="w-24 h-24 flex-shrink-0 rounded-lg bg-action/10 flex items-center justify-center overflow-hidden">

                                    @if ($region->secretary->photo)
                                        <img src="{{ asset('storage/' . $region->secretary->photo) }}"
                                            alt="{{ $region->secretary->name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-10 h-10 text-action/40" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632Z" />
                                        </svg>
                                    @endif

                                </div>

                                <div class="min-w-0">

                                    <p class="text-xs uppercase tracking-wider text-action">
                                        {{ localized('Regional Secretary', 'Katibu wa Mkoa') }}
                                    </p>

                                    <h3 class="text-xl font-semibold text-gray-900 mt-1">
                                        {{ $region->secretary->name }}
                                    </h3>

                                </div>

                            </div>

                            @if ($region->secretary->bio)
                                <p class="text-sm text-gray-600 leading-7 mt-5">
                                    {{ $region->secretary->bio }}
                                </p>
                            @endif

                        </article>
                    @endif

                </div>

            </div>

        </section>

    @endif


    {{-- SUB-OFFICES --}}

    @if ($region->subOffices->count())
        <section class="bg-white">

            <div class="max-w-7xl mx-auto px-6 py-8">

                <div class="max-w-3xl mb-6">

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('Associated Offices', 'Ofisi Zinazohusiana') }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ localized('Sub-Offices', 'Ofisi Ndogo') }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($region->subOffices as $subOffice)
                        <div class="border border-gray-100 rounded-lg p-6">

                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $subOffice->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ localized('Sub-Office', 'Ofisi Ndogo') }}
                            </p>

                            <div class="mt-5 space-y-3">

                                @if ($subOffice->address)
                                    <p class="text-sm text-gray-600 leading-6">
                                        <span class="font-medium text-gray-800">
                                            {{ localized('Address:', 'Anwani:') }}
                                        </span>
                                        {{ $subOffice->address }}
                                    </p>
                                @endif

                                @if ($subOffice->phone)
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-gray-800">
                                            {{ localized('Phone:', 'Simu:') }}
                                        </span>
                                        {{ $subOffice->phone }}
                                    </p>
                                @endif

                                @if ($subOffice->email)
                                    <p class="text-sm text-gray-600 break-all">
                                        <span class="font-medium text-gray-800">
                                            {{ localized('Email:', 'Barua pepe:') }}
                                        </span>
                                        {{ $subOffice->email }}
                                    </p>
                                @endif

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </section>
    @endif


    {{-- MAP POSITION --}}

    @if ($region->lat && $region->lng)
        <section class="max-w-7xl mx-auto px-6 py-8">

            <div class="max-w-3xl mb-6">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('Location', 'Mahali') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('Regional Location', 'Mahali pa Mkoa') }}
                </h2>

            </div>

            <div class="border border-gray-100 rounded-lg overflow-hidden bg-gray-50">

                <div id="regional-map" class="w-full h-[420px]"></div>

            </div>

        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const lat = {{ $region->lat }};
                const lng = {{ $region->lng }};

                const map = L.map('regional-map').setView([lat, lng], 14);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([lat, lng])
                    .addTo(map)
                    .bindPopup(
                        '<strong>{{ $region->name }}</strong><br>{{ localized('Regional Office', 'Ofisi ya Mkoa') }}'
                    )
                    .openPopup();

            });
        </script>
    @endif


    {{-- BACK --}}

    @php
        $backToZones = request()->query('from') === 'zones';
    @endphp

    <section class="max-w-7xl mx-auto px-6 pb-12">

        <a href="{{ $backToZones
            ? (is_sw()
                ? url('/sw/zones')
                : route('zones.index'))
            : (is_sw()
                ? url('/sw/regions')
                : route('regions.index')) }}"
            class="inline-flex items-center text-sm font-semibold text-action hover:text-main">
            <span class="mr-2">←</span>

            {{ $backToZones
                ? (localized('Back to Zones', 'Rudi kwenye Kanda'))
                : (localized('Back to Regional Offices', 'Rudi kwenye Ofisi za Mikoa')) }}
        </a>

    </section>
@endsection
