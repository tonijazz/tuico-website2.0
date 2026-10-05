@extends('layouts.app')

@section('title', $sector->getTranslation('name', app()->getLocale()))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-tuico-navy text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ $isSwahili ? 'Sekta' : 'Sector' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $sector->getTranslation('name', app()->getLocale()) }}
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
                    {{ $isSwahili ? 'Kuhusu Sekta' : 'About the Sector' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $sector->getTranslation('name', app()->getLocale()) }}
                </h2>

                <p class="mt-5 text-gray-600 leading-8">
                    {{ $sector->getTranslation('description', app()->getLocale()) }}
                </p>

            </div>


            {{-- SECTOR HEAD --}}
            @if ($sector->leader)

                <div>

                    <div class="border border-gray-100 bg-gray-50 p-6">

                        <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                            {{ $isSwahili ? 'Mkuu wa Sekta' : 'Sector Head' }}
                        </p>

                        <div class="mt-5">

                            @if ($sector->leader->photo)

                                <img
                                    src="{{ asset('storage/' . $sector->leader->photo) }}"
                                    alt="{{ $sector->leader->name }}"
                                    class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-sm"
                                >

                            @else

                                <div class="w-24 h-24 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 text-2xl font-bold">
                                    {{ collect(explode(' ', $sector->leader->name))
                                        ->filter()
                                        ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                        ->take(2)
                                        ->implode('') }}
                                </div>

                            @endif

                            <h3 class="mt-5 text-xl font-bold text-gray-900">
                                {{ $sector->leader->name }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-600">
                                {{ $sector->leader->getTranslation('position', app()->getLocale()) }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================
         EXPLORE OTHER SECTORS
    ========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-6">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                    {{ $isSwahili ? 'Sekta Nyingine' : 'Explore Other Sectors' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isSwahili
                        ? 'Gundua Sekta Nyingine za TUICO'
                        : 'Explore Other TUICO Sectors' }}
                </h2>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach (
                    \App\Models\OrgUnit::where('type', \App\Enums\OrgUnitType::Sector)
                        ->where('id', '!=', $sector->id)
                        ->orderBy('order')
                        ->get()
                    as $otherSector
                )

                    <a href="{{ $isSwahili
                        ? '/sw/sectors/' . \Illuminate\Support\Str::slug($otherSector->getTranslation('name', 'en'))
                        : '/sectors/' . \Illuminate\Support\Str::slug($otherSector->getTranslation('name', 'en')) }}"
                        class="group bg-white border border-gray-100 p-6 hover:border-blue-700 hover:shadow-sm transition">

                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-700 transition">
                            {{ $otherSector->getTranslation('name', app()->getLocale()) }}
                        </h3>

                        <p class="mt-3 text-sm text-gray-600 leading-6">
                            {{ \Illuminate\Support\Str::limit(
                                $otherSector->getTranslation('description', app()->getLocale()),
                                120
                            ) }}
                        </p>

                        <span class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700">
                            {{ $isSwahili ? 'Angalia Sekta' : 'View Sector' }}
                            <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                        </span>

                    </a>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =========================
         BACK TO SECTORS
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <a href="{{ $isSwahili ? '/sw/sectors' : '/sectors' }}"
            class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-950 transition">

            <span class="mr-2">←</span>

            {{ $isSwahili ? 'Rudi kwenye Sekta' : 'Back to Sectors' }}

        </a>

    </section>

@endsection
