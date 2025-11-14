<?php

namespace App\Providers;

use App\Policies\PerfilPolicy;
use App\Policies\ProjectCardItemPolicy;
use App\Policies\ProjectCardPolicy;
use App\Policies\ProjectPolicy;
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

        $project = app(ProjectPolicy::class);
        Gate::define('project-index', [$project, 'index']);
        Gate::define('project-create', [$project, 'create']);
        Gate::define('project-store', [$project, 'store']);
        Gate::define('project-edit', [$project, 'edit']);
        Gate::define('project-update', [$project, 'update']);
        Gate::define('project-delete', [$project, 'delete']);

        $projectCardPolicy = app(ProjectCardPolicy::class);
        Gate::define('project-card-index', [$projectCardPolicy, 'index']);
        Gate::define('project-card-create', [$projectCardPolicy, 'create']);
        Gate::define('project-card-store', [$projectCardPolicy, 'store']);
        Gate::define('project-card-edit', [$projectCardPolicy, 'edit']);
        Gate::define('project-card-update', [$projectCardPolicy, 'update']);
        Gate::define('project-card-delete', [$projectCardPolicy, 'delete']);

        $projectCardItemPolicy = app(ProjectCardItemPolicy::class);
        Gate::define('project-card-item-index', [$projectCardItemPolicy, 'index']);
        Gate::define('project-card-item-create', [$projectCardItemPolicy, 'create']);
        Gate::define('project-card-item-store', [$projectCardItemPolicy, 'store']);
        Gate::define('project-card-item-edit', [$projectCardItemPolicy, 'edit']);
        Gate::define('project-card-item-update', [$projectCardItemPolicy, 'update']);
        Gate::define('project-card-item-delete', [$projectCardItemPolicy, 'delete']);
    }
}
