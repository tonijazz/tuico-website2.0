@extends('layouts.app')

@section('title', $unit->getTranslation('name', app()->getLocale()))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-tuico-navy text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ $isSwahili ? 'Kitengo' : 'Unit' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $unit->getTranslation('name', app()->getLocale()) }}
            </h1>

        </div>

    </section>


    {{-- =========================
         CONTENT
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- DESCRIPTION --}}
            <div class="lg:col-span-2">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ $isSwahili ? 'Kuhusu Kitengo' : 'About the Unit' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $unit->getTranslation('name', app()->getLocale()) }}
                </h2>

                <p class="mt-5 text-gray-600 leading-8">
                    {{ $unit->getTranslation('description', app()->getLocale()) }}
                </p>

            </div>


            {{-- UNIT HEAD --}}
            @if ($unit->leader)

                <div>

                    <div class="border border-gray-100 bg-gray-50 p-6">

                        <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                            {{ $isSwahili ? 'Mkuu wa Kitengo' : 'Unit Head' }}
                        </p>

                        <div class="mt-5">

                            @if ($unit->leader->photo)

                                <img
                                    src="{{ asset('storage/' . $unit->leader->photo) }}"
                                    alt="{{ $unit->leader->name }}"
                                    class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-sm"
                                >

                            @else

                                <div class="w-24 h-24 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 text-2xl font-bold">
                                    {{ collect(explode(' ', $unit->leader->name))
                                        ->filter()
                                        ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                        ->take(2)
                                        ->implode('') }}
                                </div>

                            @endif

                            <h3 class="mt-5 text-xl font-bold text-gray-900">
                                {{ $unit->leader->name }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-600">
                                {{ $unit->leader->getTranslation('position', app()->getLocale()) }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================
         EXPLORE OTHER UNITS
    ========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-6">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ $isSwahili ? 'Vitengo Vingine' : 'Explore Other Units' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isSwahili
                        ? 'Gundua Vitengo Vingine vya TUICO'
                        : 'Explore Other TUICO Units' }}
                </h2>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach (
                    \App\Models\OrgUnit::where('type', \App\Enums\OrgUnitType::Unit)
                        ->where('id', '!=', $unit->id)
                        ->orderBy('order')
                        ->get()
                    as $otherUnit
                )

                    <a href="{{ $isSwahili
                        ? '/sw/units/' . \Illuminate\Support\Str::slug($otherUnit->getTranslation('name', 'en'))
                        : '/units/' . \Illuminate\Support\Str::slug($otherUnit->getTranslation('name', 'en')) }}"
                        class="group bg-white border border-gray-100 p-6 hover:border-blue-700 hover:shadow-sm transition">

                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-700 transition">
                            {{ $otherUnit->getTranslation('name', app()->getLocale()) }}
                        </h3>

                        <p class="mt-3 text-sm text-gray-600 leading-6">
                            {{ \Illuminate\Support\Str::limit(
                                $otherUnit->getTranslation('description', app()->getLocale()),
                                120
                            ) }}
                        </p>

                        <span class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700">
                            {{ $isSwahili ? 'Angalia Kitengo' : 'View Unit' }}
                            <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                        </span>

                    </a>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =========================
         BACK TO UNITS
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <a href="{{ $isSwahili ? '/sw/units' : '/units' }}"
            class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-950 transition">

            <span class="mr-2">←</span>

            {{ $isSwahili ? 'Rudi kwenye Vitengo' : 'Back to Units' }}

        </a>

    </section>

@endsection
