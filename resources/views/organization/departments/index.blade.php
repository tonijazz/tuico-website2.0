@extends('layouts.app')

@section('title', $isSwahili ? 'Idara' : 'Departments')

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
                {{ $isSwahili ? 'Idara' : 'Departments' }}
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                {{ $isSwahili
                    ? 'Idara za TUICO zinazoratibu na kutekeleza majukumu mbalimbali ya kiutawala, kitaalamu na kimkakati ya Chama.'
                    : 'TUICO departments responsible for coordinating and supporting the Union’s administrative, professional, and strategic functions.' }}
            </p>

        </div>

    </section>


    {{-- =========================
         DEPARTMENTS
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="mb-6">

            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                {{ $isSwahili ? 'Idara za TUICO' : 'TUICO Departments' }}
            </p>

            <h2 class="text-3xl font-bold text-gray-900">
                {{ $isSwahili ? 'Majukumu ya Idara' : 'Departments of the Union' }}
            </h2>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach ($departments as $department)

                <a href="{{ $isSwahili
                    ? '/sw/departments/' . \Illuminate\Support\Str::slug($department->getTranslation('name', 'en'))
                    : '/departments/' . \Illuminate\Support\Str::slug($department->getTranslation('name', 'en')) }}"
                    class="group border border-gray-100 bg-white p-6 hover:border-blue-700 hover:shadow-sm transition">

                    <div class="flex items-start justify-between gap-6">

                        <div>

                            <p class="text-sm uppercase tracking-widest text-blue-700 mb-2">
                                {{ $isSwahili ? 'Idara' : 'Department' }}
                            </p>

                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition">
                                {{ $department->getTranslation('name', app()->getLocale()) }}
                            </h3>

                        </div>

                        <span class="shrink-0 text-blue-700 text-xl group-hover:translate-x-1 transition">
                            →
                        </span>

                    </div>

                    <p class="mt-5 text-gray-600 leading-7">
                        {{ \Illuminate\Support\Str::limit(
                            $department->getTranslation('description', app()->getLocale()),
                            220
                        ) }}
                    </p>

                    <span class="inline-flex items-center mt-5 text-sm font-semibold text-blue-700">
                        {{ $isSwahili ? 'Angalia Idara' : 'View Department' }}
                    </span>

                </a>

            @endforeach

        </div>

    </section>

@endsection
