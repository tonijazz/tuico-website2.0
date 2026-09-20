@extends('layouts.app')

@section('title', 'Programmes')

@section('content')
<div class="max-w-3xl mx-auto p-8">
    <h2 class="text-2xl font-bold mb-4">Strategic Areas</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach ($strategicAreas as $area)
            <div class="border rounded-lg p-4">
                <h3 class="font-semibold">{{ $area->title }}</h3>
                <p class="text-sm text-gray-600">{{ $area->description }}</p>
            </div>
        @endforeach
    </div>

    <h2 class="text-2xl font-bold mb-4">Programmes</h2>
    <div x-data="{ tab: 'active' }">

        <div class="flex gap-4 mb-4">
            <button @click="tab = 'active'" :class="tab === 'active' ? 'font-bold border-b-2 border-amber-500' : 'text-gray-500'">
                Active Programmes
            </button>
            <button @click="tab = 'past'" :class="tab === 'past' ? 'font-bold border-b-2 border-amber-500' : 'text-gray-500'">
                Past Programmes
            </button>
        </div>

        <div x-show="tab === 'active'">
            @foreach ($activeProgrammes as $programme)
                @include('programmes._card', ['programme' => $programme])
            @endforeach
        </div>

        <div x-show="tab === 'past'">
            @foreach ($pastProgrammes as $programme)
                @include('programmes._card', ['programme' => $programme])
            @endforeach
        </div>

    </div>
</div>
@endsection
