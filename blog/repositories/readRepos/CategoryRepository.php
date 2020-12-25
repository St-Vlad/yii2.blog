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

    /**
     * This method works with console ArticleController
     *
     * @return array
     */
    public function getAllCategoriesIds(): array
    {
        return Category::find()->select('id')->asArray()->column();
    }
}
