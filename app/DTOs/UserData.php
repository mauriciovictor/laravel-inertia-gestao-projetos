<?php

namespace App\DTOs;

use App\ValueObjects\Password;

class UserData
{
    public function __construct(
        public string        $name,
        public string        $email,
        public int           $role_id,
        public Password|null $password = null,
    )
    {

    }
}
