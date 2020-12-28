<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\User;
use app\blog\repositories\NotFoundException;

class UserRepository
{
    public function find($id): ?User
    {
        return User::findOne($id);
    }

    public function findByEmail($value): ?User
    {
        return User::findOne(['email' => $value]);
    }

    public function findAllUserIds(): array
    {
        return User::find()->select('id')->asArray()->column();
    }
}
