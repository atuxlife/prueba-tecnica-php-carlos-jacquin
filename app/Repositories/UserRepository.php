<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function allUsers()
    {
        return User::index();
    }

    public function storeUser($data)
    {
        return User::create($data);
    }

    public function findUser($data)
    {
        return User::show($data);
    }

    public function updateUser($data)
    {
        return User::update($data);
    }

    public function loginUser($data)
    {
        return User::login($data);
    }

    public function logoutUser($data)
    {
        return User::logout($data);
    }
}
