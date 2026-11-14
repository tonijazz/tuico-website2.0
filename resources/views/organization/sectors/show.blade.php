@extends('layouts.app')

@section('title', $sector->getTranslation('name', app()->getLocale()))

@section('content')

    <x-org-unit-detail type="sector" :unit="$sector" :actions="[
        ['label' => localized('Ask about joining TUICO', 'Uliza kuhusu kujiunga na TUICO'), 'url' => locale_url('join-us')],
        ['label' => localized('Find a regional office', 'Tafuta ofisi ya mkoa'), 'url' => locale_url('regions')],
    ]">

        <x-slot:note>
            @if (is_sw())
                Hii ni mifano. Kwa orodha kamili, soma
                <a href="{{ locale_url('resources') }}" class="font-semibold text-action underline">kanuni ya 13.2 ya Kanuni za
                    Katiba ya TUICO za mwaka 2021</a>.
                Hujui eneo lako la kazi linaangukia sekta gani? Tuambie mahali unapofanya kazi kupitia fomu ya
                maelezo ya uanachama.
            @else
                These are examples. See
                <a href="{{ locale_url('resources') }}" class="font-semibold text-action underline">regulation 13.2 of the 2021 TUICO
                    Constitutional Regulations</a>
                for the full list. Unsure where your workplace fits? Tell us where you work through the membership
                enquiry form.
            @endif
        </x-slot:note>

    </x-org-unit-detail>

@endsection
