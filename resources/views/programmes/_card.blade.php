@php
    $isSwahili = app()->getLocale() === 'sw';
@endphp

<article class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-7">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">

        <div class="max-w-3xl">

            <h3 class="text-xl md:text-2xl font-bold leading-snug text-blue-950">
                {{ $programme->title }}
            </h3>

            @if ($programme->description)

                <p class="mt-3 text-sm text-gray-600 leading-7">
                    {{ $programme->description }}
                </p>

            @endif

        </div>


        {{-- STATUS --}}
        @if ($programme->status)

            <span
                class="inline-flex w-fit shrink-0 items-center px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full
                    {{ $programme->status->value === 'active'
                        ? 'bg-green-50 text-green-700 border border-green-100'
                        : 'bg-gray-100 text-gray-600 border border-gray-200' }}"
            >
                {{ $programme->status->getLabel() }}
            </span>

        @endif

    </div>


    {{-- DETAILS --}}
    <div class="mt-6 pt-5 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        {{-- AFFILIATION --}}
        @if ($programme->affiliation)

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    {{ $isSwahili ? 'Mshirika' : 'Affiliation' }}
                </p>

                <p class="mt-1 text-sm font-semibold text-gray-700">
                    {{ $programme->affiliation->name }}
                </p>

            </div>

        @endif


        {{-- START DATE --}}
        @if ($programme->starts_at)

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    {{ $isSwahili ? 'Kuanza' : 'Start Date' }}
                </p>

                <p class="mt-1 text-sm font-semibold text-gray-700">
                    {{ $programme->starts_at->format('d M Y') }}
                </p>

            </div>

        @endif


        {{-- END DATE --}}
        @if ($programme->ends_at)

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                    {{ $isSwahili ? 'Kumalizika' : 'End Date' }}
                </p>

                <p class="mt-1 text-sm font-semibold text-gray-700">
                    {{ $programme->ends_at->format('d M Y') }}
                </p>

            </div>

        @endif

    </div>


    {{-- OUTCOMES --}}
    @if ($programme->outcomes)

        <div class="mt-6 pt-5 border-t border-gray-100">

            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                {{ $isSwahili ? 'Matokeo Yanayotarajiwa' : 'Expected Outcomes' }}
            </p>

            <p class="mt-2 text-sm text-gray-600 leading-7">
                {{ $programme->outcomes }}
            </p>

        </div>

    @endif

</article>
