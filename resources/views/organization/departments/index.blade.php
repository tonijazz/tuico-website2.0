@extends('layouts.app')

@section('title', localized('Departments', 'Idara'))

@section('content')

    <x-page-hero :eyebrow="localized('Organization', 'Shirika')" :title="localized('Departments', 'Idara')" :intro="localized(
        'TUICO departments responsible for coordinating and supporting the Union’s administrative, professional, and strategic functions.',
        'Idara za TUICO zinazoratibu na kutekeleza majukumu mbalimbali ya kiutawala, kitaalamu na kimkakati ya Chama.',
    )" />

    <x-org-unit-grid type="department" :units="$departments" />

@endsection
