<?php

namespace app\blog\forms\backend\create;

use yii\base\Model;

class CategoryCreate extends Model
{

    public ?string $category_name = '';

    public function rules(): array
    {
        return [
            [['category_name'], 'filter', 'filter' => 'trim'],
            [['category_name'], 'required'],
            [['category_name'], 'string', 'max' => 255],
        ];
    }
}
