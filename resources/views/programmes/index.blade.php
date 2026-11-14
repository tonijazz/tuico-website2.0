@extends('layouts.app')


@section('title', localized('Strategic Plan', 'Mpango Mkakati'))

@section('content')

    {{-- =========================================================
HERO
========================================================== --}}

    <x-page-hero :eyebrow="localized('Strategic Direction', 'Mwelekeo wa Kimkakati')" :title="localized('Strategic Plan', 'Mpango Mkakati')" :intro="localized('The strategic direction guiding TUICO’s priorities and implementation.', 'Mwelekeo unaoongoza vipaumbele na utekelezaji wa TUICO.')" />

    {{-- =========================================================
STRATEGIC AREAS
========================================================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-8">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('Priorities', 'Vipaumbele') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('Strategic Areas', 'Maeneo ya Kimkakati') }}
                </h2>

            </div>


            @if ($strategicAreas->count())

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($strategicAreas as $area)
                        <article
                            class="group bg-white rounded-lg border border-gray-100 p-6 hover:border-action/30 hover:shadow-sm transition">

                            @if ($area->icon)
                                <div class="mb-5 text-main">
                                    <x-dynamic-component :component="$area->icon" class="w-8 h-8" />
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-action transition">
                                {{ $area->title }}
                            </h3>

                            @if ($area->description)
                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                    {{ \Illuminate\Support\Str::limit($area->description, 150) }}
                                </p>
                            @endif

                            <a href="{{ is_sw()
    ? url('/sw/strategic-plan/areas/' . $area->id)
    : route('programmes.strategic-area', $area) }}"
                                class="inline-flex items-center mt-5 text-sm font-semibold text-action hover:text-main transition">
                                {{ localized('View Details', 'Angalia Maelezo') }}
                                <span class="ml-2">→</span>
                            </a>

                        </article>
                    @endforeach

                </div>


                @if ($strategicAreas->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $strategicAreas->onEachSide(1)->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white rounded-lg border border-gray-100 px-6 py-12 text-center">

                    <p class="text-sm text-gray-500">
                        {{ localized('No strategic areas are currently available.', 'Hakuna maeneo ya kimkakati yaliyowekwa kwa sasa.') }}
                    </p>

                </div>

            @endif

        </div>

    </section>

    {{-- =========================================================
PROGRAMMES
========================================================== --}}

    <section class="bg-white">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-8">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('Implementation', 'Utekelezaji') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('Programmes', 'Programu') }}
                </h2>

            </div>


            <div x-data="{ tab: 'active' }">

                {{-- TABS --}}
                <div class="flex flex-wrap gap-2 mb-8">

                    <button @click="tab = 'active'"
                        :class="tab === 'active'
                            ?
                            'bg-main border-main text-white' :
                            'bg-white border-gray-200 text-gray-600 hover:border-action/30 hover:text-action'"
                        class="px-4 py-2 text-xs font-bold uppercase tracking-wider border rounded-full transition">
                        {{ localized('Active', 'Zinazoendelea') }}
                    </button>

                    <button @click="tab = 'past'"
                        :class="tab === 'past'
                            ?
                            'bg-main border-main text-white' :
                            'bg-white border-gray-200 text-gray-600 hover:border-action/30 hover:text-action'"
                        class="px-4 py-2 text-xs font-bold uppercase tracking-wider border rounded-full transition">
                        {{ localized('Past', 'Zilizopita') }}
                    </button>

                </div>


                {{-- ACTIVE PROGRAMMES --}}
                <div x-show="tab === 'active'" x-cloak>

                    @if ($activeProgrammes->count())

                        <div class="space-y-5">

                            @foreach ($activeProgrammes as $programme)
                                <article
                                    class="bg-white rounded-lg border border-gray-100 p-6 hover:border-action/30 hover:shadow-sm transition">

                                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                        <div class="max-w-3xl">

                                            <h3 class="text-xl md:text-2xl font-bold leading-snug text-gray-900">
                                                {{ $programme->title }}
                                            </h3>

                                            @if ($programme->description)
                                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                                    {{ \Illuminate\Support\Str::limit($programme->description, 180) }}
                                                </p>
                                            @endif

                                        </div>

                                        <span
                                            class="inline-flex w-fit shrink-0 items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full bg-green-50 text-green-700 border border-green-100">
                                            {{ localized('Active', 'Inaendelea') }}
                                        </span>

                                    </div>


                                    <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-x-8 gap-y-3">

                                        @if ($programme->starts_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ localized('Start Date', 'Kuanza') }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->starts_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                        @if ($programme->ends_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ localized('End Date', 'Kumalizika') }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->ends_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                    </div>


                                    <a href="{{ route('programmes.programme', $programme) }}"
                                        class="inline-flex items-center mt-5 text-sm font-semibold text-action hover:text-main transition">
                                        {{ localized('View Programme', 'Angalia Programu') }}
                                        <span class="ml-2">→</span>
                                    </a>

                                </article>
                            @endforeach

                        </div>


                        @if ($activeProgrammes->hasPages())
                            <div class="mt-10 flex justify-center">
                                {{ $activeProgrammes->onEachSide(1)->links() }}
                            </div>
                        @endif
                    @else
                        <div class="rounded-lg border border-gray-100 bg-gray-50 px-6 py-12 text-center">

                            <p class="text-sm text-gray-500">
                                {{ localized('No active programmes are currently available.', 'Hakuna programu zinazoendelea kwa sasa.') }}
                            </p>

                        </div>

                    @endif

                </div>


                {{-- PAST PROGRAMMES --}}
                <div x-show="tab === 'past'" x-cloak>

                    @if ($pastProgrammes->count())

                        <div class="space-y-5">

                            @foreach ($pastProgrammes as $programme)
                                <article
                                    class="bg-white rounded-lg border border-gray-100 p-6 hover:border-action/30 hover:shadow-sm transition">

                                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

                                        <div class="max-w-3xl">

                                            <h3 class="text-xl md:text-2xl font-bold leading-snug text-gray-900">
                                                {{ $programme->title }}
                                            </h3>

                                            @if ($programme->description)
                                                <p class="mt-3 text-sm text-gray-600 leading-7">
                                                    {{ \Illuminate\Support\Str::limit($programme->description, 180) }}
                                                </p>
                                            @endif

                                        </div>

                                        <span
                                            class="inline-flex w-fit shrink-0 items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ localized('Past', 'Iliyopita') }}
                                        </span>

                                    </div>


                                    <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-x-8 gap-y-3">

                                        @if ($programme->starts_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ localized('Start Date', 'Kuanza') }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->starts_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                        @if ($programme->ends_at)
                                            <div>
                                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                                    {{ localized('End Date', 'Kumalizika') }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-gray-700">
                                                    {{ $programme->ends_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif

                                    </div>


                                    <a href="{{ route('programmes.programme', $programme) }}"
                                        class="inline-flex items-center mt-5 text-sm font-semibold text-action hover:text-main transition">
                                        {{ localized('View Programme', 'Angalia Programu') }}
                                        <span class="ml-2">→</span>
                                    </a>

                                </article>
                            @endforeach

                        </div>


                        @if ($pastProgrammes->hasPages())
                            <div class="mt-10 flex justify-center">
                                {{ $pastProgrammes->onEachSide(1)->links() }}
                            </div>
                        @endif
                    @else
                        <div class="rounded-lg border border-gray-100 bg-gray-50 px-6 py-12 text-center">

                            <p class="text-sm text-gray-500">
                                {{ localized('No past programmes are currently available.', 'Hakuna programu zilizopita kwa sasa.') }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>

@endsection
