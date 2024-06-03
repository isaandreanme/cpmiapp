<?php

namespace App\Providers\Filament;

use App\Filament\Resources\DataPmiResource;
use App\Filament\Resources\PendaftaranResource;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\FilamentVersions\VersionsPlugin as FilamentVersionsVersionsPlugin;
use Awcodes\FilamentVersions\VersionsPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Awcodes\LightSwitch\Enums\Alignment;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use lockscreen\FilamentLockscreen\Lockscreen;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel 
            ->topNavigation()
            ->breadcrumbs(false)
            // ->sidebarFullyCollapsibleOnDesktop()
            ->databaseNotifications()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandLogo(asset('images/logo-fds.svg'))
            ->darkModeBrandLogo(asset('images/logo-fds-dark.svg'))
            ->brandLogoHeight('4rem')
            ->favicon(asset('images/favicon.svg'))
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
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
            ->authMiddleware([
                Authenticate::class,
                Locker::class,
            ])
            ->plugins([
                Lockscreen::make(),
                FilamentProgressbarPlugin::make()->color('#ffa500'),
                \Hasnayeen\Themes\ThemesPlugin::make(),
                LightSwitchPlugin::make()
                    ->position(Alignment::TopCenter),
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        MyImages::make()
                            ->directory('images/backgrounds'),

                    ),
                // FilamentVersionsVersionsPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                        shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                        hasAvatars: false, // Enables the avatar upload form component (default = false)
                        slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                    ),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                QuickCreatePlugin::make()
                    ->includes([
                        PendaftaranResource::class,
                        DataPmiResource::class,
                    ]),
            ])
            ->collapsibleNavigationGroups(true)
            ->navigationItems([
                NavigationItem::make('Lihat Website')
                    ->group('WEB')
                    ->url('https://nahelindopratama.com/', shouldOpenInNewTab: true)
                    ->sort(-3)
                    ->icon('heroicon-o-viewfinder-circle'),
                NavigationItem::make('Admin Website')
                    ->group('WEB')
                    ->url('https://nahelindopratama.com/wp-admin', shouldOpenInNewTab: true)
                    ->sort(-3)
                    ->icon('heroicon-o-wrench-screwdriver'),
            ])
            ->navigationGroups([
                NavigationGroup::make('WEB')
                    ->label('WEB')
                    ->collapsible(true),
                // NavigationGroup::make('CPMI')
                //     ->label('CPMI')
                //     ->icon('heroicon-m-check-badge'),
                // NavigationGroup::make('PENGATURAN')
                //     ->label('PENGATURAN')
                //     ->icon('heroicon-o-pencil')
                //     ->collapsible(true),
                // NavigationGroup::make('MODUL')
                //     ->label('MODUL')
                //     ->icon('heroicon-o-pencil')
                //     ->collapsible(true),


            ]);
    }
}
