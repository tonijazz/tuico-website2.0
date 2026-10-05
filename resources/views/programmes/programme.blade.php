@extends('layouts.app')

@php
$isSwahili = app()->getLocale() === 'sw';
@endphp

@section('title', $programme->title)

@section('content')

{{-- HERO --}}

<section class="bg-tuico-navy text-white">

<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="max-w-4xl">

        <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
            {{ $isSwahili ? 'Programu' : 'Programme' }}
        </p>

        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            {{ $programme->title }}
        </h1>

    </div>

</div>


</section>

{{-- PROGRAMME DETAILS --}}

<section class="bg-gray-50">


<div class="max-w-5xl mx-auto px-6 py-8">

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

                <p class="text-sm uppercase tracking-widest text-blue-700">
                    {{ $isSwahili ? 'Maelezo ya Programu' : 'Programme Overview' }}
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
                        {{ $isSwahili ? 'Mshirika' : 'Affiliation' }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-tuico-navy">
                        {{ $programme->affiliation->name }}
                    </p>

                </div>

            @endif


            @if ($programme->starts_at)

                <div>

                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">
                        {{ $isSwahili ? 'Tarehe ya Kuanza' : 'Start Date' }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-tuico-navy">
                        {{ $programme->starts_at->format('d M Y') }}
                    </p>

                </div>

            @endif


            @if ($programme->ends_at)

                <div>

                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">
                        {{ $isSwahili ? 'Tarehe ya Kumalizika' : 'End Date' }}
                    </p>

                    <p class="mt-2 text-sm font-semibold text-tuico-navy">
                        {{ $programme->ends_at->format('d M Y') }}
                    </p>

                </div>

            @endif

        </div>


        {{-- OUTCOMES --}}
        @if ($programme->outcomes)

            <div class="mt-8 pt-8 border-t border-gray-100">

                <p class="text-sm uppercase tracking-widest text-blue-700">
                    {{ $isSwahili ? 'Matokeo Yanayotarajiwa' : 'Expected Outcomes' }}
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
