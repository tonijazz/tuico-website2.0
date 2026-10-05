@extends('layouts.app')

@section('title', $isSwahili ? 'Vitengo' : 'Units')

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-tuico-navy text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                {{ $isSwahili ? 'Shirika' : 'Organization' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $isSwahili ? 'Vitengo' : 'Units' }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                {{ $isSwahili
                    ? 'Vitengo vya TUICO vinavyosaidia utekelezaji wa shughuli maalum na kuimarisha uendeshaji wa Chama.'
                    : 'TUICO units that support specialised functions and strengthen the effective operation of the Union.' }}
            </p>

        </div>

    </section>


    {{-- =========================
         UNITS
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ $isSwahili ? 'Vitengo vya TUICO' : 'TUICO Units' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ $isSwahili
                    ? 'Majukumu ya Vitengo'
                    : 'Units of the Union' }}
            </h2>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach ($units as $unit)

                <a href="{{ $isSwahili
                    ? '/sw/units/' . \Illuminate\Support\Str::slug($unit->getTranslation('name', 'en'))
                    : '/units/' . \Illuminate\Support\Str::slug($unit->getTranslation('name', 'en')) }}"
                    class="group border border-gray-100 bg-white p-6 hover:border-blue-700 hover:shadow-sm transition">

                    <div class="flex items-start justify-between gap-6">

                        <div>

                            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                                {{ $isSwahili ? 'Kitengo' : 'Unit' }}
                            </p>

                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition">
                                {{ $unit->getTranslation('name', app()->getLocale()) }}
                            </h3>

                        </div>

                        <span class="shrink-0 text-blue-700 text-xl group-hover:translate-x-1 transition">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-gray-600 leading-7">
                        {{ \Illuminate\Support\Str::limit(
                            $unit->getTranslation('description', app()->getLocale()),
                            220
                        ) }}
                    </p>

                    <span class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700">
                        {{ $isSwahili ? 'Angalia Kitengo' : 'View Unit' }}
                    </span>

                </a>

            @endforeach

        </div>

    </section>

@endsection
