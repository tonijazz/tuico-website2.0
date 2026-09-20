<div class="border-b py-3">
    @if ($event->banner_image)
        <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}"
            class="w-full h-48 object-cover rounded mb-2">
    @endif
    <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
    @if ($event->governanceMeeting)
        <p class="text-sm text-gray-400">Type: {{ $event->governanceMeeting->name }}</p>
    @endif
    <p class="text-gray-600">{{ $event->description }}</p>
    <p class="text-sm text-gray-400">Location: {{ $event->location }}</p>
    <p class="text-sm text-gray-400">
        {{ $event->starts_at->format('F j, Y') }}
        @if (!$event->starts_at->isSameDay($event->ends_at))
            – {{ $event->ends_at->format('F j, Y') }}
        @endif
    </p>

</div>
