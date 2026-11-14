@extends('layouts.app')

@section('title', localized('Sectors', 'Sekta'))

@section('content')

    <x-page-hero :eyebrow="localized('TUICO Representation', 'Uwakilishi wa TUICO')" :title="localized('The Sectors We Represent', 'Sekta Tunazozihudumia')" :intro="localized(
        'TUICO represents workers across industrial, commercial, financial, services, and consultancy sectors.',
        'TUICO inahudumia wafanyakazi katika sekta nne (4): viwanda, biashara, taasisi za fedha, na huduma na ushauri.',
    )" />

    <section class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($sectors as $sector)
                    <a href="{{ locale_url('sectors/' . $sector->slug) }}"
                        class="group bg-white border border-gray-100 p-6 shadow-sm hover:border-action hover:shadow-md hover:-translate-y-1 transition duration-300">

                        {{-- ICON --}}
                        <div
                            class="flex h-11 w-11 items-center justify-center bg-action/10 text-action group-hover:bg-action group-hover:text-white transition">
                            <x-sector-icon :name="$sector->icon" />
                        </div>

                        {{-- NAME --}}
                        <h2 class="mt-6 text-xl font-bold text-main">
                            {{ $sector->getTranslation('name', app()->getLocale()) }}
                        </h2>

                        {{-- DESCRIPTION --}}
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($sector->getTranslation('description', app()->getLocale()), 150) }}
                        </p>

                        {{-- LINK --}}
                        <span class="mt-5 inline-flex items-center text-sm font-semibold text-action">
                            {{ localized('View Sector', 'Angalia Sekta') }}
                            <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                        </span>
                    </a>
                @endforeach
            </div>

        </div>
    </section>

@endsection
