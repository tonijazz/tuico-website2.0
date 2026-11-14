@props(['type', 'unit', 'actions' => []])

@php
    $locale = app()->getLocale();

    $copy = [
        'sector' => [
            'segment' => 'sectors',
            'label' => localized('Sector', 'Sekta'),
            'about' => localized('About the Sector', 'Kuhusu Sekta'),
            'head' => localized('Sector Head', 'Mkuu wa Sekta'),
            'examples' => localized('Examples of workplaces', 'Mifano ya maeneo ya kazi'),
            'exploreEyebrow' => localized('Explore Other Sectors', 'Sekta Nyingine'),
            'exploreTitle' => localized('Explore Other TUICO Sectors', 'Gundua Sekta Nyingine za TUICO'),
            'view' => localized('View Sector', 'Angalia Sekta'),
            'back' => localized('Back to Sectors', 'Rudi kwenye Sekta'),
        ],
        'department' => [
            'segment' => 'departments',
            'label' => localized('Department', 'Idara'),
            'about' => localized('About the Department', 'Kuhusu Idara'),
            'head' => localized('Department Head', 'Mkuu wa Idara'),
            'examples' => localized('Examples of work', 'Mifano ya kazi'),
            'exploreEyebrow' => localized('Explore Other Departments', 'Idara Nyingine'),
            'exploreTitle' => localized('Explore Other TUICO Departments', 'Gundua Idara Nyingine za TUICO'),
            'view' => localized('View Department', 'Angalia Idara'),
            'back' => localized('Back to Departments', 'Rudi kwenye Idara'),
        ],
        'unit' => [
            'segment' => 'units',
            'label' => localized('Unit', 'Kitengo'),
            'about' => localized('About the Unit', 'Kuhusu Kitengo'),
            'head' => localized('Unit Head', 'Mkuu wa Kitengo'),
            'examples' => localized('Examples of work', 'Mifano ya kazi'),
            'exploreEyebrow' => localized('Explore Other Units', 'Vitengo Vingine'),
            'exploreTitle' => localized('Explore Other TUICO Units', 'Gundua Vitengo Vingine vya TUICO'),
            'view' => localized('View Unit', 'Angalia Kitengo'),
            'back' => localized('Back to Units', 'Rudi kwenye Vitengo'),
        ],
    ][$type];

    $name = $unit->getTranslation('name', $locale);
    $examples = $unit->getTranslation('examples', $locale);
    $others = $unit->siblings()->get();
@endphp

{{-- HERO --}}
<x-page-hero :eyebrow="$copy['label']" :title="$name" />


{{-- CONTENT --}}
<section class="max-w-7xl mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- DESCRIPTION --}}
        <div class="lg:col-span-2">

            <p class="text-sm uppercase tracking-widest text-action mb-2">{{ $copy['about'] }}</p>

            <p class="text-gray-600 leading-8">
                {{ $unit->getTranslation('description', $locale) }}
            </p>

            @if (is_array($examples) && count($examples))
                <h3 class="mt-8 text-xl font-bold text-main">{{ $copy['examples'] }}</h3>

                <ul class="mt-4 space-y-2 text-gray-600 leading-7">
                    @foreach ($examples as $example)
                        <li class="flex gap-3">
                            <span class="mt-2.5 h-1.5 w-1.5 shrink-0 rounded-full bg-action"></span>
                            <span>{{ $example }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- OPTIONAL NOTE (e.g. coverage note on sector pages) --}}
            @if (isset($note) && $note->isNotEmpty())
                <p class="mt-8 border-l-4 border-action/30 bg-action/10 px-4 py-3 text-sm leading-6 text-gray-700">
                    {{ $note }}
                </p>
            @endif

            {{-- ACTIONS: first is the main button, the rest are outlined --}}
            @if (count($actions))
                <div class="mt-8 flex flex-wrap gap-3">
                    @foreach ($actions as $action)
                        <a href="{{ $action['url'] }}"
                            class="px-5 py-2.5 text-sm font-semibold transition {{ $loop->first ? 'bg-action text-white hover:bg-main' : 'border border-action text-action hover:bg-action/10' }}">
                            {{ $action['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif

        </div>


        {{-- HEAD --}}
        @if ($unit->leader)
            <div>
                <div class="border border-gray-100 bg-gray-50 p-6">
                    <p class="text-sm uppercase tracking-widest text-action mb-5">{{ $copy['head'] }}</p>

                    <div class="max-w-[15rem]">
                        <x-leader-card :name="$unit->leader->name" :title="$unit->leader->getTranslation('position', $locale)" :photo="$unit->leader->photo" />
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>


{{-- OTHERS OF THE SAME TYPE --}}
@if ($others->isNotEmpty())
    <section class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-6">
                <p class="text-sm uppercase tracking-widest text-action mb-2">{{ $copy['exploreEyebrow'] }}</p>
                <h2 class="text-3xl font-bold text-main">{{ $copy['exploreTitle'] }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($others as $other)
                    <a href="{{ locale_url($copy['segment'] . '/' . $other->slug) }}"
                        class="group bg-white border border-gray-100 p-6 hover:border-action hover:shadow-sm transition">

                        <h3 class="text-lg font-bold text-main group-hover:text-action transition">
                            {{ $other->getTranslation('name', $locale) }}
                        </h3>

                        <p class="mt-3 text-sm text-gray-600 leading-6">
                            {{ \Illuminate\Support\Str::limit($other->getTranslation('description', $locale), 120) }}
                        </p>

                        <span class="inline-flex items-center mt-5 text-sm font-semibold text-action">
                            {{ $copy['view'] }}
                            <span class="ml-2 group-hover:translate-x-1 transition">→</span>
                        </span>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
@endif


{{-- BACK --}}
<section class="max-w-7xl mx-auto px-6 py-8">
    <a href="{{ locale_url($copy['segment']) }}"
        class="inline-flex items-center text-sm font-semibold text-action hover:text-main transition">
        <span class="mr-2">←</span>
        {{ $copy['back'] }}
    </a>
</section>
