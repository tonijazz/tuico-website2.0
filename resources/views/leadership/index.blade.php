@extends('layouts.app')

@php
    $locale = app()->getLocale();

    // One card per person: name + office title. A vacant post shows its sector/department/unit name as the title.
    $person = fn($leader, ?string $fallbackTitle = null) => [
        'name' => $leader?->name ?? localized('Not assigned', 'Haijaainishwa'),
        'title' => $leader?->getTranslation('position', $locale) ?: $fallbackTitle,
        'photo' => $leader?->photo,
        'vacant' => !$leader,
    ];

    // National leaders: Chairperson, then General Secretary, then the rest.
    $nationalRank = function ($executive) {
        $position = strtolower(
            is_array($executive->position) ? $executive->position['en'] ?? '' : $executive->position,
        );

        return match (true) {
            str_contains($position, 'chairperson') => 1,
            str_contains($position, 'general secretary') => 2,
            default => 3,
        };
    };

    $groups = [
        [
            'eyebrow' => localized('National Leadership', 'Uongozi Taifa'),
            'title' => localized('National Leaders of TUICO', 'Viongozi Wakuu wa TUICO'),
            'centered' => true,
            'people' => $nationalExecutives->sortBy($nationalRank)->map(fn($e) => $person($e)),
        ],
        [
            'eyebrow' => localized('Sectors', 'Sekta'),
            'title' => localized('Sector Heads', 'Wakuu wa Sekta'),
            'people' => $sectors->map(fn($s) => $person($s->leader, $s->getTranslation('name', $locale))),
        ],
        [
            'eyebrow' => localized('Departments', 'Idara'),
            'title' => localized('Department Heads', 'Wakuu wa Idara'),
            'people' => $departments->map(fn($d) => $person($d->leader, $d->getTranslation('name', $locale))),
        ],
        [
            'eyebrow' => localized('Units', 'Vitengo'),
            'title' => localized('Unit Heads', 'Wakuu wa Vitengo'),
            'people' => $units->map(fn($u) => $person($u->leader, $u->getTranslation('name', $locale))),
        ],
    ];
@endphp

@section('title', localized('Leadership', 'Uongozi'))

@section('content')

    {{-- HERO --}}
    <x-page-hero :eyebrow="localized('Leadership', 'Uongozi')" :title="localized('TUICO Leadership', 'Uongozi wa TUICO')" :intro="localized(
        'The National Chairperson provides leadership and oversight. The General Secretary oversees the union’s administration and implements decisions made by its governing bodies. Sector heads coordinate representation in the four sectors, while department and unit heads support the union’s day-to-day work.',
        'Mwenyekiti wa Taifa huongoza vikao vikuu vinavyosimamia shughuli za Chama. Katibu Mkuu husimamia utawala wa Chama na utekelezaji wa maamuzi ya vyombo vyake vya uongozi. Wakuu wa sekta huratibu uwakilishi katika sekta nne, huku wakuu wa idara na vitengo wakisaidia utekelezaji wa shughuli za kila siku za Chama.',
    )" />


    {{-- LEADER GROUPS (national, sectors, departments, units) --}}
    @foreach ($groups as $group)
        <section class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
            <div class="max-w-7xl mx-auto px-6 py-8">

                <div class="mb-6">
                    <p class="text-sm uppercase tracking-widest text-action mb-2">{{ $group['eyebrow'] }}</p>
                    <h2 class="text-3xl font-bold text-main">{{ $group['title'] }}</h2>
                </div>

                @php
                    $centered = $group['centered'] ?? false;
                    $rowClass = $centered
                        ? 'flex flex-wrap justify-center gap-6'
                        : 'grid grid-cols-2 lg:grid-cols-4 gap-6';
                    // Same card width as the 4-column grid, so centered cards match the rows below
                    $itemClass = $centered ? 'w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)]' : '';
                @endphp

                <div class="{{ $rowClass }}">
                    @foreach ($group['people'] as $p)
                        <div class="{{ $itemClass }}">
                            <x-leader-card :name="$p['name']" :title="$p['title']" :photo="$p['photo']" :vacant="$p['vacant']" />
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endforeach

@endsection
