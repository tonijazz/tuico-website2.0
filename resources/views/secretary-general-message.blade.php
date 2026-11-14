@extends('layouts.app')

@section('title', localized('Message from the General Secretary', 'Ujumbe wa Katibu Mkuu'))

@section('content')

    
    {{-- =========================
         PAGE HERO
    ========================== --}}

    <x-page-hero :eyebrow="localized('TUICO Leadership', 'Uongozi wa TUICO')" :title="localized('Message from the General Secretary', 'Ujumbe wa Katibu Mkuu')" />


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
                                            {{ localized('General Secretary Photo', 'Picha ya Katibu Mkuu') }}
                                        </span>
                                    </div>
                                @endif

                            </div>

                            <div class="mt-6">

                                <h2 class="text-2xl font-bold text-main">
                                    {{ $selectedMessage->leader?->name }}
                                </h2>

                                <p class="mt-1 text-action font-medium">
                                    {{ localized('General Secretary', 'Katibu Mkuu') }}
                                </p>

                            </div>

                        </div>

                    </aside>


                    {{-- =========================
                         MAIN MESSAGE
                    ========================== --}}

                    <article class="lg:col-span-6">

                        <div class="max-w-3xl">

                            <h2 class="text-3xl md:text-4xl font-bold text-main leading-tight">
                                {{ $selectedMessage->getTranslation('title', app()->getLocale()) }}
                            </h2>

                            @if ($selectedMessage->published_at)
                                <p class="mt-3 text-sm text-gray-500">
                                    {{ $selectedMessage->published_at->format('d F Y') }}
                                </p>
                            @endif

                            <div class="mt-8 text-gray-700 leading-8 text-lg space-y-6">
                                {!! str($selectedMessage->getTranslation('content', app()->getLocale()))->sanitizeHtml() !!}
                            </div>

                            <div class="mt-10 pt-8 border-t border-gray-200">


                            </div>

                        </div>

                    </article>


                    {{-- =========================
                         OTHER MESSAGES
                    ========================== --}}

                    <aside class="lg:col-span-3">

                        <div class="lg:sticky lg:top-28">

                            <h3 class="text-sm font-semibold uppercase tracking-wider text-main">
                                {{ localized('Other Messages', 'Ujumbe Mwingine') }}
                            </h3>

                            <div class="mt-4 space-y-3">

                                @forelse ($otherMessages as $message)

                                    <a
                                        href="{{ request()->url() }}?message={{ $message->id }}"
                                        class="block p-4 rounded-lg border border-gray-200 hover:border-action hover:bg-action/10 transition"
                                    >

                                        <p class="font-semibold text-main leading-snug">
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
                                        {{ localized('No other published messages.', 'Hakuna ujumbe mwingine uliyochapishwa.') }}
                                    </p>

                                @endforelse

                            </div>

                        </div>

                    </aside>

                </div>

            @else

                <div class="py-16 text-center">
                    <p class="text-gray-500">
                        {{ localized('No published messages are currently available.', 'Hakuna ujumbe uliyochapishwa kwa sasa.') }}
                    </p>
                </div>

            @endif

        </div>
    </section>

@endsection
