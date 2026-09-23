@extends('layouts.app')

@section('title', app()->getLocale() === 'sw'
    ? 'Ujumbe wa Katibu Mkuu'
    : 'Message from the General Secretary')

@section('content')

    @php
        $isSwahili = app()->getLocale() === 'sw';
    @endphp

    {{-- =========================
         PAGE HERO
    ========================== --}}

    <section class="bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 md:py-20">

            <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">
                {{ $isSwahili ? 'Uongozi wa TUICO' : 'TUICO Leadership' }}
            </p>

            <h1 class="mt-3 text-4xl md:text-5xl font-bold">
                {{ $isSwahili
                    ? 'Ujumbe wa Katibu Mkuu'
                    : 'Message from the General Secretary' }}
            </h1>

        </div>
    </section>


    {{-- =========================
         MESSAGE CONTENT
    ========================== --}}

    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-6 py-16 md:py-20">

            @if ($selectedMessage)

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">

                    {{-- =========================
                         GENERAL SECRETARY
                    ========================== --}}

                    <aside class="lg:col-span-3">

                        <div class="lg:sticky lg:top-28">

                            <div class="aspect-[4/5] bg-gray-100 rounded-lg overflow-hidden">

                                @if ($selectedMessage->leader?->photo)
                                    <img
                                        src="{{ asset('storage/' . $selectedMessage->leader->photo) }}"
                                        alt="{{ $selectedMessage->leader->name }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="h-full flex items-center justify-center text-gray-400">
                                        <span class="text-sm">
                                            {{ $isSwahili
                                                ? 'Picha ya Katibu Mkuu'
                                                : 'General Secretary Photo' }}
                                        </span>
                                    </div>
                                @endif

                            </div>

                            <div class="mt-6">

                                <h2 class="text-2xl font-bold text-blue-950">
                                    {{ $selectedMessage->leader?->name }}
                                </h2>

                                <p class="mt-1 text-blue-700 font-medium">
                                    {{ $isSwahili
                                        ? 'Katibu Mkuu'
                                        : 'General Secretary' }}
                                </p>

                            </div>

                        </div>

                    </aside>


                    {{-- =========================
                         MAIN MESSAGE
                    ========================== --}}

                    <article class="lg:col-span-6">

                        <div class="max-w-3xl">

                            <h2 class="text-3xl md:text-4xl font-bold text-blue-950 leading-tight">
                                {{ $selectedMessage->getTranslation('title', app()->getLocale()) }}
                            </h2>

                            @if ($selectedMessage->published_at)
                                <p class="mt-3 text-sm text-gray-500">
                                    {{ $selectedMessage->published_at->format('d F Y') }}
                                </p>
                            @endif

                            <div class="mt-8 text-gray-700 leading-8 text-lg space-y-6">
                                {!! $selectedMessage->getTranslation('content', app()->getLocale()) !!}
                            </div>

                            <div class="mt-10 pt-8 border-t border-gray-200">

                                <p class="font-bold text-blue-950">
                                    {{ $selectedMessage->leader?->name }}
                                </p>

                                <p class="mt-1 text-gray-600">
                                    {{ $isSwahili
                                        ? 'Katibu Mkuu, Tanzania Union of Industrial and Commercial Workers (TUICO)'
                                        : 'General Secretary, Tanzania Union of Industrial and Commercial Workers (TUICO)' }}
                                </p>

                            </div>

                        </div>

                    </article>


                    {{-- =========================
                         OTHER MESSAGES
                    ========================== --}}

                    <aside class="lg:col-span-3">

                        <div class="lg:sticky lg:top-28">

                            <h3 class="text-sm font-semibold uppercase tracking-wider text-blue-950">
                                {{ $isSwahili
                                    ? 'Ujumbe Mwingine'
                                    : 'Other Messages' }}
                            </h3>

                            <div class="mt-4 space-y-3">

                                @forelse ($otherMessages as $message)

                                    <a
                                        href="{{ request()->url() }}?message={{ $message->id }}"
                                        class="block p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition"
                                    >

                                        <p class="font-semibold text-blue-950 leading-snug">
                                            {{ $message->getTranslation('title', app()->getLocale()) }}
                                        </p>

                                        @if ($message->published_at)
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $message->published_at->format('d F Y') }}
                                            </p>
                                        @endif

                                    </a>

                                @empty

                                    <p class="text-sm text-gray-500">
                                        {{ $isSwahili
                                            ? 'Hakuna ujumbe mwingine uliyochapishwa.'
                                            : 'No other published messages.' }}
                                    </p>

                                @endforelse

                            </div>

                        </div>

                    </aside>

                </div>

            @else

                <div class="py-16 text-center">
                    <p class="text-gray-500">
                        {{ $isSwahili
                            ? 'Hakuna ujumbe uliyochapishwa kwa sasa.'
                            : 'No published messages are currently available.' }}
                    </p>
                </div>

            @endif

        </div>
    </section>

@endsection
