@extends('layouts.app')

@section('title')
    {{ $region->name }} —
    {{ app()->getLocale() === 'sw' ? 'Ofisi ya Mkoa' : 'Regional Office' }}
@endsection

@section('content')

    {{-- HERO --}}

    <section class="bg-tuico-navy text-white">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices' }}
            </p>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div>
                    <h1 class="text-4xl md:text-5xl font-bold">
                        {{ $region->name }}
                    </h1>

                    <p class="mt-3 text-lg text-blue-100">
                        {{ app()->getLocale() === 'sw'
                            ? 'Ofisi ya Mkoa'
                            : 'Regional Office' }}
                    </p>
                </div>

                @if ($region->is_zonal_seat)

                    <span class="self-start inline-flex items-center rounded-full bg-white/10 border border-white/20 px-4 py-2 text-sm font-medium text-white">
                        {{ app()->getLocale() === 'sw' ? 'Ofisi ya Kanda' : 'Zonal Office' }}
                    </span>

                @endif

            </div>

        </div>
    </section>


    {{-- OFFICE INFORMATION --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">

                <div class="mb-6">

                    <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                        {{ app()->getLocale() === 'sw' ? 'Taarifa za Ofisi' : 'Office Information' }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $region->name }}
                        {{ app()->getLocale() === 'sw'
                            ? '— Ofisi ya Mkoa'
                            : 'Regional Office' }}
                    </h2>

                </div>

                <div class="space-y-6">

                    @if ($region->address)

                        <div class="border border-gray-100 rounded-lg p-6">

                            <h3 class="text-sm uppercase tracking-wider text-gray-400 mb-2">
                                {{ app()->getLocale() === 'sw' ? 'Anwani' : 'Address' }}
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
                                    {{ app()->getLocale() === 'sw' ? 'Simu' : 'Phone' }}
                                </h3>

                                <a
                                    href="tel:{{ $region->phone }}"
                                    class="text-gray-800 font-medium hover:text-blue-700"
                                >
                                    {{ $region->phone }}
                                </a>

                            </div>

                        @endif

                        @if ($region->email)

                            <div class="border border-gray-100 rounded-lg p-6">

                                <h3 class="text-sm uppercase tracking-wider text-gray-400 mb-2">
                                    {{ app()->getLocale() === 'sw' ? 'Barua Pepe' : 'Email' }}
                                </h3>

                                <a
                                    href="mailto:{{ $region->email }}"
                                    class="text-gray-800 font-medium hover:text-blue-700 break-all"
                                >
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

                    <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                        {{ app()->getLocale() === 'sw' ? 'Kanda' : 'Zone' }}
                    </p>

                    @if ($region->zone)

                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $region->zone->name }}
                        </h3>

                        @if ($region->is_zonal_seat)

                            <div class="mt-5 border border-blue-100 bg-blue-50 rounded-lg p-4">

                                <p class="text-sm font-semibold text-blue-800">
                                    {{ app()->getLocale() === 'sw'
                                        ? 'Ofisi ya Kanda'
                                        : 'Zonal Office' }}
                                </p>

                                <p class="text-sm text-blue-700 mt-1">
                                    {{ app()->getLocale() === 'sw'
                                        ? 'Ofisi hii hutumika kama kituo cha shughuli za Kanda.'
                                        : 'This regional office serves as the zone activity centre.' }}
                                </p>

                            </div>

                        @endif

                    @else

                        <p class="text-gray-500">
                            {{ app()->getLocale() === 'sw'
                                ? 'Kanda haijaainishwa.'
                                : 'Zone not assigned.' }}
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

                    <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                        {{ app()->getLocale() === 'sw'
                            ? 'Uongozi wa Mkoa'
                            : 'Regional Leadership' }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ app()->getLocale() === 'sw'
                            ? 'Viongozi wa Mkoa'
                            : 'Regional Leaders' }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Chairperson --}}

                    @if ($region->chairperson)

                        <article class="bg-white border border-gray-100 rounded-lg p-6">

                            <div class="flex flex-col sm:flex-row gap-5">

                                <div class="w-24 h-24 flex-shrink-0 rounded-lg bg-blue-50 flex items-center justify-center overflow-hidden">

                                    @if ($region->chairperson->photo)

                                        <img
                                            src="{{ asset('storage/' . $region->chairperson->photo) }}"
                                            alt="{{ $region->chairperson->name }}"
                                            class="w-full h-full object-cover"
                                        >

                                    @else

                                        <svg
                                            class="w-10 h-10 text-blue-300"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632Z"
                                            />
                                        </svg>

                                    @endif

                                </div>

                                <div class="min-w-0">

                                    <p class="text-xs uppercase tracking-wider text-blue-700">
                                        {{ app()->getLocale() === 'sw'
                                            ? 'Mwenyekiti wa Mkoa'
                                            : 'Regional Chairperson' }}
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

                                <div class="w-24 h-24 flex-shrink-0 rounded-lg bg-blue-50 flex items-center justify-center overflow-hidden">

                                    @if ($region->secretary->photo)

                                        <img
                                            src="{{ asset('storage/' . $region->secretary->photo) }}"
                                            alt="{{ $region->secretary->name }}"
                                            class="w-full h-full object-cover"
                                        >

                                    @else

                                        <svg
                                            class="w-10 h-10 text-blue-300"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632Z"
                                            />
                                        </svg>

                                    @endif

                                </div>

                                <div class="min-w-0">

                                    <p class="text-xs uppercase tracking-wider text-blue-700">
                                        {{ app()->getLocale() === 'sw'
                                            ? 'Katibu wa Mkoa'
                                            : 'Regional Secretary' }}
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

                    <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                        {{ app()->getLocale() === 'sw' ? 'Ofisi Zinazohusiana' : 'Associated Offices' }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ app()->getLocale() === 'sw' ? 'Ofisi Ndogo' : 'Sub-Offices' }}
                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($region->subOffices as $subOffice)

                        <div class="border border-gray-100 rounded-lg p-6">

                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $subOffice->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ app()->getLocale() === 'sw'
                                    ? 'Ofisi Ndogo'
                                    : 'Sub-Office' }}
                            </p>

                            <div class="mt-5 space-y-3">

                                @if ($subOffice->address)

                                    <p class="text-sm text-gray-600 leading-6">
                                        <span class="font-medium text-gray-800">
                                            {{ app()->getLocale() === 'sw' ? 'Anwani:' : 'Address:' }}
                                        </span>
                                        {{ $subOffice->address }}
                                    </p>

                                @endif

                                @if ($subOffice->phone)

                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-gray-800">
                                            {{ app()->getLocale() === 'sw' ? 'Simu:' : 'Phone:' }}
                                        </span>
                                        {{ $subOffice->phone }}
                                    </p>

                                @endif

                                @if ($subOffice->email)

                                    <p class="text-sm text-gray-600 break-all">
                                        <span class="font-medium text-gray-800">
                                            {{ app()->getLocale() === 'sw' ? 'Barua pepe:' : 'Email:' }}
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

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ app()->getLocale() === 'sw' ? 'Mahali' : 'Location' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ app()->getLocale() === 'sw'
                        ? 'Mahali pa Mkoa'
                        : 'Regional Location' }}
                </h2>

            </div>

            <div class="border border-gray-100 rounded-lg overflow-hidden bg-gray-50">

                <div
                    id="regional-map"
                    class="w-full h-[420px]"
                ></div>

            </div>

        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

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
                        '<strong>{{ $region->name }}</strong><br>{{ app()->getLocale() === "sw" ? "Ofisi ya Mkoa" : "Regional Office" }}'
                    )
                    .openPopup();

            });
        </script>

    @endif


    {{-- BACK --}}

    <section class="max-w-7xl mx-auto px-6 pb-12">

        <a
            href="{{ route('regions.index') }}"
            class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-900"
        >
            <span class="mr-2">←</span>

            {{ app()->getLocale() === 'sw'
                ? 'Rudi kwenye Ofisi za Mikoa'
                : 'Back to Regional Offices' }}
        </a>

    </section>

@endsection
