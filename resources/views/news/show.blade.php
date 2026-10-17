@extends('layouts.app')

@php
    $isSwahili = app()->getLocale() === 'sw';

    $title = $article->getTranslation('title', app()->getLocale());
    $excerpt = $article->getTranslation('excerpt', app()->getLocale());
    $body = $article->getTranslation('body', app()->getLocale());

    $articleTypeLabel = match ($article->type?->value) {
        'update' => $isSwahili ? 'Taarifa' : 'Update',
        'press_release' => $isSwahili ? 'Taarifa kwa Vyombo vya Habari' : 'Press Release',
        'blog' => $isSwahili ? 'Makala' : 'Blog',
        default => $article->type?->getLabel(),
    };
@endphp

@section('title', $title)
@section('meta_description', $excerpt)

@section('content')

{{-- =========================================================
    ARTICLE HERO
========================================================== --}}
<section class="bg-tuico-navy text-white">

    <div class="max-w-5xl mx-auto px-6 py-12">

        <div class="flex flex-wrap items-center gap-3">

            @if ($article->type)

                <span
                    class="inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider bg-white/10 border border-white/20 text-blue-50 rounded-full"
                >
                    {{ $articleTypeLabel }}
                </span>

            @endif

            @if ($article->published_at)

                <span class="text-sm text-blue-200">
                    {{ $article->published_at->format('d M Y') }}
                </span>

            @endif

        </div>


        {{-- TITLE --}}
        <h1 class="mt-5 text-4xl md:text-5xl font-bold leading-tight">
            {{ $title }}
        </h1>


        {{-- EXCERPT --}}
        @if ($excerpt)

            <p class="mt-5 max-w-3xl text-lg leading-8 text-blue-100">
                {{ $excerpt }}
            </p>

        @endif


        {{-- AUTHOR --}}
        @if ($article->author)

            <div class="mt-6 flex items-center gap-3 text-sm text-blue-200">

                <span class="h-px w-8 bg-blue-400"></span>

                <span>
                    {{ $isSwahili ? 'Na' : 'By' }}

                    <span class="font-semibold text-white">
                        {{ $article->author->name }}
                    </span>
                </span>

            </div>

        @endif

    </div>

</section>


{{-- =========================================================
    ARTICLE CONTENT
========================================================== --}}
<section class="bg-gray-50">

    <div class="max-w-5xl mx-auto px-6 py-8">

        {{-- FEATURED IMAGE --}}
        @if ($article->featured_image)

            <div class="overflow-hidden bg-white rounded-lg border border-gray-100 mb-8">

                <img
                    src="{{ asset('storage/' . $article->featured_image) }}"
                    alt="{{ $title }}"
                    class="w-full max-h-[600px] object-cover"
                >

            </div>

        @endif


        {{-- ARTICLE BODY --}}
        <article
            class="max-w-3xl mx-auto bg-white rounded-lg border border-gray-100 px-6 py-8 md:px-10 md:py-10 prose prose-lg
                prose-headings:text-gray-900
                prose-headings:font-bold
                prose-p:text-gray-700
                prose-p:leading-8
                prose-a:text-blue-700
                prose-a:no-underline
                hover:prose-a:underline
                prose-strong:text-gray-900
                prose-blockquote:border-blue-700
                prose-blockquote:text-gray-600
                prose-img:rounded-lg"
        >
            {!! str($body)->sanitizeHtml() !!}
        </article>

    </div>

</section>


{{-- =========================================================
    BACK TO NEWS
========================================================== --}}
<section class="bg-white border-t border-gray-100">

    <div class="max-w-5xl mx-auto px-6 py-8">

        <a
            href="{{ $isSwahili ? '/sw/news' : '/news' }}"
            class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-tuico-navy transition"
        >

            <span class="mr-2">
                ←
            </span>

            {{ $isSwahili ? 'Rudi kwenye Habari' : 'Back to News' }}

        </a>

    </div>

</section>

@endsection
