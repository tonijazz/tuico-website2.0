<div class="border-b py-2">
    <h3 class="text-lg font-semibold">{{ $programme->title }}</h3>
    <p>{{ $programme->description }}</p>
    <p><strong>Status:</strong> {{ $programme->status->getLabel() }}</p>
    @if ($programme->affiliation)
        <p><strong>Affiliation:</strong> {{ $programme->affiliation->name }}</p>
    @endif
    <p><strong>Starts:</strong> {{ $programme->starts_at?->format('F j, Y') }}</p>
    <p><strong>Ends:</strong> {{ $programme->ends_at?->format('F j, Y') }}</p>
</div>
