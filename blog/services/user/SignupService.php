<?php

namespace app\blog\services\user;

use app\blog\entities\User;
use app\blog\forms\frontend\SignupForm;
use app\blog\repositories\UserRepository;
use app\blog\roles\RbacRoles;
use app\blog\services\user\RoleManageService;
use yii\db\Connection;

class SignupService
{
    private UserRepository $users;
    private RoleManageService $roleService;

    public function __construct(
        UserRepository $users,
        RoleManageService $roleService
    ) {
        $this->users = $users;
        $this->roleService = $roleService;
    }

    public function signup($form): void
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $this->users->save($user);
            $this->roleService->assignRole(RbacRoles::USER, $user->id);
            $transaction->commit();
        } catch (\Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }
    }
}
