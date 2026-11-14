@props(['type', 'units'])

@php
    $locale = app()->getLocale();

    $copy = [
        'department' => [
            'segment' => 'departments',
            'eyebrow' => localized('TUICO Departments', 'Idara za TUICO'),
            'title' => localized('Departments of the Union', 'Majukumu ya Idara'),
            'label' => localized('Department', 'Idara'),
            'view' => localized('View Department', 'Angalia Idara'),
        ],
        'unit' => [
            'segment' => 'units',
            'eyebrow' => localized('TUICO Units', 'Vitengo vya TUICO'),
            'title' => localized('Units of the Union', 'Majukumu ya Vitengo'),
            'label' => localized('Unit', 'Kitengo'),
            'view' => localized('View Unit', 'Angalia Kitengo'),
        ],
    ][$type];
@endphp

<section class="max-w-7xl mx-auto px-6 py-8">

    <div class="mb-6">
        <p class="text-sm uppercase tracking-widest text-action mb-2">{{ $copy['eyebrow'] }}</p>
        <h2 class="text-3xl font-bold text-main">{{ $copy['title'] }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($units as $unit)
            <a href="{{ locale_url($copy['segment'] . '/' . $unit->slug) }}"
                class="group border border-gray-100 bg-white p-6 hover:border-action hover:shadow-sm transition">

                <div class="flex items-start justify-between gap-6">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-action mb-2">{{ $copy['label'] }}</p>

                        <h3 class="text-xl font-bold text-main group-hover:text-action transition">
                            {{ $unit->getTranslation('name', $locale) }}
                        </h3>
                    </div>

                    <span class="shrink-0 text-action text-xl group-hover:translate-x-1 transition">→</span>
                </div>

                <p class="mt-5 text-gray-600 leading-7">
                    {{ \Illuminate\Support\Str::limit($unit->getTranslation('description', $locale), 220) }}
                </p>

                <span class="inline-flex items-center mt-5 text-sm font-semibold text-action">
                    {{ $copy['view'] }}
                </span>
            </a>
        @endforeach
    </div>

</section>
