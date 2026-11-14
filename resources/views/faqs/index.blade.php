@extends('layouts.app')

@php
$locale = app()->getLocale();
@endphp

@section('title', localized('Frequently Asked Questions', 'Maswali Yanayoulizwa Mara kwa Mara'))

@section('content')

{{-- HERO --}}

<x-page-hero :eyebrow="localized('Inquiries', 'Mawasiliano')" :title="localized('Frequently Asked Questions', 'Maswali Yanayoulizwa Mara kwa Mara')" :intro="localized('Find answers to some of the questions commonly asked about TUICO and its services.', 'Pata majibu ya baadhi ya maswali yanayoulizwa mara kwa mara kuhusu TUICO na huduma zake.')" />

{{-- FAQ CONTENT --}}

<section class="bg-gray-50">

<div class="max-w-4xl mx-auto px-6 py-8">

    <div class="space-y-3">

        @forelse ($categories as $category)

            {{-- CATEGORY --}}

            <div
                x-data="{ open: false }"
                class="bg-white rounded-lg border border-gray-100 overflow-hidden"
            >

                <button
                    type="button"
                    @click="open = !open"
                    class="flex items-center justify-between w-full gap-6 px-6 py-5 md:px-7 text-left hover:bg-gray-50 transition"
                >

                    <span class="text-lg font-bold text-gray-900">
                        {{ $category->name }}
                    </span>

                    <span
                        class="flex-shrink-0 text-xl text-action transition-transform duration-200"
                        :class="{ 'rotate-45': open }"
                    >
                        +
                    </span>

                </button>

                {{-- QUESTIONS --}}

                <div
                    x-show="open"
                    x-collapse
                    class="border-t border-gray-100 px-6 md:px-7"
                >

                    @foreach ($category->faqs as $faq)

                        @php
                            $answer = $faq->answer;

                            $links = $faq->links->filter(function ($link) use ($locale) {
                                return filled($link->url)
                                    && filled($link->getTranslation('label', $locale));
                            });
                        @endphp

                        <div
                            x-data="{ questionOpen: false }"
                            class="border-b border-gray-100 last:border-b-0"
                        >

                            <button
                                type="button"
                                @click="questionOpen = !questionOpen"
                                class="flex items-center justify-between w-full gap-6 py-5 text-left hover:text-main transition"
                            >

                                <span class="font-semibold text-gray-800">
                                    {{ $faq->question }}
                                </span>

                                <span
                                    class="flex-shrink-0 text-lg text-action transition-transform duration-200"
                                    :class="{ 'rotate-45': questionOpen }"
                                >
                                    +
                                </span>

                            </button>

                            {{-- ANSWER --}}

                            <div
                                x-show="questionOpen"
                                x-collapse
                                class="pb-5 pr-8 text-gray-600 leading-7"
                            >

                                <p>
                                    {{ $answer }}
                                </p>

                                {{-- DATABASE-DRIVEN RELATED LINKS --}}

                                @if ($links->isNotEmpty())

                                    <div class="mt-3 flex flex-wrap gap-x-4 gap-y-2">

                                        @foreach ($links as $link)

                                            <a
                                                href="{{ $link->url }}"
                                                class="inline-flex items-center font-semibold text-main underline underline-offset-4 hover:text-action transition"
                                            >
                                                {{ $link->getTranslation('label', $locale) }}

                                                <span class="ml-1" aria-hidden="true">↗</span>
                                            </a>

                                        @endforeach

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @empty

            <div class="bg-white rounded-lg border border-gray-100 p-8 text-center">

                <p class="text-gray-500">
                    {{ localized('No frequently asked questions are currently available.', 'Hakuna maswali yanayopatikana kwa sasa.') }}
                </p>

            </div>

        @endforelse

    </div>

</div>

</section>

@endsection
