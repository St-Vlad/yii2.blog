<?php

namespace app\modules\user\models;

class UserRepository
{
    public function findByEmail($email): ?User
    {
        return User::findOne(['email' => $email]);
    }

    public function save(User $user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
