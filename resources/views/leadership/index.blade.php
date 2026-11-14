@extends('layouts.app')

@section('title', localized('Leadership', 'Uongozi'))

@section('content')

{{-- =========================
     HERO
========================== --}}

<x-page-hero :eyebrow="localized('Leadership', 'Uongozi')" :title="localized('TUICO Leadership', 'Uongozi wa TUICO')" :intro="localized('The National Chairperson provides leadership and oversight. The General Secretary oversees the union’s administration and implements decisions made by its governing bodies. Sector heads coordinate representation in the four sectors, while department and unit heads support the union’s day-to-day work.
', 'Mwenyekiti wa Taifa huongoza vikao vikuu vinavyosimamia shughuli za Chama. Katibu Mkuu husimamia utawala wa Chama na utekelezaji wa maamuzi ya vyombo vyake vya uongozi. Wakuu wa sekta huratibu uwakilishi katika sekta nne, huku wakuu wa idara na vitengo wakisaidia utekelezaji wa shughuli za kila siku za Chama.')" />


{{-- =========================
     NATIONAL LEADERSHIP
========================== --}}

<section class="max-w-7xl mx-auto px-6 py-8">

    <div class="mb-6">

        <p class="text-sm uppercase tracking-widest text-action mb-2">
            {{ localized('National Leadership', 'Uongozi Taifa') }}
        </p>

        <h2 class="text-3xl font-bold text-gray-900">
            {{ localized('National Leaders of TUICO', 'Viongozi Wakuu wa TUICO') }}
        </h2>

    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @foreach (
            $nationalExecutives->sortBy(function ($executive) {
                $position = strtolower(
                    is_array($executive->position)
                        ? ($executive->position['en'] ?? '')
                        : $executive->position
                );

                return match (true) {
                    str_contains($position, 'chairperson') => 1,
                    str_contains($position, 'general secretary') => 2,
                    default => 3,
                };
            }) as $executive
        )

            <div class="border border-gray-100 bg-gray-50 p-6">

                <div class="flex items-start gap-5">

                    @if ($executive->photo)

                        <img
                            src="{{ asset('storage/' . $executive->photo) }}"
                            alt="{{ $executive->name }}"
                            class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-sm flex-shrink-0"
                        >

                    @else

                        <div class="w-24 h-24 rounded-full bg-action/10 flex items-center justify-center text-action text-2xl font-bold flex-shrink-0">
                            {{ collect(explode(' ', $executive->name))
                                ->filter()
                                ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                ->take(2)
                                ->implode('') }}
                        </div>

                    @endif


                    <div>

                        <p class="text-sm uppercase tracking-widest text-action mb-2">
                            {{ $executive->getTranslation('position', app()->getLocale()) }}
                        </p>

                        <h3 class="text-xl font-bold text-gray-900">
                            {{ $executive->name }}
                        </h3>

                        @if ($executive->bio)

                            <p class="mt-3 text-sm text-gray-600 leading-6">
                                {{ $executive->getTranslation('bio', app()->getLocale()) }}
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>


{{-- =========================
     SECTOR HEADS
========================== --}}

<section class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-action mb-2">
                {{ localized('Sectors', 'Sekta') }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ localized('Sector Heads', 'Wakuu wa Sekta') }}
            </h2>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach ($sectors as $sector)

                <div class="bg-white border border-gray-100 p-6">

                    @if ($sector->leader?->photo)

                        <img
                            src="{{ asset('storage/' . $sector->leader->photo) }}"
                            alt="{{ $sector->leader->name }}"
                            class="w-20 h-20 object-cover rounded-full border-4 border-white shadow-sm"
                        >

                    @else

                        <div class="w-20 h-20 rounded-full bg-action/10 flex items-center justify-center text-action text-xl font-bold">
                            {{ $sector->leader
                                ? collect(explode(' ', $sector->leader->name))
                                    ->filter()
                                    ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                    ->take(2)
                                    ->implode('')
                                : '?' }}
                        </div>

                    @endif


                    <p class="mt-5 text-xs uppercase tracking-widest text-action">
                        {{ $sector->getTranslation('name', app()->getLocale()) }}
                    </p>

                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        {{ $sector->leader?->name ?? (localized('Not assigned', 'Haijaainishwa')) }}
                    </h3>

                    @if ($sector->leader)

                        <p class="mt-2 text-sm text-gray-600">
                            {{ $sector->leader->getTranslation('position', app()->getLocale()) }}
                        </p>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

</section>


{{-- =========================
     DEPARTMENT HEADS
========================== --}}

<section class="max-w-7xl mx-auto px-6 py-8">

    <div class="mb-6">

        <p class="text-sm uppercase tracking-widest text-action mb-2">
            {{ localized('Departments', 'Idara') }}
        </p>

        <h2 class="text-3xl font-bold text-gray-900">
            {{ localized('Department Heads', 'Wakuu wa Idara') }}
        </h2>

    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @foreach ($departments as $department)

            <div class="border border-gray-100 bg-gray-50 p-6">

                @if ($department->leader?->photo)

                    <img
                        src="{{ asset('storage/' . $department->leader->photo) }}"
                        alt="{{ $department->leader->name }}"
                        class="w-20 h-20 object-cover rounded-full border-4 border-white shadow-sm"
                    >

                @else

                    <div class="w-20 h-20 rounded-full bg-action/10 flex items-center justify-center text-action text-xl font-bold">
                        {{ $department->leader
                            ? collect(explode(' ', $department->leader->name))
                                ->filter()
                                ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                ->take(2)
                                ->implode('')
                            : '?' }}
                    </div>

                @endif


                <p class="mt-5 text-xs uppercase tracking-widest text-action">
                    {{ $department->getTranslation('name', app()->getLocale()) }}
                </p>

                <h3 class="mt-2 text-lg font-bold text-gray-900">
                    {{ $department->leader?->name ?? (localized('Not assigned', 'Haijaainishwa')) }}
                </h3>

                @if ($department->leader)

                    <p class="mt-2 text-sm text-gray-600">
                        {{ $department->leader->getTranslation('position', app()->getLocale()) }}
                    </p>

                @endif

            </div>

        @endforeach

    </div>

</section>


{{-- =========================
     UNIT HEADS
========================== --}}

<section class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-action mb-2">
                {{ localized('Units', 'Vitengo') }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ localized('Unit Heads', 'Wakuu wa Vitengo') }}
            </h2>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach ($units as $unit)

                <div class="bg-white border border-gray-100 p-6">

                    @if ($unit->leader?->photo)

                        <img
                            src="{{ asset('storage/' . $unit->leader->photo) }}"
                            alt="{{ $unit->leader->name }}"
                            class="w-20 h-20 object-cover rounded-full border-4 border-white shadow-sm"
                        >

                    @else

                        <div class="w-20 h-20 rounded-full bg-action/10 flex items-center justify-center text-action text-xl font-bold">
                            {{ $unit->leader
                                ? collect(explode(' ', $unit->leader->name))
                                    ->filter()
                                    ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                    ->take(2)
                                    ->implode('')
                                : '?' }}
                        </div>

                    @endif


                    <p class="mt-5 text-xs uppercase tracking-widest text-action">
                        {{ $unit->getTranslation('name', app()->getLocale()) }}
                    </p>

                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        {{ $unit->leader?->name ?? (localized('Not assigned', 'Haijaainishwa')) }}
                    </h3>

                    @if ($unit->leader)

                        <p class="mt-2 text-sm text-gray-600">
                            {{ $unit->leader->getTranslation('position', app()->getLocale()) }}
                        </p>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection
