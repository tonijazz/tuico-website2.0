<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public string $vision;

    public string $mission;

    public ?string $logo;

    public ?string $facebook_url;

    public ?string $instagram_url;

    public ?string $tiktok_url;

    public ?string $linkedin_url;

    public ?string $youtube_url;

    public string $po_box;

    public string $phone;

    public string $email;

    public string $fax;
    public string $street_address;

    // your turn: add the rest based on the plan doc list above
    // think about which should be `string` vs `?string` (nullable) —
    // does every one of these definitely have a value from day one,
    // or might some (like a fax number, or a specific social link)
    // genuinely be unset until someone fills them in?

    public static function group(): string
    {
        return 'site';
    }
}
