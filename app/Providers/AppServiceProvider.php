<?php

namespace App\Providers;

use App\Http\ViewComposers\QuickLinksComposer;
use App\Http\ViewComposers\SiteSettingsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // I added this inside boot():
        View::composer('*', SiteSettingsComposer::class);
        View::composer('*', QuickLinksComposer::class);
    }
}
