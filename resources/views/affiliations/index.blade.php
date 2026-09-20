@extends('layouts.app')

@section('title', 'Affiliations & Partners')

@section('content')
    <div class="max-w-5xl mx-auto p-8">

        <h2 class="text-2xl font-bold mb-4">National</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            @foreach ($national as $affiliation)
                <div class="border rounded-lg p-4 shadow-sm">
                    @if ($affiliation->logo)
                        <img src="{{ asset('storage/' . $affiliation->logo) }}" alt="{{ $affiliation->name }}" class="h-16 mb-2">
                    @endif
                    <p class="font-semibold">{{ $affiliation->name }}</p>
                    <span class="inline-block text-xs px-2 py-0.5 rounded-full mb-2
                        {{ $affiliation->type->value === 'partnership' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $affiliation->type->getLabel() }}
                    </span>
                    <p class="text-sm text-gray-600">{{ $affiliation->description }}</p>
                    @if ($affiliation->website_url)
                        <a href="{{ $affiliation->website_url }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                            Visit website
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold mb-4">International</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($international as $affiliation)
                <div class="border rounded-lg p-4 shadow-sm">
                    @if ($affiliation->logo)
                        <img src="{{ asset('storage/' . $affiliation->logo) }}" alt="{{ $affiliation->name }}" class="h-16 mb-2">
                    @endif
                    <p class="font-semibold">{{ $affiliation->name }}</p>
                    <span class="inline-block text-xs px-2 py-0.5 rounded-full mb-2
                        {{ $affiliation->type->value === 'partnership' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $affiliation->type->getLabel() }}
                    </span>
                    <p class="text-sm text-gray-600">{{ $affiliation->description }}</p>
                    @if ($affiliation->website_url)
                        <a href="{{ $affiliation->website_url }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                            Visit website
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
@endsection
