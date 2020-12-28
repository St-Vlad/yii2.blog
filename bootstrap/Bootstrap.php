<?php

namespace app\bootstrap;

use app\blog\repositories\readRepos\UserRepository;
use yii\base\BootstrapInterface;
use yii\db\Connection;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->set(UserRepository::class, function () use ($app) {
            return new UserRepository();
        });
    }
}
