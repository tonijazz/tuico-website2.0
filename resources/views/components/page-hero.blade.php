@props(['eyebrow' => null, 'title', 'intro' => null])

<section class="bg-main text-white">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

            <div class="max-w-3xl">
                @if ($eyebrow)
                    <p class="text-sm uppercase tracking-widest text-white/70 mb-2">{{ $eyebrow }}</p>
                @endif

                <h1 class="text-4xl md:text-5xl font-bold leading-tight">{{ $title }}</h1>

                @if ($intro)
                    <p class="mt-5 max-w-2xl text-lg leading-8 text-white/80">{{ $intro }}</p>
                @endif

                {{ $slot }}
            </div>

            @isset($aside)
                {{ $aside }}
            @endisset

        </div>
    </div>
</section>