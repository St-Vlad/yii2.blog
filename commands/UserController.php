<?php

namespace app\commands;

use app\blog\entities\User;
use app\blog\repositories\UserRepository;
use app\blog\roles\RbacRoles;
use app\blog\services\RoleManageService;
use app\blog\services\SignupService;
use Faker\Factory;
use yii\console\Controller;

class UserController extends Controller
{
    private UserRepository $repository;
    private RoleManageService $service;

    public function __construct(
        $id,
        $module,
        UserRepository $repository,
        RoleManageService $service,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }

    public function actionIndex()
    {
        echo 'to create user, type \'./yii user/create {user_count}\'' . PHP_EOL;
        echo 'to remove user, type \'./yii user/remove {user_id}\'' . PHP_EOL;
    }

    public function actionCreate($count)
    {
        $faker = Factory::create();
        $password = 'qwertyuiop';

        for ($i = 0; $i < $count; $i++) {
            $user = User::create(
                $faker->name,
                $faker->email,
                $password
            );
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $this->repository->save($user);
                $this->service->assignRole(RbacRoles::USER, $user->id);
                $transaction->commit();
            } catch (\Exception $ex) {
                $transaction->rollBack();
                throw $ex;
            }
        }
        echo 'user(s) created successfully' . PHP_EOL;
        echo 'password is \'qwertyuiop\'' . PHP_EOL;
    }

    public function actionRemove($id)
    {
        try {
            $this->repository->remove($id);
        } catch (\RuntimeException $exception) {
            echo $exception;
        }
        echo 'user removed successfully' . PHP_EOL;
    }
}
