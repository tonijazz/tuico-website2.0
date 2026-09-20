@extends('layouts.app')

@section('title', 'Test Page')

@section('content')
<p class="mt-4">Site email: {{ $siteSettings->email }}</p>
    <div class="max-w-2xl mx-auto p-8 text-center">
        <h1 class="text-3xl font-bold text-amber-600">If this is styled, Tailwind works.</h1>
        <p class="mt-4 text-gray-600">This is a plain paragraph testing the base layout.</p>
        <p class="mt-4 font-semibold">Current locale: {{ app()->getLocale() }}</p>
    </div>
@endsection
