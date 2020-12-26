<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Article;
use app\blog\entities\Category;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

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

    public function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [15, 100],
            ]
        ]);
    }
}
