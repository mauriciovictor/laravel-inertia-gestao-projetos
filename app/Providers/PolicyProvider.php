<?php

namespace App\Providers;

use App\Policies\PerfilPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class PolicyProvider extends ServiceProvider
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
        $user = app(UserPolicy::class);
        Gate::define('user-index', [$user, 'index']);
        Gate::define('user-create', [$user, 'create']);
        Gate::define('user-store', [$user, 'store']);
        Gate::define('user-edit', [$user, 'edit']);
        Gate::define('user-update', [$user, 'update']);
        Gate::define('user-delete', [$user, 'delete']);

        $perfil = app(PerfilPolicy::class);
        Gate::define('perfil-index', [$perfil, 'index']);
        Gate::define('perfil-create', [$perfil, 'create']);
        Gate::define('perfil-store', [$perfil, 'store']);
        Gate::define('perfil-edit', [$perfil, 'edit']);
        Gate::define('perfil-update', [$perfil, 'update']);
        Gate::define('perfil-delete', [$perfil, 'delete']);
    }
}
