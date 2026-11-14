@extends('layouts.app')

@php
    $isSwahili = app()->getLocale() === 'sw';
    $currentType = request('type');
@endphp

@section('title', localized('News', 'Habari'))

@section('content')

{{-- =========================================================
    HERO
========================================================== --}}
<section class="bg-main text-white">
    <div class="max-w-7xl mx-auto px-6 py-12">

        <p class="text-sm uppercase tracking-widest text-white/70 mb-2">
            {{ localized('News & Updates', 'Habari na Taarifa') }}
        </p>

        <h1 class="text-4xl md:text-5xl font-bold">
            {{ localized('TUICO News', 'Habari za TUICO') }}
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-white/80">
            {{ localized('Follow TUICO news, activities, announcements, developments and stories.', 'Fuatilia taarifa, shughuli, mafanikio na maendeleo ya TUICO.') }}
        </p>

    </div>
</section>


{{-- =========================================================
    NEWS ARCHIVE
========================================================== --}}
<section class="bg-gray-50">

    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- SECTION HEADER --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">

            <div>

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('Updates from TUICO', 'Taarifa kutoka TUICO') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('News & Articles', 'Habari na Makala') }}
                </h2>

            </div>

            <a
                href="{{ locale_url('news-events') }}"
                class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
            >
                ← {{ localized('News & Events', 'Habari na Matukio') }}
            </a>

        </div>


        {{-- FILTERS --}}
        <div class="mb-8 flex flex-wrap gap-2">

            <a
                href="{{ locale_url('news') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-bold uppercase tracking-wider border rounded-full transition
                    {{ !$currentType
                        ? 'bg-main border-main text-white'
                        : 'bg-white border-gray-200 text-gray-600 hover:border-action/30 hover:text-action' }}"
            >
                {{ localized('All', 'Zote') }}
            </a>

            @foreach ($newsTypes as $newsType)

                @php
                    $typeUrl = $isSwahili
                        ? '/sw/news?type=' . $newsType->value
                        : '/news?type=' . $newsType->value;

                    $isActive = $currentType === $newsType->value;

                    $typeLabel = match ($newsType->value) {
                        'update' => localized('Update', 'Taarifa'),
                        'press_release' => localized('Press Release', 'Taarifa kwa Vyombo vya Habari'),
                        'blog' => localized('Blog', 'Makala'),
                        default => $newsType->getLabel(),
                    };
                @endphp

                <a
                    href="{{ $typeUrl }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-bold uppercase tracking-wider border rounded-full transition
                        {{ $isActive
                            ? 'bg-main border-main text-white'
                            : 'bg-white border-gray-200 text-gray-600 hover:border-action/30 hover:text-action' }}"
                >
                    {{ $typeLabel }}
                </a>

            @endforeach

        </div>


        {{-- NEWS GRID --}}
        @if ($articles->count())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                @foreach ($articles as $article)

                    @php
                        $articleTypeLabel = match ($article->type?->value) {
                            'update' => localized('Update', 'Taarifa'),
                            'press_release' => localized('Press Release', 'Taarifa kwa Vyombo vya Habari'),
                            'blog' => localized('Blog', 'Makala'),
                            default => $article->type?->getLabel(),
                        };
                    @endphp

                    <article
                        class="group flex flex-col overflow-hidden bg-white rounded-lg border border-gray-100 hover:shadow-sm transition"
                    >

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


                        <div class="flex flex-1 flex-col p-6">

                            {{-- TYPE + DATE --}}
                            <div class="flex flex-wrap items-center gap-3">

                                @if ($article->type)

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-action bg-action/10 border border-action/20 rounded-full"
                                    >
                                        {{ $articleTypeLabel }}
                                    </span>

                                @endif

                                @if ($article->published_at)

                                    <span class="text-xs font-medium text-gray-500">
                                        {{ $article->published_at->format('d M Y') }}
                                    </span>

                                @endif

                            </div>


                            {{-- TITLE --}}
                            <h3 class="mt-4 text-xl font-bold leading-snug text-gray-900 group-hover:text-action transition">

                                <a
                                    href="{{ locale_url('news/' . $article->slug) }}"
                                >
                                    {{ $article->getTranslation('title', app()->getLocale()) }}
                                </a>

                            </h3>


                            {{-- EXCERPT --}}
                            @if ($article->excerpt)

                                <p class="mt-4 text-sm text-gray-600 leading-7">
                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($article->getTranslation('excerpt', app()->getLocale())),
                                        150
                                    ) }}
                                </p>

                            @endif


                            {{-- FOOTER --}}
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

                                    <span class="ml-2 transform group-hover:translate-x-1 transition">
                                        →
                                    </span>
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            @if ($articles->hasPages())

                <div class="mt-12 flex justify-center">
                    {{ $articles->links() }}
                </div>

            @endif

        @else

            {{-- EMPTY STATE --}}
            <div class="bg-white rounded-lg border border-gray-100 px-6 py-16 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-action/10 text-action">

                    <svg
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h7l2 2h5a2 2 0 012 2v10a2 2 0 01-2 2z"
                        />
                    </svg>

                </div>

                <p class="mt-5 text-gray-600">
                    {{ localized('No published news is currently available.', 'Hakuna habari zilizochapishwa kwa sasa.') }}
                </p>

            </div>

        @endif

    </div>

</section>

@endsection
