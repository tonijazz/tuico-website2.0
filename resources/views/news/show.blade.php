@extends('layouts.app')

@section('title', $article->title)
@section('meta_description', $article->excerpt)
@section('content')
    <div class="border rounded-lg p-4 mb-4 shadow-sm">
        <h4 class="text-lg font-semibold hover:underline">{{ $article->title }}</h4>
        <p class="text-sm text-gray-400">Published on {{ $article->published_at->format('F j, Y') }}</p>
        <div class="text-gray-600">{!! $article->body !!}</div>

    </div>


@endsection
