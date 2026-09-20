@extends('layouts.app')

@section('title', $zone->name)

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <div class="border rounded-lg p-4 mb-4 shadow-sm">
            <h4 class="text-lg font-semibold">{{ $zone->name }}</h4>

            @if ($zone->chairperson)
                <p class="text-sm text-gray-400">Chairperson: {{ $zone->chairperson->name }}</p>
            @endif
        </div>

        <h3 class="text-md font-semibold mt-4 mb-2">Member Regions</h3>
        <ul>
            @foreach ($zone->offices as $office)
                <li class="border-b py-2">
                    <a href="{{ route('regions.show', $office->slug) }}" class="hover:underline">
                        {{ $office->name }}
                    </a>
                    @if ($office->is_zonal_seat)
                        <span class="text-xs text-amber-600 font-semibold ml-2">(Zonal Seat)</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
