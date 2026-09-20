@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="max-w-3xl mx-auto p-8">

    <h2 class="text-2xl font-bold mb-4">Events</h2>
    <div x-data="{ tab: 'active' }">

        <div class="flex gap-4 mb-4">
            <button @click="tab = 'active'" :class="tab === 'active' ? 'font-bold border-b-2 border-amber-500' : 'text-gray-500'">
                Upcoming Events
            </button>
            <button @click="tab = 'past'" :class="tab === 'past' ? 'font-bold border-b-2 border-amber-500' : 'text-gray-500'">
                Past Events
            </button>
        </div>

        <div x-show="tab === 'active'">
            @foreach ($upcoming as $event)
                @include('events._card', ['event' => $event])
            @endforeach
        </div>

        <div x-show="tab === 'past'">
            @foreach ($past as $event)
                @include('events._card', ['event' => $event])
            @endforeach
        </div>

    </div>
</div>
@endsection
