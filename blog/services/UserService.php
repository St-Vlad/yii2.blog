<?php

namespace app\modules\user\models;

use app\modules\user\models\forms\LoginForm;
use app\modules\user\models\forms\SignupForm;
use Yii;

class UserService
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
        Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
    }

    public function signup(SignupForm $form): void
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->users->save($user);
    }
}
