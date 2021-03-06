<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Article;
use app\blog\entities\Category;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class CategoryRepository
{
    public function findAll(): array
    {
        return Category::find()->all();
    }

    public function findBySlug($slug): ?Category
    {
        return Category::findOne(['slug' => $slug]);
    }

    /**
     * This method works with console ArticleController
     *
     * @return array
     */
    public function findAllCategoriesIds(): array
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
