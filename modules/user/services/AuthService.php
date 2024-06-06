<?php

namespace app\modules\user\services;

use app\modules\user\repos\IUserRepo;

class AuthService
{
    public function checkUniqueEmail(IUserRepo $userRepo, $email): bool
    {
        $user = $userRepo->getByEmail($email);
        if($user) {
            return true;
        }
        return false;
    }
}