@extends('layouts.app')

@section('title', $page->seo_title ?? $page->title)

@section('content')

{{-- HERO --}}

<x-page-hero :eyebrow="localized('Legal Information', 'Taarifa ya Kisheria')" :title="$page->title" />

{{-- CONTENT --}}

<section class="bg-gray-50">

<div class="max-w-4xl mx-auto px-6 py-8">

    <div class="bg-white rounded-lg border border-gray-100 p-7 md:p-10">

        @foreach ($page->blocks as $block)

            @if ($block['type'] === 'heading')

                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4 first:mt-0">
                    {{ $block['content'] }}
                </h2>

            @elseif ($block['type'] === 'paragraph')

                <p class="text-gray-600 leading-8 mb-5">
                    {{ $block['content'] }}
                </p>

            @elseif ($block['type'] === 'bulleted_list')

                <ul class="list-disc list-inside mb-5 space-y-2 text-gray-600 leading-7">

                    @foreach ($block['items'] as $item)

                        <li>
                            {{ $item }}
                        </li>

                    @endforeach

                </ul>

            @endif

        @endforeach

    </div>

</div>

</section>

@endsection
