@extends('layouts.app')

@php
$isSwahili = app()->getLocale() === 'sw';

$title = $resource->getTranslation('title', app()->getLocale());
$description = $resource->getTranslation('description', app()->getLocale());

$categoryName = $resource->category
    ? $resource->category->getTranslation('name', app()->getLocale())
    : null;


@endphp

@section('title', $title)

@section('content')


{{-- HERO --}}
<section class="bg-main text-white">
    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="max-w-4xl">

            @if ($categoryName)

                <p class="text-sm uppercase tracking-widest text-white/70 mb-2">
                    {{ $categoryName }}
                </p>

            @endif

            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                {{ $title }}
            </h1>

            @if ($resource->is_publication && ($resource->author || $resource->publish_year))

                <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 text-white/80 text-sm">

                    @if ($resource->author)
                        <span>{{ $resource->author }}</span>
                    @endif

                    @if ($resource->author && $resource->publish_year)
                        <span class="text-white/60">•</span>
                    @endif

                    @if ($resource->publish_year)
                        <span>{{ $resource->publish_year }}</span>
                    @endif

                </div>

            @endif

        </div>

    </div>
</section>


{{-- RESOURCE CONTENT --}}
<section class="bg-white">
    <div class="max-w-5xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- COVER --}}
            <div class="lg:col-span-1">

                @if ($resource->cover_image)

                    <div class="overflow-hidden rounded-lg border border-gray-100 bg-gray-50">

                        <img
                            src="{{ asset('storage/' . $resource->cover_image) }}"
                            alt="{{ $title }}"
                            class="w-full h-auto object-contain"
                        >

                    </div>

                @else

                    <div class="aspect-[3/4] rounded-lg bg-action/10 border border-gray-100 flex items-center justify-center">

                        <svg
                            class="w-16 h-16 text-action"
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
                                d="M14 3v5h5M9 13h6M9 17h6"
                            />
                        </svg>

                    </div>

                @endif

            </div>


            {{-- INFORMATION --}}
            <div class="lg:col-span-2">

                @if ($categoryName)

                    <p class="text-sm uppercase tracking-widest text-action">
                        {{ $categoryName }}
                    </p>

                @endif

                <h2 class="mt-2 text-2xl md:text-3xl font-bold text-gray-900">
                    {{ $title }}
                </h2>


                {{-- PUBLICATION INFORMATION --}}
                @if ($resource->is_publication && ($resource->author || $resource->publish_year))

                    <div class="mt-6 flex flex-wrap gap-6 text-sm">

                        @if ($resource->author)

                            <div>

                                <p class="font-semibold text-gray-500">
                                    {{ localized('Author', 'Mwandishi') }}
                                </p>

                                <p class="mt-1 text-main">
                                    {{ $resource->author }}
                                </p>

                            </div>

                        @endif


                        @if ($resource->publish_year)

                            <div>

                                <p class="font-semibold text-gray-500">
                                    {{ localized('Year', 'Mwaka') }}
                                </p>

                                <p class="mt-1 text-main">
                                    {{ $resource->publish_year }}
                                </p>

                            </div>

                        @endif

                    </div>

                @endif


                {{-- DESCRIPTION --}}
                @if ($description)

                    <div class="mt-8">

                        <h3 class="text-lg font-bold text-gray-900">
                            {{ localized('About This Resource', 'Kuhusu Nyaraka Hizi') }}
                        </h3>

                        <div class="mt-4 text-gray-600 leading-8 whitespace-pre-line">
                            {{ $description }}
                        </div>

                    </div>

                @endif


                {{-- DOWNLOAD --}}
                @if ($resource->file_path)

                    <div class="mt-10">

                        <a
                            href="{{ asset('storage/' . $resource->file_path) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center justify-center rounded-full bg-action px-6 py-3 text-sm font-semibold text-white hover:bg-main transition"
                        >
                            {{ localized('Download Resource', 'Pakua Nyaraka') }}

                            <span class="ml-2">↗</span>
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>
</section>


{{-- BACK TO RESOURCES --}}
<section class="bg-gray-50 border-t border-gray-100">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <a
            href="{{ locale_url('resources') }}"
            class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
        >
            <span class="mr-2">←</span>

            {{ localized('Back to Resources', 'Rudi kwenye Nyaraka') }}
        </a>

    </div>

</section>


@endsection
