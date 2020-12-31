<?php

namespace app\blog\forms\frontend;

use app\blog\entities\User;
use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public ?string $username = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $password_repeat = null;

    public function rules(): array
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username is already taken'],
            ['username', 'string', 'min' => 4, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This male is already taken'],

            ['password', 'required'],
            ['password', 'string', 'min' => 8],

            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['password_repeat', 'required'],
        ];
    }
}
