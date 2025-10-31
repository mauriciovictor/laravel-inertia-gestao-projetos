<?php

namespace App\Http\Middleware;

use App\Enums\PermissionsEnum;
use App\Repositories\Eloquent\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'layouts.inertia.app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $shared = [];
        
        if (Auth()->check()) {
            $shared['auth.user'] = [
                'permissions' => [
                    'menus' => [
                        'users' => $request->user()->hasPermissionTo(PermissionsEnum::USER_VIEW->value),
                        'perfis' => $request->user()->hasPermissionTo(PermissionsEnum::ROLES_VIEW->value),
                    ],
                    'features' => [
                        'users' => [
                            'create' => $request->user()->hasPermissionTo(PermissionsEnum::USER_CREATE->value),
                            'edit' => $request->user()->hasPermissionTo(PermissionsEnum::USER_EDIT->value),
                            'delete' => $request->user()->hasPermissionTo(PermissionsEnum::USER_DELETE->value),
                        ],
                        'perfis' => [
                            'create' => $request->user()->hasPermissionTo(PermissionsEnum::ROLES_CREATE->value),
                            'edit' => $request->user()->hasPermissionTo(PermissionsEnum::ROLES_EDIT->value),
                            'delete' => $request->user()->hasPermissionTo(PermissionsEnum::ROLES_DELETE->value),
                        ]
                    ]
                ]
            ];
        }

        return array_merge(parent::share($request), [
            ...$shared,
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],
        ]);
    }
}
