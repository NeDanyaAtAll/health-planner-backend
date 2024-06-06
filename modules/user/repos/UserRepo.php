<?php

namespace app\modules\user\repos;

use app\modules\user\models\User;

interface IUserRepo
{
    public function getByName(string $name): ?User;
    public function getByEmail(string $email): ?User;
    public function getAll(): array;
}

class UserRepo implements IUserRepo
{
    public function getByName(string $name): ?User
    {
        return User::findOne(['name' => $name]);
    }

    public function getByEmail(string $email): ?User
    {
        return User::findOne(['email' => $email]);
    }

    public function getAll(): array
    {
        return User::findAll([]);
    }
}