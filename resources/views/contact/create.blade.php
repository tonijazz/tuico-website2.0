@extends('layouts.app')

@php
    $isSwahili = app()->getLocale() === 'sw';
@endphp

@section('title', $isSwahili ? 'Wasiliana Nasi' : 'Send an Inquiry')

@section('content')

    {{-- HERO --}}

    <section class="bg-tuico-navy text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="max-w-3xl">

                <p class="text-sm uppercase tracking-widest text-blue-200 mb-2">
                    {{ $isSwahili ? 'Mawasiliano' : 'Inquiries' }}
                </p>

                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    {{ $isSwahili ? 'Wasiliana Nasi' : 'Send an Inquiry' }}
                </h1>

                <p class="mt-5 max-w-2xl text-lg leading-8 text-blue-100">
                    {{ $isSwahili
                        ? 'Tuma ujumbe wako kwa TUICO na timu yetu itakujibu kwa wakati unaofaa.'
                        : 'Send your inquiry to TUICO and our team will respond as soon as possible.' }}
                </p>

            </div>

        </div>

    </section>

    {{-- FORM --}}

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
                        {{ $isSwahili ? 'Tuma Ujumbe' : 'Get in Touch' }}
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-gray-900">
                        {{ $isSwahili ? 'Tunawezaje kukusaidia?' : 'How can we help you?' }}
                    </h2>

                </div>


                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">

                    @csrf
                    <x-honeypot />

                    {{-- NAME --}}
                    <div>

                        <label for="name" class="block text-sm font-semibold text-gray-700">
                            {{ $isSwahili ? 'Jina' : 'Name' }}
                        </label>

                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700">

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

                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700">

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label for="phone" class="block text-sm font-semibold text-gray-700">
                                {{ $isSwahili ? 'Simu' : 'Phone' }}
                            </label>

                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700">

                        </div>

                    </div>


                    {{-- SUBJECT --}}
                    <div>

                        <label for="subject" class="block text-sm font-semibold text-gray-700">
                            {{ $isSwahili ? 'Mada' : 'Subject' }}
                        </label>

                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                            class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700">

                    </div>


                    {{-- MESSAGE --}}
                    <div>

                        <label for="message" class="block text-sm font-semibold text-gray-700">
                            {{ $isSwahili ? 'Ujumbe' : 'Message' }}
                        </label>

                        <textarea name="message" id="message" rows="7" required
                            class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-blue-700 focus:ring-blue-700">{{ old('message') }}</textarea>

                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- SUBMIT --}}
                    <div class="pt-2">

                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-tuico-navy px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-tuico-navy">
                            {{ $isSwahili ? 'Tuma Ujumbe' : 'Send Message' }}

                            <span class="ml-2">→</span>
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

@endsection
