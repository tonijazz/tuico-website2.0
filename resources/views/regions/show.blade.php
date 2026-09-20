@extends('layouts.app')

@section('title', $region->name)

@section('content')
    <div class="max-w-3xl mx-auto p-8">
        <div class="border rounded-lg p-4 mb-4 shadow-sm">
            <h4 class="text-lg font-semibold">{{ $region->name }}</h4>

            @if ($region->chairperson)
                <p class="text-sm text-gray-400">Chairperson: {{ $region->chairperson->name }}</p>
            @endif

            @if ($region->secretary)
                <p class="text-sm text-gray-400">Secretary: {{ $region->secretary->name }}</p>
            @endif

            <p class="text-sm text-gray-400">Address: {{ $region->address }}</p>
            <p class="text-sm text-gray-400">Phone: {{ $region->phone }}</p>
            <p class="text-sm text-gray-400">Email: {{ $region->email }}</p>
        </div>

        @if ($region->subOffices->isNotEmpty())
            <h3 class="text-md font-semibold mt-4 mb-2">Sub-Offices</h3>
            @foreach ($region->subOffices as $subOffice)
                <div class="border rounded-lg p-4 mb-2">
                    <p class="font-semibold">{{ $subOffice->name }}</p>
                    @if ($subOffice->secretary)
                        <p class="text-sm text-gray-400">Secretary: {{ $subOffice->secretary->name }}</p>
                    @endif
                    <p class="text-sm text-gray-400">Address: {{ $subOffice->address }}</p>
                    <p class="text-sm text-gray-400">Phone: {{ $subOffice->phone }}</p>
                    <p class="text-sm text-gray-400">Email: {{ $subOffice->email }}</p>
                </div>
            @endforeach
        @endif
    </div>
@endsection
