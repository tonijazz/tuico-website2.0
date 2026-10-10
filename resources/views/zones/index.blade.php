@extends('layouts.app')

@section('title')
    {{ app()->getLocale() === 'sw' ? 'Kanda Zetu' : 'Our Zones' }}
@endsection

@section('content')
    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-tuico-navy text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Uongozi wa Chama' : 'Union Administration' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ app()->getLocale() === 'sw' ? 'Kanda Zetu' : 'Our Zones' }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                {{ app()->getLocale() === 'sw'
                    ? 'TUICO inaendesha shughuli zake kupitia kanda nane zinazounganisha na kuratibu shughuli za ofisi za mikoa.'
                    : 'TUICO operates through eight zones that connect and coordinate the activities of its regional offices.' }}
            </p>

        </div>

    </section>


    {{-- =========================
         ZONES
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ app()->getLocale() === 'sw' ? 'Muundo wa Kanda' : 'Zonal Structure' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ app()->getLocale() === 'sw' ? 'Kanda za TUICO' : 'TUICO Zones' }}
            </h2>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach ($zones as $zone)
                <div class="border border-gray-100 bg-white p-6">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $zone->name }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $zone->offices->count() }}
                                {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa' : 'Regional Offices' }}
                            </p>

                        </div>

                        <div class="w-10 h-10 bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21s7-5.25 7-11a7 7 0 1 0-14 0c0 5.75 7 11 7 11Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>

                        </div>

                    </div>


                    <div class="mt-6 space-y-3">

                        @foreach ($zone->offices as $office)
                            <a href="{{ app()->getLocale() === 'sw' ? url('/sw/regions/' . $office->slug . '?from=zones') : route('regions.show', $office->slug) . '?from=zones' }}"
                                class="group flex items-center justify-between gap-4 border border-gray-100 bg-gray-50 px-4 py-3 hover:bg-blue-50 hover:border-blue-100 transition">

                                <div class="min-w-0">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <span class="font-medium text-gray-900 group-hover:text-blue-800">
                                            {{ $office->name }}
                                        </span>

                                        @if ($office->is_zonal_seat)
                                            <span
                                                class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                                {{ app()->getLocale() === 'sw' ? 'Ofisi ya Kanda' : 'Zonal Office' }}
                                            </span>
                                        @endif

                                    </div>

                                    @if ($office->subOffices->count())
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $office->subOffices->count() }}
                                            {{ app()->getLocale() === 'sw' ? 'Ofisi Ndogo' : 'Sub-Office' }}{{ $office->subOffices->count() > 1 ? 's' : '' }}
                                        </p>
                                    @endif

                                </div>


                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor"
                                    class="w-5 h-5 text-gray-400 group-hover:text-blue-700 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" />
                                </svg>

                            </a>
                        @endforeach

                    </div>

                </div>
            @endforeach

        </div>

    </section>


    {{-- =========================
         MAP
    ========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-6">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ app()->getLocale() === 'sw' ? 'Uwepo wa TUICO' : 'TUICO Presence' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ app()->getLocale() === 'sw' ? 'Ofisi za Mikoa nchini' : 'Regional Offices Across Tanzania' }}
                </h2>

                <p class="mt-3 text-gray-600 leading-7">
                    {{ app()->getLocale() === 'sw'
                        ? 'Ramani inaonyesha maeneo ya ofisi za mikoa ya TUICO nchini Tanzania.'
                        : 'The map shows the regional locations where TUICO maintains offices across Tanzania.' }}
                </p>

            </div>


            <div class="border border-gray-100 overflow-hidden bg-white">

                <div id="zones-map" class="w-full h-[520px]"></div>

            </div>

        </div>

    </section>


    {{-- =========================
         MAP SCRIPT
    ========================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const offices = [
                @foreach ($zones as $zone)
                    @foreach ($zone->offices as $office)
                        @if ($office->lat && $office->lng)
                            {
                                name: @json($office->name),
                                slug: @json($office->slug),
                                lat: {{ $office->lat }},
                                lng: {{ $office->lng }},
                                zone: @json($zone->name),
                                isZonal: {{ $office->is_zonal_seat ? 'true' : 'false' }}
                            },
                        @endif
                    @endforeach
                @endforeach
            ];

            /*
             |--------------------------------------------------------------------------
             | MAP
             |--------------------------------------------------------------------------
             */

            const map = L.map('zones-map', {
                minZoom: 6,
                maxZoom: 10,
                zoomControl: true
            });


            /*
             |--------------------------------------------------------------------------
             | TANZANIA BOUNDARY
             |--------------------------------------------------------------------------
             */

            fetch('{{ asset('geo/tanzania.geojson') }}')
                .then(response => response.json())
                .then(tanzania => {

                    const tanzaniaLayer = L.geoJSON(tanzania, {

                        style: {
                            color: '#1d4ed8',
                            weight: 2,
                            fillColor: '#dbeafe',
                            fillOpacity: 0.75
                        }

                    }).addTo(map);


                    /*
                     |--------------------------------------------------------------------------
                     | OFFICE MARKERS
                     |--------------------------------------------------------------------------
                     */

                    offices.forEach(function(office) {

                        const lat = parseFloat(office.lat);
                        const lng = parseFloat(office.lng);

                        if (isNaN(lat) || isNaN(lng)) {
                            return;
                        }


                        let popup = '<strong>' + office.name + '</strong>';

                        popup += '<br>' + office.zone;


                        if (office.isZonal) {

                            popup +=
                                '<br><span style="color:#1d4ed8;font-weight:600;">' +
                                '{{ app()->getLocale() === 'sw' ? 'Ofisi ya Kanda' : 'Zonal Office' }}' +
                                '</span>';

                        }


                        popup += '<br><br>';


                        popup +=
                            '<a href="{{ app()->getLocale() === 'sw' ? '/sw/regions/' : '/regions/' }}' +
                            office.slug + '?from=zones"' +
                            ' style="color:#1d4ed8;font-weight:600;">' +
                            '{{ app()->getLocale() === 'sw' ? 'Tazama Ofisi' : 'View Office' }}' +
                            '</a>';


                        L.marker([lat, lng])
                            .addTo(map)
                            .bindPopup(popup)
                            .bindTooltip(office.name, {
                                permanent: true,
                                direction: 'right',
                                offset: [8, 0],
                                className: 'regional-map-label'
                            });

                    });


                    /*
                     |--------------------------------------------------------------------------
                     | FIT TANZANIA
                     |--------------------------------------------------------------------------
                     */

                    map.fitBounds(tanzaniaLayer.getBounds(), {
                        padding: [20, 20]
                    });

                })
                .catch(error => {

                    console.error(
                        'Unable to load Tanzania map boundary:',
                        error
                    );

                });

        });
    </script>
@endsection
