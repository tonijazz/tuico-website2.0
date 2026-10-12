@extends('layouts.app')

@php
$isSwahili = app()->getLocale() === 'sw';
$locale = app()->getLocale();
@endphp

@section('title', $isSwahili ? 'Maswali Yanayoulizwa Mara kwa Mara' : 'Frequently Asked Questions')

@section('content')

{{-- HERO --}}

<section class="bg-tuico-navy text-white">

<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="max-w-3xl">

        <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
            {{ $isSwahili ? 'Mawasiliano' : 'Inquiries' }}
        </p>

        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            {{ $isSwahili
                ? 'Maswali Yanayoulizwa Mara kwa Mara'
                : 'Frequently Asked Questions' }}
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
            {{ $isSwahili
                ? 'Pata majibu ya baadhi ya maswali yanayoulizwa mara kwa mara kuhusu TUICO na huduma zake.'
                : 'Find answers to some of the questions commonly asked about TUICO and its services.' }}
        </p>

    </div>

</div>

</section>

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
                        class="flex-shrink-0 text-xl text-blue-700 transition-transform duration-200"
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
                                class="flex items-center justify-between w-full gap-6 py-5 text-left hover:text-tuico-navy transition"
                            >

                                <span class="font-semibold text-gray-800">
                                    {{ $faq->question }}
                                </span>

                                <span
                                    class="flex-shrink-0 text-lg text-blue-700 transition-transform duration-200"
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
                                                class="inline-flex items-center font-semibold text-tuico-navy underline underline-offset-4 hover:text-blue-700 transition"
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
                    {{ $isSwahili
                        ? 'Hakuna maswali yanayopatikana kwa sasa.'
                        : 'No frequently asked questions are currently available.' }}
                </p>

            </div>

        @endforelse

    </div>

</div>

</section>

@endsection
