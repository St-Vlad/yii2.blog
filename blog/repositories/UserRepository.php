<?php

namespace app\blog\repositories;

use app\blog\entities\User;

class UserRepository
{
    public function find($id): ?User
    {
        return User::findOne($id);
    }

    public function findActiveByUsername($username): ?User
    {
        return User::findOne(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    public function findActiveById($id): ?User
    {
        return User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }

    public function getByEmail($email)
    {
        return $this->getBy(['email' => $email]);
    }

    public function findByEmail($value): ?User
    {
        return User::findOne(['email' => $value]);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    private function getBy(array $condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }

    public function remove($id): void
    {
        $user = $this->find($id);
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
