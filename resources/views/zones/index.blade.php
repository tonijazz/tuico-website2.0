@extends('layouts.app')

@section('title', 'Zones')

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Zones</h1>
        <ul>
            @foreach ($zones as $zone)
                <li class="border-b py-3">
                    <a href="{{ route('zones.show', $zone->slug) }}" class="text-lg font-semibold hover:underline">
                        {{ $zone->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
