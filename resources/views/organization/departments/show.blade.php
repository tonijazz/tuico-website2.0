@extends('layouts.app')

@section('title', $department->getTranslation('name', app()->getLocale()))

@section('content')

    {{-- =========================
         HERO
    ========================== --}}

    <section class="bg-main text-white">

        <div class="max-w-7xl mx-auto px-6 py-12">

            <p class="text-sm uppercase tracking-widest text-white/70 mb-2">
                {{ $isSwahili ? 'Idara' : 'Department' }}
            </p>

            <h1 class="text-4xl md:text-5xl font-bold">
                {{ $department->getTranslation('name', app()->getLocale()) }}
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
                    {{ $isSwahili ? 'Kuhusu Idara' : 'About the Department' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $department->getTranslation('name', app()->getLocale()) }}
                </h2>

                <p class="mt-5 text-gray-600 leading-8">
                    {{ $department->getTranslation('description', app()->getLocale()) }}
                </p>

                {{-- EXAMPLES --}}
                @php
                    $examples = $department->getTranslation('examples', app()->getLocale());
                @endphp

                @if (is_array($examples) && count($examples))

                    <h3 class="mt-8 text-xl font-bold text-gray-900">
                        {{ $isSwahili ? 'Mifano ya kazi' : 'Examples of work' }}
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

                {{-- BUTTONS --}}
                <div class="mt-8 flex flex-wrap gap-3">

                    <a href="{{ locale_url('regions') }}"
                        class="bg-action px-5 py-2.5 text-sm font-semibold text-white hover:bg-main transition">
                        {{ $isSwahili ? 'Tafuta ofisi ya mkoa' : 'Find a regional office' }}
                    </a>

                    <a href="{{ locale_url('contact') }}"
                        class="border border-action px-5 py-2.5 text-sm font-semibold text-action hover:bg-action/10 transition">
                        {{ $isSwahili ? 'Wasiliana na TUICO' : 'Contact TUICO' }}
                    </a>

                </div>

            </div>


            {{-- DEPARTMENT HEAD --}}
            @if ($department->leader)

                <div>

                    <div class="border border-gray-100 bg-gray-50 p-6">

                        <p class="text-sm uppercase tracking-widest text-action mb-2">
                            {{ $isSwahili ? 'Mkuu wa Idara' : 'Department Head' }}
                        </p>

                        <div class="mt-5">

                            @if ($department->leader->photo)
                                <img src="{{ asset('storage/' . $department->leader->photo) }}"
                                    alt="{{ $department->leader->name }}"
                                    class="w-24 h-24 object-cover rounded-full border-4 border-white shadow-sm">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full bg-action/10 flex items-center justify-center text-action text-2xl font-bold">
                                    {{ collect(explode(' ', $department->leader->name))->filter()->map(fn($name) => strtoupper(substr($name, 0, 1)))->take(2)->implode('') }}
                                </div>
                            @endif

                            <h3 class="mt-5 text-xl font-bold text-gray-900">
                                {{ $department->leader->name }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-600">
                                {{ $department->leader->getTranslation('position', app()->getLocale()) }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================
         EXPLORE OTHER DEPARTMENTS
    ========================== --}}

    <section class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-6">

                <p class="text-sm uppercase tracking-widest text-action mb-2">
                    {{ $isSwahili ? 'Idara Nyingine' : 'Explore Other Departments' }}
                </p>

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $isSwahili ? 'Gundua Idara Nyingine za TUICO' : 'Explore Other TUICO Departments' }}
                </h2>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach (\App\Models\OrgUnit::where('type', \App\Enums\OrgUnitType::Department)->where('id', '!=', $department->id)->orderBy('order')->get() as $otherDepartment)
                    <a href="{{ $isSwahili
                        ? '/sw/departments/' . \Illuminate\Support\Str::slug($otherDepartment->getTranslation('name', 'en'))
                        : '/departments/' . \Illuminate\Support\Str::slug($otherDepartment->getTranslation('name', 'en')) }}"
                        class="group bg-white border border-gray-100 p-6 hover:border-action hover:shadow-sm transition">

                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-action transition">
                            {{ $otherDepartment->getTranslation('name', app()->getLocale()) }}
                        </h3>

                        <p class="mt-3 text-sm text-gray-600 leading-6">
                            {{ \Illuminate\Support\Str::limit($otherDepartment->getTranslation('description', app()->getLocale()), 120) }}
                        </p>

                        <span class="inline-flex items-center mt-5 text-sm font-semibold text-action">
                            {{ $isSwahili ? 'Angalia Idara' : 'View Department' }}
                            <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                        </span>

                    </a>
                @endforeach

            </div>

        </div>

    </section>


    {{-- =========================
         BACK TO DEPARTMENTS
    ========================== --}}

    <section class="max-w-7xl mx-auto px-6 py-8">

        <a href="{{ locale_url('departments') }}"
            class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition">

            <span class="mr-2">←</span>

            {{ $isSwahili ? 'Rudi kwenye Idara' : 'Back to Departments' }}

        </a>

    </section>

@endsection
