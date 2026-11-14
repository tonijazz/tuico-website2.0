@extends('layouts.app')

@section('title', localized('Units', 'Vitengo'))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-main text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-white/70 mb-2">
                {{ localized('Organization', 'Shirika') }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ localized('Units', 'Vitengo') }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-white/80">
                {{ localized('TUICO units that support specialised functions and strengthen the effective operation of the Union.', 'Vitengo vya TUICO vinavyosaidia utekelezaji wa shughuli maalum na kuimarisha uendeshaji wa Chama.') }}
            </p>

        </div>

    </section>


    {{-- =========================
         UNITS
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-action mb-2">
                {{ localized('TUICO Units', 'Vitengo vya TUICO') }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ localized('Units of the Union', 'Majukumu ya Vitengo') }}
            </h2>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach ($units as $unit)

                <a href="{{ $isSwahili
                    ? '/sw/units/' . \Illuminate\Support\Str::slug($unit->getTranslation('name', 'en'))
                    : '/units/' . \Illuminate\Support\Str::slug($unit->getTranslation('name', 'en')) }}"
                    class="group border border-gray-100 bg-white p-6 hover:border-action hover:shadow-sm transition">

                    <div class="flex items-start justify-between gap-6">

                        <div>

                            <p class="text-sm uppercase tracking-widest text-action mb-2">
                                {{ localized('Unit', 'Kitengo') }}
                            </p>

                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-action transition">
                                {{ $unit->getTranslation('name', app()->getLocale()) }}
                            </h3>

                        </div>

                        <span class="shrink-0 text-action text-xl group-hover:translate-x-1 transition">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-gray-600 leading-7">
                        {{ \Illuminate\Support\Str::limit(
                            $unit->getTranslation('description', app()->getLocale()),
                            220
                        ) }}
                    </p>

                    <span class="inline-flex items-center mt-5 text-sm font-semibold text-action">
                        {{ localized('View Unit', 'Angalia Kitengo') }}
                    </span>

                </a>

            @endforeach

        </div>

    </section>

@endsection
