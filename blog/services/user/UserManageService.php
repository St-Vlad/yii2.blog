<?php

namespace app\blog\services\user;

use app\blog\forms\backend\update\UserUpdate;
use app\blog\repositories\UserRepository;
use Yii;
use yii\web\NotFoundHttpException;

class UserManageService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit($id, UserUpdate $form): void
    {
        $user = $this->repository->find($id);
        $user->edit(
            $form->username,
            $form->email,
            $form->status
        );
        $this->repository->save($user);
    }

    public function remove($id): void
    {
        $user = $this->repository->find($id);
        $this->repository->remove($user);
    }
}
