@extends('layouts.app')

@php
$isSwahili = app()->getLocale() === 'sw';
@endphp

@section('title', $strategicArea->title)

@section('content')

{{-- HERO --}}

<section class="bg-tuico-navy text-white">

<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="max-w-4xl">

        @if ($strategicArea->icon)
            <div class="mb-5 text-blue-200">
                <x-dynamic-component
                    :component="$strategicArea->icon"
                    class="w-8 h-8"
                />
            </div>
        @endif

        <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
            {{ $isSwahili ? 'Eneo la Kimkakati' : 'Strategic Area' }}
        </p>

        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            {{ $strategicArea->title }}
        </h1>

    </div>

</div>

</section>

{{-- CONTENT --}}

<section class="bg-gray-50">

<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- BACK LINK --}}
    <div class="mb-6">

        <a
            href="{{ $isSwahili ? url('/sw/strategic-plan') : route('programmes.index') }}"
            class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-tuico-navy transition"
        >
            ← {{ $isSwahili ? 'Rudi kwenye Mpango Mkakati' : 'Back to Strategic Plan' }}
        </a>

    </div>


    <div class="bg-white rounded-lg border border-gray-100 p-7 md:p-10">

        @if ($strategicArea->description)

            <div>

                <p class="text-sm uppercase tracking-widest text-blue-700">
                    {{ $isSwahili ? 'Maelezo ya Eneo' : 'Strategic Area Overview' }}
                </p>

                <div class="mt-4 text-gray-600 leading-8">
                    {!! nl2br(e($strategicArea->description)) !!}
                </div>

            </div>

        @else

            <p class="text-gray-500">
                {{ $isSwahili
                    ? 'Hakuna maelezo ya eneo hili kwa sasa.'
                    : 'No description is currently available for this strategic area.' }}
            </p>

        @endif

    </div>

</div>

</section>

@endsection
