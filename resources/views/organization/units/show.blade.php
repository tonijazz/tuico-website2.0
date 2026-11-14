@extends('layouts.app')

@section('title', $unit->getTranslation('name', app()->getLocale()))

@section('content')

    @php
        // The first action becomes the main button; the rest are outlined.
        $actions = [];

        if ($unit->order === 1) {
            // Mobilisation & Strengthening: joining is the main action
            $actions[] = [
                'label' => localized('Ask about joining TUICO', 'Uliza kuhusu kujiunga na TUICO'),
                'url' => locale_url('join-us'),
            ];
        }

        if ($unit->order === 2) {
            // Information & Public Relations: updates and publications
            $actions[] = [
                'label' => localized('News and Resources', 'Nyaraka na Machapisho'),
                'url' => locale_url('resources'),
            ];
        }

        $actions[] = [
            'label' => localized('Contact TUICO', 'Wasiliana na TUICO'),
            'url' => locale_url('contact'),
        ];
    @endphp

    <x-org-unit-detail type="unit" :unit="$unit" :actions="$actions" />

@endsection
