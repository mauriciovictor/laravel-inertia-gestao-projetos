<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InertiaProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Inertia\Inertia::setRootView('layouts.inertia.app');
    }
}
