@extends('layouts.app')

@section('title')
    {{ localized('Our Zones', 'Kanda Zetu') }}
@endsection

@section('content')
    {{-- =========================
         HERO
    ========================== --}}

    <x-page-hero :eyebrow="localized('Union Administration', 'Uongozi wa Chama')" :title="localized('Our Zones', 'Kanda Zetu')" :intro="localized('TUICO operates through eight zones that connect and coordinate the activities of its regional offices.', 'TUICO inaendesha shughuli zake kupitia kanda nane zinazounganisha na kuratibu shughuli za ofisi za mikoa.')" />


    {{-- =========================
         ZONES
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-action mb-2">
                {{ localized('Zonal Structure', 'Muundo wa Kanda') }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ localized('TUICO Zones', 'Kanda za TUICO') }}
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
                                {{ localized('Regional Offices', 'Ofisi za Mikoa') }}
                            </p>

                        </div>

                        <div class="w-10 h-10 bg-action/10 text-action flex items-center justify-center shrink-0">

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
                            <a href="{{ is_sw() ? url('/sw/regions/' . $office->slug . '?from=zones') : route('regions.show', $office->slug) . '?from=zones' }}"
                                class="group flex items-center justify-between gap-4 border border-gray-100 bg-gray-50 px-4 py-3 hover:bg-action/10 hover:border-action/20 transition">

                                <div class="min-w-0">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <span class="font-medium text-gray-900 group-hover:text-action">
                                            {{ $office->name }}
                                        </span>

                                        @if ($office->is_zonal_seat)
                                            <span
                                                class="inline-flex items-center rounded-full bg-action/20 px-2.5 py-0.5 text-xs font-medium text-action">
                                                {{ localized('Zonal Office', 'Ofisi ya Kanda') }}
                                            </span>
                                        @endif

                                    </div>

                                    @if ($office->subOffices->count())
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $office->subOffices->count() }}
                                            {{ localized('Sub-Office', 'Ofisi Ndogo') }}{{ $office->subOffices->count() > 1 ? 's' : '' }}
                                        </p>
                                    @endif

                                </div>


                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor"
                                    class="w-5 h-5 text-gray-400 group-hover:text-action shrink-0">
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

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('TUICO Presence', 'Uwepo wa TUICO') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('Regional Offices Across Tanzania', 'Ofisi za Mikoa nchini') }}
                </h2>

                <p class="mt-3 text-gray-600 leading-7">
                    {{ localized('The map shows the regional locations where TUICO maintains offices across Tanzania.', 'Ramani inaonyesha maeneo ya ofisi za mikoa ya TUICO nchini Tanzania.') }}
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

    @push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
                                '{{ localized('Zonal Office', 'Ofisi ya Kanda') }}' +
                                '</span>';

                        }


                        popup += '<br><br>';


                        popup +=
                            '<a href="{{ localized('/regions/', '/sw/regions/') }}' +
                            office.slug + '?from=zones"' +
                            ' style="color:#1d4ed8;font-weight:600;">' +
                            '{{ localized('View Office', 'Tazama Ofisi') }}' +
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
@endpush
@endsection
