@extends('layouts.app')

@section('title', 'Regions')

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Regions</h1>
        <ul>
            @foreach ($regions as $region)
                <li class="border-b py-3">
                    <a href="{{ route('regions.show', $region->slug) }}" class="text-lg font-semibold hover:underline">
                        {{ $region->name }}
                    </a>
                    <p class="text-sm text-gray-400">Address: {{ $region->address }}</p>
                    <p class="text-sm text-gray-400">Phone: {{ $region->phone }}</p>
                    <p class="text-sm text-gray-400">Email: {{ $region->email }}</p>
                    @if ($region->subOffices->isNotEmpty())
                        <p class="text-sm text-gray-500 mt-1">{{ $region->subOffices->count() }} sub-office(s)</p>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
