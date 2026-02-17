<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel)
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
