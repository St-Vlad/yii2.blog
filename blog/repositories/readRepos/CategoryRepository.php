<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Category;
use yii\data\DataProviderInterface;

class CategoryRepository
{
    public function getAll(): array
    {
        return Category::find()->all();
    }
}
