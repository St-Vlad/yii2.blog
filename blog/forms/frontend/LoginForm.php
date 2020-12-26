<?php

namespace app\blog\forms\frontend;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public ?string $email = '';
    public ?string $password = '';
    public bool $rememberMe = false;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }
}
