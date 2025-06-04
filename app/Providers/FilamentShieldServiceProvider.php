<?php

declare(strict_types=1);

namespace App\Providers;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentShieldServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Filament::serving(function (): void {
            Filament::registerPlugin(FilamentShieldPlugin::make());
        });
    }
}
