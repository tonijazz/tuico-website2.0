@extends('layouts.app')

@php
$isSwahili = app()->getLocale() === 'sw';

$currentSearch = request('search');
$currentCategory = request('category');
$currentYear = request('year');

@endphp

@section('title', $isSwahili ? 'Nyaraka' : 'Resources')

@section('content')

{{-- HERO --}}
<section class="bg-tuico-navy text-white">
    <div class="max-w-7xl mx-auto px-6 py-12">

        <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
            {{ $isSwahili ? 'Nyaraka na Taarifa' : 'Documents & Information' }}
        </p>

        <h1 class="text-4xl md:text-5xl font-bold">
            {{ $isSwahili ? 'Nyaraka' : 'Resources' }}
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
            {{ $isSwahili
                ? 'Pata nyaraka, machapisho, miongozo, sheria na taarifa mbalimbali zinazohusiana na kazi na shughuli za TUICO.'
                : 'Access TUICO documents, publications, guides, labour laws and other resources related to our work and activities.' }}
        </p>

    </div>
</section>


{{-- RESOURCE LIBRARY --}}
<section class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- FILTERS --}}
        <form
            method="GET"
            action="{{ $isSwahili ? '/sw/resources' : '/resources' }}"
            class="rounded-lg bg-white border border-gray-100 p-5 md:p-6 shadow-sm"
        >

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- SEARCH --}}
                <div class="lg:col-span-2">

                    <label
                        for="search"
                        class="block text-sm font-semibold text-gray-900 mb-2"
                    >
                        {{ $isSwahili ? 'Tafuta' : 'Search' }}
                    </label>

                    <input
                        id="search"
                        type="text"
                        name="search"
                        value="{{ $currentSearch }}"
                        placeholder="{{ $isSwahili ? 'Tafuta nyaraka...' : 'Search resources...' }}"
                        class="w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-700 focus:ring-blue-700"
                    >

                </div>


                {{-- CATEGORY --}}
                <div>

                    <label
                        for="category"
                        class="block text-sm font-semibold text-gray-900 mb-2"
                    >
                        {{ $isSwahili ? 'Kategoria' : 'Category' }}
                    </label>

                    <select
                        id="category"
                        name="category"
                        class="w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-700 focus:ring-blue-700"
                    >

                        <option value="">
                            {{ $isSwahili ? 'Kategoria Zote' : 'All Categories' }}
                        </option>

                        @foreach ($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected($currentCategory == $category->id)
                            >
                                {{ $category->getTranslation('name', app()->getLocale()) }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- YEAR --}}
                <div>

                    <label
                        for="year"
                        class="block text-sm font-semibold text-gray-900 mb-2"
                    >
                        {{ $isSwahili ? 'Mwaka' : 'Year' }}
                    </label>

                    <select
                        id="year"
                        name="year"
                        class="w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-700 focus:ring-blue-700"
                    >

                        <option value="">
                            {{ $isSwahili ? 'Miaka Yote' : 'All Years' }}
                        </option>

                        @foreach ($years as $year)

                            <option
                                value="{{ $year }}"
                                @selected($currentYear == $year)
                            >
                                {{ $year }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- FILTER ACTIONS --}}
            <div class="mt-5 flex flex-wrap items-center gap-4">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-full bg-tuico-navy px-6 py-3 text-sm font-semibold text-white hover:bg-tuico-navy transition"
                >
                    {{ $isSwahili ? 'Tafuta Nyaraka' : 'Search Resources' }}
                </button>

                @if ($currentSearch || $currentCategory || $currentYear)

                    <a
                        href="{{ $isSwahili ? '/sw/resources' : '/resources' }}"
                        class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-tuico-navy transition"
                    >
                        {{ $isSwahili ? 'Ondoa Vichujio' : 'Clear Filters' }}
                    </a>

                @endif

            </div>

        </form>


        {{-- RESULTS SUMMARY --}}
        <div class="mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isSwahili ? 'Maktaba ya Nyaraka' : 'Resource Library' }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ $resources->total() }}
                    {{ $isSwahili ? 'nyaraka zimepatikana' : 'resources found' }}
                </p>

            </div>

        </div>


        {{-- RESOURCE GRID --}}
        @if ($resources->count())

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($resources as $resource)

                    @php
                        $resourceTitle = $resource->getTranslation('title', app()->getLocale());
                        $resourceDescription = $resource->getTranslation('description', app()->getLocale());

                        $categoryName = $resource->category
                            ? $resource->category->getTranslation('name', app()->getLocale())
                            : null;
                    @endphp

                    <article
                        class="group flex flex-col rounded-lg bg-white border border-gray-100 p-6 hover:border-blue-200 hover:shadow-sm transition"
                    >

                        {{-- COVER IMAGE --}}
                        @if ($resource->cover_image)

                            <div class="mb-6 overflow-hidden rounded-lg bg-gray-50 aspect-[16/9]">

                                <img
                                    src="{{ asset('storage/' . $resource->cover_image) }}"
                                    alt="{{ $resourceTitle }}"
                                    class="w-full h-full object-cover"
                                >

                            </div>

                        @else

                            <div
                                class="mb-6 flex items-center justify-center rounded-lg bg-blue-50 aspect-[16/9]"
                            >
                                <svg
                                    class="w-12 h-12 text-blue-700"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M7 3h7l4 4v14H7V3z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M14 3v5h5"
                                    />
                                </svg>
                            </div>

                        @endif


                        {{-- CATEGORY --}}
                        @if ($categoryName)

                            <p class="text-xs font-semibold uppercase tracking-widest text-blue-700">
                                {{ $categoryName }}
                            </p>

                        @endif


                        {{-- PUBLICATION META --}}
                        @if ($resource->is_publication && ($resource->author || $resource->publish_year))

                            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-500">

                                @if ($resource->author)
                                    <span>{{ $resource->author }}</span>
                                @endif

                                @if ($resource->author && $resource->publish_year)
                                    <span class="text-gray-300">•</span>
                                @endif

                                @if ($resource->publish_year)
                                    <span>{{ $resource->publish_year }}</span>
                                @endif

                            </div>

                        @endif


                        {{-- TITLE --}}
                        <h3 class="mt-3 text-lg font-bold leading-snug text-gray-900">
                            {{ $resourceTitle }}
                        </h3>


                        {{-- DESCRIPTION --}}
                        @if ($resourceDescription)

                            <p class="mt-3 text-sm text-gray-600 leading-7 line-clamp-3">
                                {{ $resourceDescription }}
                            </p>

                        @endif


                        {{-- ACTIONS --}}
                        <div class="mt-auto pt-6 flex flex-wrap items-center gap-4">

                            <a
                                href="{{ $isSwahili ? '/sw/resources/' . $resource->id : '/resources/' . $resource->id }}"
                                class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-tuico-navy transition"
                            >
                                {{ $isSwahili ? 'Tazama Nyaraka' : 'View Resource' }}

                                <span class="ml-2">→</span>
                            </a>

                            @if ($resource->file_path)

                                <a
                                    href="{{ asset('storage/' . $resource->file_path) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-tuico-navy transition"
                                >
                                    {{ $isSwahili ? 'Pakua' : 'Download' }}

                                    <span class="ml-2">↗</span>
                                </a>

                            @endif

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            @if ($resources->hasPages())

                <div class="mt-10">
                    {{ $resources->links() }}
                </div>

            @endif

        @else

            {{-- NO RESULTS --}}
            <div class="mt-8 rounded-lg bg-white border border-gray-100 px-6 py-16 text-center shadow-sm">

                <div class="mx-auto w-16 h-16 rounded-lg bg-blue-50 flex items-center justify-center">

                    <svg
                        class="w-8 h-8 text-blue-700"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M7 3h7l4 4v14H7V3z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M14 3v5h5"
                        />
                    </svg>

                </div>

                <h2 class="mt-5 text-xl font-bold text-gray-900">
                    {{ $isSwahili ? 'Hakuna nyaraka zilizopatikana' : 'No resources found' }}
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    {{ $isSwahili
                        ? 'Jaribu kubadilisha utafutaji au vichujio ulivyotumia.'
                        : 'Try adjusting your search or filters.' }}
                </p>

                @if ($currentSearch || $currentCategory || $currentYear)

                    <a
                        href="{{ $isSwahili ? '/sw/resources' : '/resources' }}"
                        class="inline-flex items-center mt-6 text-sm font-semibold text-blue-700 hover:text-tuico-navy transition"
                    >
                        {{ $isSwahili ? 'Angalia Nyaraka Zote' : 'View All Resources' }}

                        <span class="ml-2">→</span>
                    </a>

                @endif

            </div>

        @endif

    </div>
</section>

@endsection
