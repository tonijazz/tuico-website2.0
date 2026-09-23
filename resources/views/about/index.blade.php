@extends('layouts.app')

@section('title', $page?->title ?? (app()->getLocale() === 'sw' ? 'Kuhusu Sisi' : 'About Us'))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-blue-800 text-white">

        <div class="max-w-7xl mx-auto px-6 py-16">

            <p class="text-sm uppercase tracking-widest text-blue-200 mb-3">
                {{ app()->getLocale() === 'sw' ? 'Kuhusu Sisi' : 'About Us' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $page?->title ?? (app()->getLocale() === 'sw' ? 'Kuhusu TUICO' : 'About TUICO') }}
            </h1>

        </div>

    </section>


    {{-- =========================
         ABOUT CONTENT
    ========================== --}}

    <section id="who-we-are" class="max-w-7xl mx-auto px-6 py-16">

        <div class="max-w-4xl">

            @foreach ($page?->blocks ?? [] as $block)
                @if ($block['type'] === 'heading')
                    <h2 id="{{ $block['content'] === 'Background and History' || $block['content'] === 'Historia' ? 'history' : 'who-we-are' }}"
                        class="text-3xl font-bold text-gray-900 mt-10 mb-5 first:mt-0">
                        {{ $block['content'] }}
                    </h2>
                @elseif ($block['type'] === 'paragraph')
                    <p class="text-gray-600 leading-8 mb-8">
                        {{ $block['content'] }}
                    </p>
                @endif
            @endforeach

        </div>

    </section>
    {{-- =========================
         GOVERNANCE STRUCTURE
    ========================== --}}
    <section id="structure-meetings" class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-16">

            <div class="max-w-3xl mb-10">

                <p class="text-sm uppercase tracking-widest text-blue-700 mb-3">
                    {{ app()->getLocale() === 'sw' ? 'Muundo wa Chama' : 'Union Structure' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ app()->getLocale() === 'sw' ? 'Muundo na Mikutano' : 'Structure & Meetings' }}
                </h2>

            </div>


            @if ($governanceLevels->count())

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @foreach ($governanceLevels as $level)
                        <div class="bg-white border border-gray-100 rounded-lg p-6 shadow-sm">

                            <h3 class="text-xl font-semibold text-gray-900 mb-3">
                                {{ $level->name }}
                            </h3>

                            @if ($level->meetings->count())
                                <h4 class="font-semibold text-gray-900 mb-3">
                                    {{ app()->getLocale() === 'sw' ? 'Mikutano' : 'Meetings' }}
                                </h4>

                                <ul class="space-y-2">

                                    @foreach ($level->meetings as $meeting)
                                        <li class="text-sm text-gray-600">
                                            {{ $meeting->name }} — <span
                                                class="text-gray-400">{{ $meeting->frequency }}</span>
                                        </li>
                                    @endforeach

                                </ul>
                            @endif

                        </div>
                    @endforeach

                </div>
            @else
                <p class="text-gray-500">
                    {{ app()->getLocale() === 'sw'
                        ? 'Taarifa za muundo wa chama zitawekwa hapa.'
                        : 'Union structure information will be displayed here.' }}
                </p>

            @endif

        </div>

    </section>

@endsection
