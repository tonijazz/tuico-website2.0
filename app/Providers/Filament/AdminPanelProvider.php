<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Settings\SiteSettings;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaBoiteACode\FilamentLogsExplorer\FilamentLogsExplorerPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()

            // ---- Brand colors -------------------------------------------
            ->colors([
                // Navy #0E3A5F sits at shade 600 (the button color in light
                // mode). Lighter shades (300-400) are used for links and
                // focus rings in dark mode.
                'primary' => [
                    50  => '#EFF5FA',
                    100 => '#DCE9F5',
                    200 => '#B5D1EA',
                    300 => '#86B3DA',
                    400 => '#4F8CC0',
                    500 => '#1B5584',
                    600 => '#0E3A5F',
                    700 => '#0B2F4D',
                    800 => '#08243B',
                    900 => '#061B2C',
                    950 => '#04121E',
                ],
                'info'    => Color::hex('#2EA8DC'),  // TUICO sky
                'warning' => Color::hex('#F5C518'),  // TUICO yellow
                'success' => Color::hex('#1C8A4B'),  // TUICO green
                'danger'  => Color::Red,             // no red in the brand
                // 'gray' left at Filament's neutral default
            ])

            // ---- Typography & theme -------------------------------------
            ->font('Inter')
            ->defaultThemeMode(ThemeMode::System)   // follow OS; toggle stays in user menu
            ->viteTheme('resources/css/filament/admin/theme.css')

            // ---- Branding (logo comes from Spatie SiteSettings) ---------
            ->brandName('TUICO')
            ->brandLogo(fn (): HtmlString => $this->brand())
            ->brandLogoHeight('2.75rem')
            ->favicon(fn (): ?string => $this->logoUrl())

            // ---- Resources, pages, widgets ------------------------------
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,   // our custom dashboard (greeting + columns)
            ])
            // Dashboard widgets are auto-discovered from app/Filament/Widgets
            // and ordered by their $sort value.
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')

            // ---- Middleware & plugins -----------------------------------
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),

                // Who did what (content changes, logins, logouts). Super admin only.
                ActivitylogPlugin::make()
                    ->label('Activity Log')
                    ->pluralLabel('Activity Logs')
                    ->navigationGroup('Logs')
                    ->navigationIcon('heroicon-o-clipboard-document-list')
                    ->datetimeFormat('d M Y, H:i')
                    ->isRestoreActionHidden(true)   // keep the audit trail read-only
                    ->authorize(fn (): bool => auth()->user()?->hasRole('super_admin') ?? false),

                // Technical error logs (storage/logs). Super admin only, no deleting.
                FilamentLogsExplorerPlugin::make()
                    ->navigationGroup('Logs')
                    ->navigationLabel('Server Logs')
                    ->deletable(false)
                    ->canAccessUsing(fn (): bool => auth()->user()?->hasRole('super_admin') ?? false),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    /**
     * Public URL of the uploaded logo, or null if none / settings unavailable.
     * Wrapped in try/catch so artisan commands (e.g. migrate on a fresh DB)
     * don't break when the settings table doesn't exist yet.
     */
    private function logoUrl(): ?string
    {
        try {
            $logo = app(SiteSettings::class)->logo;

            return filled($logo) ? Storage::disk('public')->url($logo) : null;
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Seal on a white circular badge + "TUICO" text.
     * Styling lives in theme.css (.tuico-brand*). Falls back to text only.
     */
    private function brand(): HtmlString
    {
        $url = $this->logoUrl();

        $badge = $url
            ? '<span class="tuico-brand__badge"><img src="' . e($url) . '" alt="TUICO logo"></span>'
            : '';

        return new HtmlString(
            '<span class="tuico-brand">' . $badge . '<span class="tuico-brand__name">TUICO</span></span>'
        );
    }
}
