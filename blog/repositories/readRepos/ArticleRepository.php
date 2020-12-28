<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Article;
use app\blog\entities\Category;
use app\blog\forms\frontend\cabinet\ArticleSearch;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\db\ActiveQuery;

class ArticleRepository
{
    public function findBySlug($slug)
    {
        return Article::findOne(['slug' => $slug]);
    }

    public function findAllByCategory(Category $category): DataProviderInterface
    {
        $query = Article::find()
            ->joinWith('category')
            ->where(['name' => $category->name])
            ->andWhere(['status' => Article::STATUS_ACTIVE])
            ->with('user', 'category');
        return $this->getProvider($query);
    }

    public function findAllActive(): DataProviderInterface
    {
        $query = Article::find()
            ->where(['status' => Article::STATUS_ACTIVE])
            ->with('user', 'category');
        return $this->getProvider($query);
    }

    public function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
                'pageSizeParam' => false
            ]
        ]);
    }

    public function search(ArticleSearch $form): DataProviderInterface
    {
        $pagination = new Pagination([
            'pageSize' => 10,
            'pageSizeParam' => false
        ]);

        $query = Article::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->andFilterWhere(['status' => $form->status]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
        ]);
    }
}
