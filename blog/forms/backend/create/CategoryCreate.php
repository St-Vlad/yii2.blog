<?php

namespace app\blog\forms\backend\create;

use yii\base\Model;

class CategoryCreate extends Model
{
    public ?string $name;

    public function rules(): array
    {
        return [
            [['name'], 'filter', 'filter' => 'trim'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}
