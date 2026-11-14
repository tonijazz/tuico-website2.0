@extends('layouts.app')

@section('title', localized('Units', 'Vitengo'))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <x-page-hero :eyebrow="localized('Organization', 'Shirika')" :title="localized('Units', 'Vitengo')" :intro="localized('TUICO units that support specialised functions and strengthen the effective operation of the Union.', 'Vitengo vya TUICO vinavyosaidia utekelezaji wa shughuli maalum na kuimarisha uendeshaji wa Chama.')" />


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

                <a href="{{ locale_url('units/' . \Illuminate\Support\Str::slug($unit->getTranslation('name', 'en'))) }}"
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
