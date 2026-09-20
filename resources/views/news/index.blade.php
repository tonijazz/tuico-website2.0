@extends('layouts.app')

@section('content')
    @foreach ($articles as $article)
        <div class="border rounded-lg p-4 mb-4 shadow-sm">
            <a href="{{ route('news.show', $article->slug) }}" class="text-lg font-semibold hover:underline">
                {{ $article->title }}
            </a>
            <p class="text-gray-600">{{ $article->excerpt }}</p>
            <p class="text-sm text-gray-400">Published on {{ $article->published_at->format('F j, Y') }}</p>
        </div>
    @endforeach

    <div class="flex justify-center">
        {{ $articles->links() }}
    </div>
@endsection
