<?php

namespace app\blog\repositories;

use app\blog\entities\User;
use yii\web\NotFoundHttpException;

class UserRepository
{
    public function find($id): ?User
    {
        return User::findOne($id);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove($id): void
    {
        $user = $this->find($id);
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
