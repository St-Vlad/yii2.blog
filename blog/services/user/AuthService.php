<?php

namespace app\blog\services\user;

use app\blog\entities\UserIdentity;
use app\blog\forms\frontend\LoginForm;
use app\blog\repositories\readRepos\UserRepository;
use Yii;

class AuthService
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form)
    {
        $user = $this->users->findByEmail($form->email);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password.');
        }
        Yii::$app->user->login(new UserIdentity($user), $form->rememberMe ? 3600 * 24 * 30 : 0);
    }
}
