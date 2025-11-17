<?php

namespace App\ValueObjects;

use Illuminate\Support\Facades\Hash;

class Password
{
    private string $hash;

    public function __construct(public string $password)
    {

    }

    public function toHash(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function matches(string $plain): bool
    {
        return password_verify($plain, $this->hash);
    }

    public function __toString(): string
    {
        return $this->password;
    }

    public function equals(self $other): bool
    {
        return $this->hash === $other->hash;
    }
}
