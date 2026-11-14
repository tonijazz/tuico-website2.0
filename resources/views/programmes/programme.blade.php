@extends('layouts.app')


@section('title', $programme->title)

@section('content')

{{-- HERO --}}

<x-page-hero :eyebrow="localized('Programme', 'Programu')" :title="$programme->title" />

{{-- PROGRAMME DETAILS --}}

<section class="bg-gray-50">


<div class="max-w-5xl mx-auto px-6 py-8">

    {{-- BACK LINK --}}
    <div class="mb-6">

        <a
            href="{{ locale_url('strategic-plan') }}"
            class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
        >
            ← {{ localized('Back to Strategic Plan', 'Rudi kwenye Mpango Mkakati') }}
        </a>

    </div>


    <div class="bg-white rounded-lg border border-gray-100 p-7 md:p-10">

        {{-- STATUS --}}
        @if ($programme->status)

            <div class="mb-8">

                <span
                    class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full
                        {{ $programme->status->value === 'active'
                            ? 'bg-green-100 text-green-800'
                            : 'bg-gray-100 text-gray-700' }}"
                >
                    {{ $programme->status->getLabel() }}
                </span>

            </div>

        @endif


        {{-- DESCRIPTION --}}
        @if ($programme->description)

            <div>

                <p class="text-sm uppercase tracking-widest text-action">
                    {{ localized('Programme Overview', 'Maelezo ya Programu') }}
                </p>

                <div class="mt-4 text-gray-600 leading-8">
                    {!! nl2br(e($programme->description)) !!}
                </div>

            </div>

        @endif


        {{-- INFORMATION --}}
        <div class="mt-8 pt-8 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-6">

            @if ($programme->affiliation)

                <div>

                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">
                        {{ localized('Affiliation', 'Mshirika') }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-main">
                        {{ $programme->affiliation->name }}
                    </p>

                </div>

            @endif


            @if ($programme->starts_at)

                <div>

                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">
                        {{ localized('Start Date', 'Tarehe ya Kuanza') }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-main">
                        {{ $programme->starts_at->format('d M Y') }}
                    </p>

                </div>

            @endif


            @if ($programme->ends_at)

                <div>

                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">
                        {{ localized('End Date', 'Tarehe ya Kumalizika') }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-main">
                        {{ $programme->ends_at->format('d M Y') }}
                    </p>

                </div>

            @endif

        </div>


        {{-- OUTCOMES --}}
        @if ($programme->outcomes)

            <div class="mt-8 pt-8 border-t border-gray-100">

                <p class="text-sm uppercase tracking-widest text-action">
                    {{ localized('Expected Outcomes', 'Matokeo Yanayotarajiwa') }}
                </p>

                <div class="mt-4 text-gray-600 leading-8">
                    {!! nl2br(e($programme->outcomes)) !!}
                </div>

            </div>

        @endif

    </div>

</div>


</section>

@endsection
