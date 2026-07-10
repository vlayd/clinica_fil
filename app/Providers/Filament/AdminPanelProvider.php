<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Employes\EmployeResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Enums\GlobalSearchPosition;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->profile()
            ->font('Be Vietnam Pro')
            ->brandLogo(asset('images/person_login.png'))
            ->brandLogoHeight('3rem')
            // ->userMenu()
            ->userMenuItems([
                Action::make('profile')
                ->label(fn()=>explode(' ', Auth::user()->name)[0])
                ->url(fn(): string => EmployeResource::getUrl('edit', ['record' => auth()->user()]))->icon('heroicon-o-user'),
                Action::make('Roles')
                ->label(function(){
					$roles = Auth::user()->getRoleNames();

					return $roles->isNotEmpty() ? 'Roles: ' . $roles->implode(',') : 'Roles';
                })
                ->url(fn() => route('filament.admin.resources.shield.roles.index'))
                ->icon(Heroicon::ShieldCheck)
            ])
            // ->passwordReset()
            ->spa() // Habilita o modo SPA (Single Page Application) para atualizações mais rápidas e suaves na interface do painel
            ->brandName('Clínicas')
            ->favicon(asset('images/favicon-48.png'))
            ->sidebarWidth('15rem')
            ->maxContentWidth(Width::ScreenTwoExtraLarge)
            ->resourceEditPageRedirect('index') // Redireciona para a página de listagem após a edição
            ->resourceCreatePageRedirect('index')// Redireciona para a página de listagem após a criação
            // ->maxContentWidth(Width::Full)
            ->sidebarCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->globalSearchKeyBindings(['ctrl+f']) // Define tecla de atalho para por o foco
            ->globalSearch(false, position: GlobalSearchPosition::Topbar); //Oculta a barra de pesquisa de pesquisa e define a posição dela
    }

    public function boot(): void
    {
        // Renderiza o nome do usuário ao lado esquerdo da foto na barra do topo
        FilamentView::registerRenderHook(
            PanelsRenderHook::USER_MENU_BEFORE,
            fn (): string => Blade::render('
                <div class="hidden sm:flex flex-col text-right me-3 justify-center">
                <!-- Nome do usuário ligeiramente menor (text-xs ou text-[13px]) -->
                <span class="text-xs font-semibold text-gray-800 dark:text-gray-100 leading-tight">
                    {{ auth()->user()->name }}
                </span>
                <br>
                <!-- Cargo fixo logo abaixo -->
                <span class="text-[10px] font-medium text-gray-500 dark:text-gray-400 tracking-wide uppercase mt-0.5">
                    Administrador
                </span>
            </div>
            '),
        );
    }
}
