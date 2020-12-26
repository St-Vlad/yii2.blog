<?php

namespace app\blog\forms\backend\update;

use app\blog\entities\Category;
use yii\base\Model;

class CategoryUpdate extends Model
{
    public string $name;

    public function __construct(Category $category, $config = [])
    {
        $this->name = $category->name;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name'], 'filter', 'filter' => 'trim'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}
