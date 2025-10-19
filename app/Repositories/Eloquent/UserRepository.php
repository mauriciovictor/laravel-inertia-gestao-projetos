<?php

namespace App\Repositories\Eloquent;

use App\DTOs\UserData;
use App\Repositories\Eloquent\Models\User;

class UserRepository
{
    public function __construct(private User $model)
    {

    }

    public function create(UserData $userData)
    {
        return $this->model->create([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => $userData->password?->toHash(),
        ]);
    }

    public function update($id, UserData $userData)
    {
        $data = [
            'name' => $userData->name,
            'email' => $userData->email,
        ];

        if ($userData->password) {
            $data['password'] = $userData->password->toHash();
        }

        return $this->model->find($id)->update($data);
    }

    public function delete()
    {
    }
}
