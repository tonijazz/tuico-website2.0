@extends('layouts.app')

@section('title', localized('Units', 'Vitengo'))

@section('content')

    <x-page-hero :eyebrow="localized('Organization', 'Shirika')" :title="localized('Units', 'Vitengo')" :intro="localized(
        'TUICO units that support specialised functions and strengthen the effective operation of the Union.',
        'Vitengo vya TUICO vinavyosaidia utekelezaji wa shughuli maalum na kuimarisha uendeshaji wa Chama.',
    )" />

    <x-org-unit-grid type="unit" :units="$units" />

@endsection
