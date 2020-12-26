<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Article;
use app\blog\forms\frontend\cabinet\ArticleSearch;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\db\ActiveQuery;

class ArticleRepository
{
    public function getAllByUser($id): ActiveDataProvider
    {
        $query = Article::find()->where(['user_id' => $id])->with('user');
        return $this->getProvider($query);
    }

    public function getAllByCategory($id): DataProviderInterface
    {
        $query = Article::find()
            ->where(['status' => Article::STATUS_ACTIVE])
            ->where(['category_id' => $id])
            ->with('user');
        return $this->getProvider($query);
    }

    public function getAllActive(): DataProviderInterface
    {
        $query = Article::find()->where(['status' => Article::STATUS_ACTIVE])->with('user');
        return $this->getProvider($query);
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

    public function search(ArticleSearch $form): DataProviderInterface
    {
        $pagination = new Pagination([
            'pageSizeLimit' => [15, 100],
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
