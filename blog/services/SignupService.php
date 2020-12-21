<?php


namespace app\blog\services;


use app\blog\entities\User;
use app\blog\forms\frontend\SignupForm;
use app\blog\repositories\UserRepository;

class SignupService
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
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