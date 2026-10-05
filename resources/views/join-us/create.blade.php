@extends('layouts.app')

@php
$isSwahili = app()->getLocale() === 'sw';
@endphp

@section('title', $isSwahili ? 'Jiunge Nasi' : 'Join Us')

@section('content')

{{-- HERO --}}

<section class="bg-tuico-navy text-white">

<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="max-w-3xl">

        <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
            {{ $isSwahili ? 'Uanachama' : 'Membership' }}
        </p>

        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            {{ $isSwahili ? 'Jiunge Nasi' : 'Join Us' }}
        </h1>

        <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
            {{ $isSwahili
                ? 'Onyesha nia yako ya kujiunga na TUICO na timu yetu itawasiliana nawe kwa hatua zinazofuata.'
                : 'Register your interest in joining TUICO and our team will get in touch with you about the next steps.' }}
        </p>

    </div>

</div>

</section>

{{-- JOIN FORM --}}

<section class="bg-gray-50">

<div class="max-w-4xl mx-auto px-6 py-8">

    @if (session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-6 py-4 text-green-800">
            {{ session('success') }}
        </div>

    @endif


    <div class="bg-white rounded-lg border border-gray-100 p-7 md:p-10">

        <div class="mb-8">

            <p class="text-sm uppercase tracking-widest text-blue-700">
                {{ $isSwahili ? 'Fomu ya Kujiunga' : 'Membership Interest Form' }}
            </p>

            <h2 class="mt-2 text-2xl font-bold text-gray-900">
                {{ $isSwahili
                    ? 'Tupe taarifa zako'
                    : 'Tell us about yourself' }}
            </h2>

            <p class="mt-3 text-gray-600 leading-7">
                {{ $isSwahili
                    ? 'Jaza taarifa zilizo hapa chini ili TUICO iweze kukuelekeza kuhusu hatua za uanachama.'
                    : 'Complete the form below so TUICO can guide you through the membership process.' }}
            </p>

        </div>


        <form action="{{ route('join-us.store') }}" method="POST" class="space-y-6">

            @csrf


            {{-- NAME --}}
            <div>

                <label for="name" class="block text-sm font-semibold text-gray-700">
                    {{ $isSwahili ? 'Jina' : 'Name' }}
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700"
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>


            {{-- EMAIL + PHONE --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        {{ $isSwahili ? 'Barua Pepe' : 'Email' }}
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700"
                    >

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>


                <div>

                    <label for="phone" class="block text-sm font-semibold text-gray-700">
                        {{ $isSwahili ? 'Simu' : 'Phone' }}
                    </label>

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone') }}"
                        class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700"
                    >

                </div>

            </div>


            {{-- WORKPLACE --}}
            <div>

                <label for="workplace" class="block text-sm font-semibold text-gray-700">
                    {{ $isSwahili ? 'Mahali pa Kazi' : 'Workplace' }}
                </label>

                <input
                    type="text"
                    name="workplace"
                    id="workplace"
                    value="{{ old('workplace') }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700"
                >

            </div>


            {{-- OFFICE --}}
            <div>

                <label for="region_id" class="block text-sm font-semibold text-gray-700">
                    {{ $isSwahili ? 'Ofisi' : 'Office' }}
                </label>

                <select
                    name="region_id"
                    id="region_id"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700"
                >

                    <option value="">
                        {{ $isSwahili ? 'Chagua ofisi' : 'Select an office' }}
                    </option>

                    @foreach ($regions as $region)

                        <option
                            value="{{ $region->id }}"
                            {{ old('region_id') == $region->id ? 'selected' : '' }}
                        >
                            {{ $region->name }}
                        </option>

                    @endforeach

                </select>

                @error('region_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>


            {{-- MESSAGE --}}
            <div>

                <label for="message" class="block text-sm font-semibold text-gray-700">
                    {{ $isSwahili ? 'Ujumbe' : 'Message' }}
                </label>

                <textarea
                    name="message"
                    id="message"
                    rows="7"
                    required
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700"
                >{{ old('message') }}</textarea>

                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

            </div>


            {{-- SUBMIT --}}
            <div class="pt-2">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-tuico-navy px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-tuico-navy"
                >
                    {{ $isSwahili ? 'Tuma Ombi' : 'Submit Interest' }}

                    <span class="ml-2">→</span>
                </button>

            </div>

        </form>

    </div>

</div>

</section>

@endsection
