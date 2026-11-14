@extends('layouts.app')

@section('title', $sector->getTranslation('name', app()->getLocale()))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-main text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-white/70 mb-2">
                {{ localized('Sector', 'Sekta') }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $sector->getTranslation('name', app()->getLocale()) }}
            </h1>

        </div>

    </section>


    {{-- =========================
         CONTENT
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- DESCRIPTION --}}
            {{-- DESCRIPTION --}}
            <div class="lg:col-span-2">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('About the Sector', 'Kuhusu Sekta') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $sector->getTranslation('name', app()->getLocale()) }}
                </h2>

                <p class="mt-5 text-gray-600 leading-8">
                    {{ $sector->getTranslation('description', app()->getLocale()) }}
                </p>

                {{-- EXAMPLES --}}
                @php
                    $examples = $sector->getTranslation('examples', app()->getLocale());
                @endphp

                @if (is_array($examples) && count($examples))

                    <h3 class="mt-8 text-xl font-bold text-gray-900">
                        {{ localized('Examples of workplaces', 'Mifano ya maeneo ya kazi') }}
                    </h3>

                    <ul class="mt-4 space-y-2 text-gray-600 leading-7">
                        @foreach ($examples as $example)
                            <li class="flex gap-3">
                                <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-action"></span>
                                <span>{{ $example }}</span>
                            </li>
                        @endforeach
                    </ul>

                @endif

                {{-- COVERAGE NOTE --}}
                <p class="mt-8 border-l-4 border-action/30 bg-action/10 px-4 py-3 text-sm leading-6 text-gray-700">
                    @if (is_sw())
                        Hii ni mifano. Kwa orodha kamili, soma
                        <a href="/sw/resources" class="font-semibold text-action underline">kanuni ya 13.2 ya Kanuni za
                            Katiba ya TUICO za mwaka 2021</a>.
                        Hujui eneo lako la kazi linaangukia sekta gani? Tuambie mahali unapofanya kazi kupitia fomu ya
                        maelezo ya uanachama.
                    @else
                        These are examples. See
                        <a href="/resources" class="font-semibold text-action underline">regulation 13.2 of the 2021 TUICO
                            Constitutional Regulations</a>
                        for the full list. Unsure where your workplace fits? Tell us where you work through the membership
                        enquiry form.
                    @endif
                </p>

                {{-- BUTTONS --}}
                <div class="mt-8 flex flex-wrap gap-3">

                    <a href="{{ locale_url('join-us') }}"
                        class="bg-action px-5 py-2.5 text-sm font-semibold text-white hover:bg-main transition">
                        {{ localized('Ask about joining TUICO', 'Uliza kuhusu kujiunga na TUICO') }}
                    </a>

                    <a href="{{ locale_url('regions') }}"
                        class="border border-action px-5 py-2.5 text-sm font-semibold text-action hover:bg-action/10 transition">
                        {{ localized('Find a regional office', 'Tafuta ofisi ya mkoa') }}
                    </a>

                </div>

            </div>


            {{-- SECTOR HEAD --}}
            @if ($sector->leader)

                <div>

                    <div class="border border-gray-100 bg-gray-50 p-6">

                        <p class="text-sm uppercase tracking-widest text-action mb-2">
                            {{ localized('Sector Head', 'Mkuu wa Sekta') }}
                        </p>

                        <div class="mt-5">

                            @if ($sector->leader->photo)
                                <img src="{{ asset('storage/' . $sector->leader->photo) }}"
                                    alt="{{ $sector->leader->name }}"
                                    class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-sm">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full bg-action/10 flex items-center justify-center text-action text-2xl font-bold">
                                    {{ collect(explode(' ', $sector->leader->name))->filter()->map(fn($name) => strtoupper(substr($name, 0, 1)))->take(2)->implode('') }}
                                </div>
                            @endif

                            <h3 class="mt-5 text-xl font-bold text-gray-900">
                                {{ $sector->leader->name }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-600">
                                {{ $sector->leader->getTranslation('position', app()->getLocale()) }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================
         EXPLORE OTHER SECTORS
    ========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-6">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ localized('Explore Other Sectors', 'Sekta Nyingine') }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ localized('Explore Other TUICO Sectors', 'Gundua Sekta Nyingine za TUICO') }}
                </h2>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach (\App\Models\OrgUnit::where('type', \App\Enums\OrgUnitType::Sector)->where('id', '!=', $sector->id)->orderBy('order')->get() as $otherSector)
                    <a href="{{ is_sw()
                        ? '/sw/sectors/' . \Illuminate\Support\Str::slug($otherSector->getTranslation('name', 'en'))
                        : '/sectors/' . \Illuminate\Support\Str::slug($otherSector->getTranslation('name', 'en')) }}"
                        class="group bg-white border border-gray-100 p-6 hover:border-action hover:shadow-sm transition">

                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-action transition">
                            {{ $otherSector->getTranslation('name', app()->getLocale()) }}
                        </h3>

                        <p class="mt-3 text-sm text-gray-600 leading-6">
                            {{ \Illuminate\Support\Str::limit($otherSector->getTranslation('description', app()->getLocale()), 120) }}
                        </p>

                        <span class="inline-flex items-center mt-5 text-sm font-semibold text-action">
                            {{ localized('View Sector', 'Angalia Sekta') }}
                            <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                        </span>

                    </a>
                @endforeach

            </div>

        </div>

    </section>


    {{-- =========================
         BACK TO SECTORS
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <a href="{{ locale_url('sectors') }}"
            class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition">

            <span class="mr-2">←</span>

            {{ localized('Back to Sectors', 'Rudi kwenye Sekta') }}

        </a>

    </section>

@endsection
