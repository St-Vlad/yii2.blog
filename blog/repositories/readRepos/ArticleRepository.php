<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Article;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class ArticleRepository
{
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
}