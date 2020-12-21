<?php

namespace app\modules\user\models\forms;

use app\modules\user\models\User;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public ?string $email = null;
    public ?string $password = null;
    public bool $rememberMe = true;

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
