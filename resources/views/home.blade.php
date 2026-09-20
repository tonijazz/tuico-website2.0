@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div x-data="{ current: 0, total: {{ $slides->count() }} }"
     x-init="setInterval(() => { current = (current + 1) % total }, 5000)"
     class="relative h-96 overflow-hidden">

    @foreach ($slides as $index => $slide)
        <div x-show="current === {{ $index }}"
             class="absolute inset-0 bg-cover bg-center flex items-center justify-center text-white"
             style="background-image: url('{{ asset('storage/' . $slide->image) }}')">
            <div class="bg-black/40 p-8 text-center">
                <h2 class="text-3xl font-bold">{{ $slide->title }}</h2>
                @if ($slide->subtitle)
                    <p class="mt-2">{{ $slide->subtitle }}</p>
                @endif
                @if ($slide->cta_label && $slide->cta_url)
                    <a href="{{ $slide->cta_url }}" class="mt-4 inline-block bg-amber-500 px-4 py-2 rounded">
                        {{ $slide->cta_label }}
                    </a>
                @endif
            </div>
        </div>
    @endforeach


</div>
<div class="max-w-5xl mx-auto p-8">
    <h2 class="text-2xl font-bold mb-4">Latest News</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($featuredNews as $article)
            <div class="border rounded-lg p-4 shadow-sm">
                <a href="{{ route('news.show', $article->slug) }}" class="text-lg font-semibold hover:underline">
                    {{ $article->title }}
                </a>
                <p class="text-gray-600 mt-2">{{ $article->excerpt }}</p>
                <p class="text-sm text-gray-400 mt-2">{{ $article->published_at->format('F j, Y') }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
