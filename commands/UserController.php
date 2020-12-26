<?php

namespace app\commands;

use app\blog\entities\User;
use app\blog\repositories\UserRepository;
use Faker\Factory;
use yii\console\Controller;

class UserController extends Controller
{
    private UserRepository $repository;

    public function __construct($id, $module, UserRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
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
            $this->repository->save($user);
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
