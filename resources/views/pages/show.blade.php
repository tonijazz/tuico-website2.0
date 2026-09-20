@extends('layouts.app')

@section('title', $page->seo_title ?? $page->title)

@section('content')
    <div class="max-w-3xl mx-auto p-8">

        @foreach ($page->blocks as $block)
            @if ($block['type'] === 'heading')
                <h2 class="text-2xl font-bold mt-8 mb-4">{{ $block['content'] }}</h2>
            @elseif ($block['type'] === 'paragraph')
                <p class="text-gray-700 leading-relaxed mb-4">{{ $block['content'] }}</p>
            @elseif ($block['type'] === 'bulleted_list')
                <ul class="list-disc list-inside mb-4 text-gray-700">
                    @foreach ($block['items'] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            @endif
        @endforeach

    </div>
@endsection
