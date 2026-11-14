<?php

if (! function_exists('is_sw')) {
    function is_sw(): bool
    {
        return app()->getLocale() === 'sw';
    }
}

if (! function_exists('localized')) {
    /** localized('Home', 'Nyumbani') */
    function localized(string $en, string $sw): string
    {
        return is_sw() ? $sw : $en;
    }
}

if (! function_exists('locale_url')) {
    /** locale_url('join-us') => /join-us or /sw/join-us; locale_url() => / or /sw */
    function locale_url(string $path = ''): string
    {
        $path   = ltrim($path, '/');
        $prefix = is_sw() ? '/sw' : '';

        return $path === '' ? ($prefix ?: '/') : $prefix . '/' . $path;
    }

}

if (! function_exists('news_type_label')) {
    /** Label for a news type enum (or null) in the current language. */
    function news_type_label($type)
    {
        return match ($type?->value) {
            'update'        => localized('Update', 'Taarifa'),
            'press_release' => localized('Press Release', 'Taarifa kwa Vyombo vya Habari'),
            'blog'          => localized('Blog', 'Makala'),
            default         => $type?->getLabel(),
        };
    }
}
