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

class EmployeePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('employee')
            ->path('employee')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarWidth('15rem') 
            ->breadcrumbs(false)
            ->collapsibleNavigationGroups(false)
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make(__('Bookings'))
                    ->url(fn(): string => \App\Filament\Resources\BookingResource\Pages\ListBookings::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.bookings.index'))
                    ->icon('heroicon-m-shopping-bag'),
                \Filament\Navigation\NavigationItem::make(__('Vehicles'))
                    ->url(fn(): string => \App\Filament\Resources\VehicleResource\Pages\ListVehicles::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.vehicles.index'))
                    ->icon('heroicon-m-user-group')
                    ->group('Manage Vehicles'),
                \Filament\Navigation\NavigationItem::make(__('Fuel Logs'))
                    ->url(fn(): string => \App\Filament\Resources\FuelLogResource\Pages\ListFuelLogs::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.fuel-logs.index'))
                    ->icon('heroicon-m-user-group')
                    ->group('Manage Vehicles'),

                \Filament\Navigation\NavigationItem::make(__('Customers'))
                    ->url(fn(): string => \App\Filament\Resources\CustomerResource\Pages\ListCustomers::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.customers.index'))
                    ->icon('heroicon-m-user-group')
                    ->group('Manage Users'),
                \Filament\Navigation\NavigationItem::make(__('Employees'))
                    ->url(fn(): string => \App\Filament\Resources\EmployeeResource\Pages\ListEmployees::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.employees.index'))
                    ->icon('heroicon-m-user')
                    ->group('Manage Users'),
                \Filament\Navigation\NavigationItem::make(__('Partners'))
                    ->url(fn(): string => \App\Filament\Resources\PartnerResource\Pages\ListPartners::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.partners.index'))
                    ->icon('heroicon-m-light-bulb')
                    ->group('Manage Users'),

                \Filament\Navigation\NavigationItem::make(__('Expenses'))
                    ->url(fn(): string => \App\Filament\Resources\ExpenseResource\Pages\ListExpenses::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.expenses.index'))
                    ->icon('heroicon-m-folder-open')
                    ->group('Manage Accounts'),
                \Filament\Navigation\NavigationItem::make(__('Transactions'))
                    ->url(fn(): string => \App\Filament\Resources\TransactionResource\Pages\ListTransactions::getUrl())
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.resources.transactions.index'))
                    ->icon('heroicon-m-folder-open')
                    ->group('Manage Accounts'),
                \Filament\Navigation\NavigationItem::make(__('Setup'))
                    ->url(fn(): string => route('filament.employee.setup.resources.amenities.index'))
                    ->isActiveWhen(fn(): bool => request()->routeIs('filament.employee.setup.*'))
                    ->icon('heroicon-m-rocket-launch')
                    ->group('Manage Settings'),
            ]);
    }
}
