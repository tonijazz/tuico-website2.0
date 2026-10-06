<x-filament-widgets::widget>
    <x-filament::section heading="Quick links">
        <div class="flex flex-wrap gap-3">
            @foreach ($this->getLinks() as $link)
                <x-filament::button
                    tag="a"
                    :href="$link['url']"
                    :icon="$link['icon']"
                    color="primary"
                >
                    {{ $link['label'] }}
                </x-filament::button>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
