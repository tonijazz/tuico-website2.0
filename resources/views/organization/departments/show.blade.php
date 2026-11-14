@extends('layouts.app')

@section('title', $department->getTranslation('name', app()->getLocale()))

@section('content')

    <x-org-unit-detail type="department" :unit="$department" :actions="[
        ['label' => localized('Find a regional office', 'Tafuta ofisi ya mkoa'), 'url' => locale_url('regions')],
        ['label' => localized('Contact TUICO', 'Wasiliana na TUICO'), 'url' => locale_url('contact')],
    ]" />

@endsection
