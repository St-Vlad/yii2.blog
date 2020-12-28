<?php

namespace app\blog\repositories;

use app\blog\entities\User;
use yii\web\NotFoundHttpException;

class UserRepository
{
    public function get($id): ?User
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('User not found');
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove($id): void
    {
        $user = $this->get($id);
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
