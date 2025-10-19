<?php

namespace App\ValueObjects;

use Illuminate\Support\Facades\Hash;

class Password
{
    private string $hash;

    public function __construct(public string $password)
    {
        $this->password = $password;
    }

    public function toHash(): string
    {
        return bcrypt($this->password);
    }

    public function matches(string $plain): bool
    {
        return Hash::check($plain, $this->hash);
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
