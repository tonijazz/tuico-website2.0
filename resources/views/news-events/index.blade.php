@extends('layouts.app')


@section('title', localized('News & Events', 'Habari na Matukio'))

@section('content')

    {{-- HERO --}}

    <x-page-hero :eyebrow="localized('News & Events', 'Habari na Matukio')" :title="localized('TUICO News & Events', 'Habari na Matukio ya TUICO')" :intro="localized('Stay informed about TUICO news, updates, activities and upcoming events.', 'Fuatilia habari, taarifa, shughuli na matukio yanayohusiana na TUICO.')" />


    {{-- LATEST NEWS --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-6">

                <div>

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('Updates from TUICO', 'Taarifa kutoka TUICO') }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ localized('Latest News', 'Habari za Hivi Karibuni') }}
                    </h2>

                </div>

                <a
                    href="{{ locale_url('news') }}"
                    class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
                >
                    {{ localized('View All News', 'Angalia Habari Zote') }}

                    <span class="ml-2">
                        →
                    </span>
                </a>

            </div>


            @if ($latestNews->count())

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($latestNews as $article)

                        @php
                            $articleTypeLabel = match ($article->type?->value) {
                                'update' => localized('Update', 'Taarifa'),
                                'press_release' => localized('Press Release', 'Taarifa kwa Vyombo vya Habari'),
                                'blog' => localized('Blog', 'Makala'),
                                default => $article->type?->getLabel(),
                            };
                        @endphp

                        <article class="group flex flex-col overflow-hidden bg-white border border-gray-100 rounded-lg hover:shadow-sm transition">

                            {{-- IMAGE --}}

                            <a
                                href="{{ locale_url('news/' . $article->slug) }}"
                                class="block overflow-hidden"
                            >

                                @if ($article->featured_image)

                                    <div class="aspect-[16/10] overflow-hidden bg-gray-100">

                                        <img
                                            src="{{ asset('storage/' . $article->featured_image) }}"
                                            alt="{{ $article->getTranslation('title', app()->getLocale()) }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                        >

                                    </div>

                                @else

                                    <div class="aspect-[16/10] bg-main flex items-center justify-center">

                                        <div class="text-center">

                                            <div class="text-2xl font-bold text-white">
                                                TUICO
                                            </div>

                                            <div class="mt-1 text-xs uppercase tracking-widest text-white/70">
                                                {{ localized('News', 'Habari') }}
                                            </div>

                                        </div>

                                    </div>

                                @endif

                            </a>


                            {{-- CONTENT --}}

                            <div class="flex flex-1 flex-col p-6">

                                <div class="flex flex-wrap items-center gap-3">

                                    @if ($article->type)

                                        <span class="inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-action bg-action/10 border border-action/20 rounded-full">
                                            {{ $articleTypeLabel }}
                                        </span>

                                    @endif

                                    @if ($article->published_at)

                                        <span class="text-xs font-medium text-gray-500">
                                            {{ $article->published_at->format('d M Y') }}
                                        </span>

                                    @endif

                                </div>


                                <h3 class="mt-4 text-xl font-bold leading-snug text-gray-900 group-hover:text-action transition">

                                    <a href="{{ locale_url('news/' . $article->slug) }}">
                                        {{ $article->getTranslation('title', app()->getLocale()) }}
                                    </a>

                                </h3>


                                @if ($article->excerpt)

                                    <p class="mt-4 text-sm text-gray-600 leading-7">
                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($article->getTranslation('excerpt', app()->getLocale())),
                                            130
                                        ) }}
                                    </p>

                                @endif


                                <div class="mt-auto pt-6">

                                    @if ($article->author)

                                        <p class="mb-4 text-xs text-gray-500">

                                            {{ localized('By', 'Na') }}

                                            <span class="font-semibold text-gray-700">
                                                {{ $article->author->name }}
                                            </span>

                                        </p>

                                    @endif

                                    <a
                                        href="{{ locale_url('news/' . $article->slug) }}"
                                        class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
                                    >
                                        {{ localized('Read Story', 'Soma Habari') }}

                                        <span class="ml-2">
                                            →
                                        </span>
                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="bg-white border border-gray-100 rounded-lg px-6 py-12 text-center">

                    <p class="text-gray-600">
                        {{ localized('No published news is currently available.', 'Hakuna habari zilizochapishwa kwa sasa.') }}
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- UPCOMING EVENTS --}}

    <section class="bg-white">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-6">

                <div>

                    <p class="text-sm uppercase tracking-widest text-action mb-2">
                        {{ localized('What’s Coming Up', 'Ratiba zijazo') }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ localized('Upcoming Events', 'Matukio Yanayokuja') }}
                    </h2>

                </div>

                <a
                    href="{{ locale_url('events') }}"
                    class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
                >
                    {{ localized('View All Events', 'Angalia Matukio Yote') }}

                    <span class="ml-2">
                        →
                    </span>
                </a>

            </div>


            @if ($upcomingEvents->count())

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($upcomingEvents as $event)

                        <article class="group flex flex-col overflow-hidden bg-white border border-gray-100 rounded-lg hover:shadow-sm transition">

                            {{-- IMAGE --}}

                            @if ($event->banner_image)

                                <div class="aspect-[16/9] overflow-hidden bg-gray-100">

                                    <img
                                        src="{{ asset('storage/' . $event->banner_image) }}"
                                        alt="{{ $event->getTranslation('title', app()->getLocale()) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    >

                                </div>

                            @else

                                <div class="aspect-[16/9] bg-main flex items-center justify-center">

                                    <div class="text-center">

                                        <div class="text-2xl font-bold text-white">
                                            TUICO
                                        </div>

                                        <div class="mt-1 text-xs uppercase tracking-widest text-white/70">
                                            {{ localized('Event', 'Tukio') }}
                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- CONTENT --}}

                            <div class="flex flex-1 flex-col p-6">

                                <div class="flex items-center gap-4">

                                    <div class="flex h-14 w-14 shrink-0 flex-col items-center justify-center bg-action/10 text-action">

                                        <span class="text-lg font-bold leading-none">
                                            {{ $event->starts_at->format('d') }}
                                        </span>

                                        <span class="mt-1 text-[10px] font-bold uppercase tracking-wider">
                                            {{ $event->starts_at->format('M') }}
                                        </span>

                                    </div>

                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-wider text-action">
                                            {{ localized('Date', 'Tarehe') }}
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-gray-700">
                                            {{ $event->starts_at->format('d M Y') }}
                                        </p>

                                    </div>

                                </div>


                                @if ($event->governanceMeeting)

                                    <div class="mt-5">

                                        <span class="inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-action bg-action/10 border border-action/20 rounded-full">
                                            {{ localized('Statutory Meeting', 'Mkutano wa Kikatiba') }}
                                        </span>

                                    </div>

                                @endif


                                <h3 class="mt-4 text-xl font-bold leading-snug text-gray-900">
                                    {{ $event->getTranslation('title', app()->getLocale()) }}
                                </h3>


                                @if ($event->description)

                                    <p class="mt-4 text-sm text-gray-600 leading-7">

                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($event->getTranslation('description', app()->getLocale())),
                                            130
                                        ) }}

                                    </p>

                                @endif


                                @if ($event->location)

                                    <div class="mt-auto pt-6 flex items-start gap-2 text-sm text-gray-500">

                                        <svg
                                            class="h-5 w-5 shrink-0 text-action"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.7"
                                                d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"
                                            />
                                            <circle
                                                cx="12"
                                                cy="11"
                                                r="2.5"
                                                fill="currentColor"
                                            />
                                        </svg>

                                        <span>
                                            {{ $event->location }}
                                        </span>

                                    </div>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="bg-gray-50 border border-gray-100 rounded-lg px-6 py-12 text-center">

                    <p class="text-gray-600">
                        {{ localized('There are no upcoming events at the moment.', 'Hakuna matukio yajayo kwa sasa.') }}
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- CTA --}}

    <section class="bg-main text-white">

        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                <div class="max-w-2xl">

                    <p class="text-sm uppercase tracking-widest text-white/70 mb-2">
                        {{ localized('Stay Connected with TUICO', 'Endelea kufuatilia TUICO') }}
                    </p>

                    <h2 class="text-2xl md:text-3xl font-bold">
                        {{ localized('Keep up with the latest news and activities from TUICO.', 'Pata habari na taarifa za hivi karibuni kutoka TUICO.') }}
                    </h2>

                </div>

                <div class="flex flex-wrap gap-3">

                    <a
                        href="{{ locale_url('news') }}"
                        class="inline-flex items-center justify-center bg-white px-6 py-3 text-sm font-semibold text-main hover:bg-white/90 transition"
                    >
                        {{ localized('News', 'Habari') }}
                    </a>

                    <a
                        href="{{ locale_url('events') }}"
                        class="inline-flex items-center justify-center border border-white/40 px-6 py-3 text-sm font-semibold text-white hover:bg-white/10 transition"
                    >
                        {{ localized('Events', 'Matukio') }}
                    </a>

                </div>

            </div>

        </div>

    </section>

@endsection
