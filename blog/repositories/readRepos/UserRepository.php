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

    public function findActiveById($id): ?User
    {
        return User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }

    public function findByEmail($value): ?User
    {
        return User::findOne(['email' => $value]);
    }

    public function getAllUserIds(): array
    {
        return User::find()->select('id')->asArray()->column();
    }

    private function getBy(array $condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}
