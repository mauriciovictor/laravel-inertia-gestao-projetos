<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Repositories\Eloquent\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestDatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        #adiciona as permissões
        foreach (PermissionsEnum::cases() as $permission) {
            Permission::firstOrCreate([
                'name' => $permission->value,
                'guard_name' => 'web'
            ]);
        }

        $perfil = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $allPermissions = Permission::pluck('name')->toArray();
        $perfil->syncPermissions($allPermissions);

        #cria o usuário
        $user = User::updateOrCreate(
            ['email' => 'teste@gmail.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('123456'),
                'role_id' => $perfil->id
            ]
        );

        $user->assignRole([$perfil->id]);
    }
}
