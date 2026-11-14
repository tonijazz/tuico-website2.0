@extends('layouts.app')


@section('title', $strategicArea->title)

@section('content')

{{-- HERO --}}

<x-page-hero :icon="$strategicArea->icon" :eyebrow="localized('Strategic Area', 'Eneo la Kimkakati')" :title="$strategicArea->title" />

{{-- CONTENT --}}

<section class="bg-gray-50">

<div class="max-w-4xl mx-auto px-6 py-8">

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

        @if ($strategicArea->description)

            <div>

                <p class="text-sm uppercase tracking-widest text-action">
                    {{ localized('Strategic Area Overview', 'Maelezo ya Eneo') }}
                </p>

                <div class="mt-4 text-gray-600 leading-8">
                    {!! nl2br(e($strategicArea->description)) !!}
                </div>

            </div>

        @else

            <p class="text-gray-500">
                {{ localized('No description is currently available for this strategic area.', 'Hakuna maelezo ya eneo hili kwa sasa.') }}
            </p>

        @endif

    </div>

</div>

</section>

@endsection
