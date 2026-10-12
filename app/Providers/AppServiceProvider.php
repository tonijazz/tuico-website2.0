<?php

namespace App\Providers;

use App\Http\ViewComposers\QuickLinksComposer;
use App\Http\ViewComposers\SiteSettingsComposer;
use App\Policies\RolePolicy;
use App\Support\AuthActivityLogger;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //this is for the quiklinks composer to be available in all views
        $this->app->singleton(QuickLinksComposer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Role::class, RolePolicy::class);

        // I added this inside boot():
        View::composer('*', SiteSettingsComposer::class);
        View::composer('layouts.app', QuickLinksComposer::class);
        AuthActivityLogger::register();   // <-- NEW (call)
    }
}
