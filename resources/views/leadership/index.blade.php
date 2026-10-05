@extends('layouts.app')

@section('title', $isSwahili ? 'Uongozi' : 'Leadership')

@section('content')

{{-- =========================
     HERO
========================== --}}

<section class="bg-tuico-navy text-white">

    <div class="max-w-7xl mx-auto px-6 py-12">

        <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
            {{ $isSwahili ? 'Uongozi' : 'Leadership' }}
        </p>

        <h1 class="text-4xl md:text-5xl font-bold">
            {{ $isSwahili ? 'Uongozi wa TUICO' : 'TUICO Leadership' }}
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
            {{ $isSwahili
                ? 'Kutana na viongozi wanaosimamia uongozi wa kitaifa na shughuli za kisekta, kiidara na vitengo vya TUICO.'
                : 'Meet the leaders responsible for the national leadership and the sectoral, departmental, and unit-level functions of TUICO.' }}
        </p>

    </div>

</section>


{{-- =========================
     NATIONAL LEADERSHIP
========================== --}}

<section class="max-w-7xl mx-auto px-6 py-8">

    <div class="mb-6">

        <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
            {{ $isSwahili ? 'Uongozi Taifa' : 'National Leadership' }}
        </p>

        <h2 class="text-3xl font-bold text-gray-900">
            {{ $isSwahili ? 'Viongozi Wakuu wa TUICO' : 'National Leaders of TUICO' }}
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

                        <div class="w-24 h-24 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 text-2xl font-bold flex-shrink-0">
                            {{ collect(explode(' ', $executive->name))
                                ->filter()
                                ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                ->take(2)
                                ->implode('') }}
                        </div>

                    @endif


                    <div>

                        <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
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

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ $isSwahili ? 'Sekta' : 'Sectors' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ $isSwahili ? 'Wakuu wa Sekta' : 'Sector Heads' }}
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

                        <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 text-xl font-bold">
                            {{ $sector->leader
                                ? collect(explode(' ', $sector->leader->name))
                                    ->filter()
                                    ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                    ->take(2)
                                    ->implode('')
                                : '?' }}
                        </div>

                    @endif


                    <p class="mt-5 text-xs uppercase tracking-widest text-blue-700">
                        {{ $sector->getTranslation('name', app()->getLocale()) }}
                    </p>

                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        {{ $sector->leader?->name ?? ($isSwahili ? 'Haijaainishwa' : 'Not assigned') }}
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

        <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
            {{ $isSwahili ? 'Idara' : 'Departments' }}
        </p>

        <h2 class="text-3xl font-bold text-gray-900">
            {{ $isSwahili ? 'Wakuu wa Idara' : 'Department Heads' }}
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

                    <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 text-xl font-bold">
                        {{ $department->leader
                            ? collect(explode(' ', $department->leader->name))
                                ->filter()
                                ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                ->take(2)
                                ->implode('')
                            : '?' }}
                    </div>

                @endif


                <p class="mt-5 text-xs uppercase tracking-widest text-blue-700">
                    {{ $department->getTranslation('name', app()->getLocale()) }}
                </p>

                <h3 class="mt-2 text-lg font-bold text-gray-900">
                    {{ $department->leader?->name ?? ($isSwahili ? 'Haijaainishwa' : 'Not assigned') }}
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

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ $isSwahili ? 'Vitengo' : 'Units' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ $isSwahili ? 'Wakuu wa Vitengo' : 'Unit Heads' }}
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

                        <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 text-xl font-bold">
                            {{ $unit->leader
                                ? collect(explode(' ', $unit->leader->name))
                                    ->filter()
                                    ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                    ->take(2)
                                    ->implode('')
                                : '?' }}
                        </div>

                    @endif


                    <p class="mt-5 text-xs uppercase tracking-widest text-blue-700">
                        {{ $unit->getTranslation('name', app()->getLocale()) }}
                    </p>

                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        {{ $unit->leader?->name ?? ($isSwahili ? 'Haijaainishwa' : 'Not assigned') }}
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
