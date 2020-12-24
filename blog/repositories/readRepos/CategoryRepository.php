<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Categorie;
use yii\data\DataProviderInterface;

class CategoryRepository
{
    public function getAll(): array
    {
        return Categorie::find()->all();
    }

    /**
     * This method works with console ArticleController
     *
     * @return array
     */
    public function getAllCategoriesIds(): array
    {
        return Categorie::find()->select('id')->asArray()->column();
    }
}
