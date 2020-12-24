<?php

namespace app\blog\forms\backend\update;

use app\blog\entities\User;
use yii\base\Model;

class UserUpdate extends Model
{
    public string $username;
    public string $email;
    public int $status;

    public function __construct(User $user, $config = [])
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->status = $user->status;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['username', 'email'], 'filter', 'filter' => 'trim'],
            [['username', 'email'], 'required'],
            [['email'], 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['status'], 'safe'],
        ];
    }
}
