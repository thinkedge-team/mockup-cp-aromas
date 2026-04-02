<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\View\PanelsRenderHook;
use Livewire\Livewire;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id("admin")
            ->path("admin")
            ->login()
            ->colors([
                "primary" => Color::hex("#d4a017"), // AROMAS Gold
                "success" => Color::hex("#228b22"), // Forest Green
            ])
            ->brandName("AROMAS CMS")
            ->favicon(asset("favicon.ico"))
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Beranda")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Tentang Kami")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Produk")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Mesin")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Promo")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Blog")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Portofolio")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Kontak")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Partnership")
                    ->collapsed(true),
                \Filament\Navigation\NavigationGroup::make()
                    ->label("Settings")
                    ->collapsed(true),
            ])
            ->discoverResources(
                in: app_path("Filament/Resources"),
                for: "App\\Filament\\Resources",
            )
            ->discoverPages(
                in: app_path("Filament/Pages"),
                for: "App\\Filament\\Pages",
            )
            ->pages([Pages\Dashboard::class])
            ->discoverWidgets(
                in: app_path("Filament/Widgets"),
                for: "App\\Filament\\Widgets",
            )
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->renderHook(
                PanelsRenderHook::TOPBAR_END,
                fn () => view('components.navigation-search-hook'),
            )
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
            ->authMiddleware([Authenticate::class]);
    }
}
