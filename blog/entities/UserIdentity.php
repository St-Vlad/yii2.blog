<?php

namespace app\blog\entities;

use app\blog\repositories\readRepos\UserRepository;
use yii\web\IdentityInterface;

class UserIdentity implements IdentityInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function findIdentity($id): ?UserIdentity
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user) : null;
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    private static function getRepository(): UserRepository
    {
        return \Yii::$container->get(UserRepository::class);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function __get($name)
    {
        return $this->user->$name;
    }

    public function __call($methodName, $args)
    {
        return $this->user->$methodName($args);
    }
}
