@extends('layouts.app')

@section('title', 'Leadership')

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <h2 class="text-2xl font-bold mb-4">Leadership</h2>

        <h3 class="text-xl font-semibold mb-4">National Executives</h3>
        @foreach ($nationalExecutives as $executive)
            <div class="border rounded-lg p-4">
                <h3 class="font-semibold">{{ $executive->name }}</h3>
                <p class="text-sm text-gray-600">{{ $executive->position }}</p>
            </div>
        @endforeach

        <h3 class="text-xl font-semibold mb-4 mt-6">Organizational Units</h3>
        @foreach ($orgUnits as $orgUnit)
            <div class="border-b py-2">
                <h3 class="text-lg font-semibold">{{ $orgUnit->name }}</h3>
                @if ($orgUnit->leader)
                    <p>{{ $orgUnit->leader->name }}</p>
                    <p>{{ $orgUnit->leader->position }}</p>
                @else
                    <p>No leader assigned</p>
                @endif
            </div>
        @endforeach
    </div>
@endsection
