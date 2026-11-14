@extends('layouts.app')

@php
    
    $title = $article->getTranslation('title', app()->getLocale());
    $excerpt = $article->getTranslation('excerpt', app()->getLocale());
    $body = $article->getTranslation('body', app()->getLocale());

    $articleTypeLabel = match ($article->type?->value) {
        'update' => localized('Update', 'Taarifa'),
        'press_release' => localized('Press Release', 'Taarifa kwa Vyombo vya Habari'),
        'blog' => localized('Blog', 'Makala'),
        default => $article->type?->getLabel(),
    };
@endphp

@section('title', $title)
@section('meta_description', $excerpt)

@section('content')

{{-- =========================================================
    ARTICLE HERO
========================================================== --}}
<section class="bg-main text-white">

    <div class="max-w-5xl mx-auto px-6 py-12">

        <div class="flex flex-wrap items-center gap-3">

            @if ($article->type)

                <span
                    class="inline-flex items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider bg-white/10 border border-white/20 text-white/90 rounded-full"
                >
                    {{ $articleTypeLabel }}
                </span>

            @endif

            @if ($article->published_at)

                <span class="text-sm text-white/70">
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

            <p class="mt-5 max-w-3xl text-lg leading-8 text-white/80">
                {{ $excerpt }}
            </p>

        @endif


        {{-- AUTHOR --}}
        @if ($article->author)

            <div class="mt-6 flex items-center gap-3 text-sm text-white/70">

                <span class="h-px w-8 bg-white/40"></span>

                <span>
                    {{ localized('By', 'Na') }}

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
                prose-a:text-action
                prose-a:no-underline
                hover:prose-a:underline
                prose-strong:text-gray-900
                prose-blockquote:border-action
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
            href="{{ locale_url('news') }}"
            class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition"
        >

            <span class="mr-2">
                ←
            </span>

            {{ localized('Back to News', 'Rudi kwenye Habari') }}

        </a>

    </div>

</section>

@endsection
