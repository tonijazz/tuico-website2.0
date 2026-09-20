<?php

namespace App\Http\ViewComposers;

use App\Settings\SiteSettings;
use Illuminate\View\View;

class SiteSettingsComposer
{
    public function compose(View $view): void
    {
        $view->with('siteSettings', app(SiteSettings::class));
    }
}
