<?php

namespace Tests\Utils;

use Illuminate\Support\Facades\DB;

class UserTestUtils
{
    public function createDefaultUserAdmin()
    {
        $user = DB::table('users')->insertGetId([
            'name' => 'Default User',
            'email' => 'defaultuser@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 1
        ]);
    }

    public function createPermissions()
    {

    }
}
