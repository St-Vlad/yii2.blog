<?php

namespace app\blog\forms\backend\update;

use app\blog\entities\Category;
use yii\base\Model;

class CategoryUpdate extends Model
{
    public string $category_name;

    public function __construct(Category $category, $config = [])
    {
        $this->category_name = $category->category_name;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['category_name'], 'filter', 'filter' => 'trim'],
            [['category_name'], 'required'],
            [['category_name'], 'string', 'max' => 255],
        ];
    }
}
