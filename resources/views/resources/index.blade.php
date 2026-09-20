@extends('layouts.app')

@section('title', 'Resources')

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <h2 class="text-2xl font-bold mb-4">Resources</h2>

        @foreach ($categories as $category)
            <h3 class="text-lg font-semibold mt-6 mb-2">{{ $category->name }}</h3>
            @foreach ($category->resources as $resource)
                <div class="border-b py-2">
                    {{ $resource->title }}<br>
                    <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                        Download
                    </a><br>
                    @if ($resource->is_publication)
                        {{ $resource->publish_year }}<br>
                        {{ $resource->author }}
                    @endif
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
